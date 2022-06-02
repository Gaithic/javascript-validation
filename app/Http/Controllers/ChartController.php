<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Circle;
use App\Models\District;
use App\Models\Division;
use App\Models\OfficesName;
use App\Models\Range;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Component\Console\Input\Input;

class ChartController extends Controller
{
  

    public function showChart(Request $request){    
        $districts = District::all();
        foreach($districts as $dst){
            $dst->userCount= DB::table('users')->whereDistrictId($dst->id)->count();
        }
    	return view('users.admin.pie-chart', [
            'districts'=> $districts,
           
        ]);
    }

    public function getUserReport(Request $request){
        $user_id = $request->user_id;
        $users = User::all();
        $districts =  District::all();
       
    	return view('users.admin.reports', [
            "users" => $user_id,
            "users" => $users,
            'districts' => $districts,       
        ]);
     
    }


    public function getDropdown(Request $request){
     
        $user_id = $request->user_id;   
        $parent_id = $request->dist_id;
        $division_id = $request->dist_id;
        $range_id = $request->dist_id;
        $users = User::where('id', $user_id);
        if($request->user_id){
            $activityCount = Activity::where('user_id', $request->user_id)
            ->count();
        }elseif($request->start_date){
            $from = date('Y-m-d',strtotime($request->start_date)).' 00:00:00';
            $to = date('Y-m-d',strtotime($request->end_date)).' 23:59:59';
            $startDate = Activity::select(DB::raw('COUNT(*) as activityCount'),'created_at')->whereBetween('created_at',[$from,$to])
            ->orderBy('created_at')->groupBy('created_at')->get();
            // $activityCount = $startDate->count();
            

            $activityCount['date'] = $startDate;
            foreach ($activityCount['date'] as $sd){ 
                $sd->created_at = date('d-m-Y',strtotime($sd->created_at));
            }
// dd($startDate);
            
            
            // $activityCount['activityCount'] = $startDate->count();


        }
       
        $district = User::where('id', $user_id)->with(['districts', 'circles', 'divisions', 'ranges', 'activities'])->get();
        $circle = District::where('id', $parent_id)
                              ->with('circles')
                              ->get();
        $division = Circle::where('district_id', $division_id)->with('divisions')->get();
        $range = Division::where('circle_id', $range_id)->with('ranges')->get();
        return response()->json([
            
            'district' => $district,
            'circle' => $circle,
            'division' => $division,
            'range' => $range,
            'users' => $users,
            'activityCount' => $activityCount,
        ]);
    }

   
  
    public function getReportByDate(Request $request){
        $start_date = Carbon::parse($request->start_date)
                             ->toDateTimeString();

        $end_date = Carbon::parse($request->end_date)
                             ->toDateTimeString();

       return User::whereBetween('created_at', [
         $start_date, $end_date
       ])->get();
        

    }

}
