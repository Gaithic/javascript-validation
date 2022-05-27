<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Circle;
use App\Models\District;
use App\Models\Division;
use App\Models\OfficesName;
use App\Models\Range;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

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

    public function employeesReportsView(){
        $user = User::all();
        $activity = Activity::all();
        $districts = District::all();
        $dist_id = District::where('id', 0)->get();
        $user_id = User::where('id', 0)->get();
        foreach($activity as $dst){
            $dst->userCount= DB::table('users')->whereDistrictId($dst->id)->count();
        }

        foreach($districts as $dst){
            $dst->userCount= DB::table('users')->whereDistrictId($dst->id)->count();
        }
        
        return view('users.admin.reports',[
            'user' => $user,
            'user' => $user_id,
            'activity' => $activity,
            'districts' => $dist_id,
            'districts' => $districts
        ]);
    }


    public function getReportWithUserName(Request $request){
        $parent_id = $request->dist_id;
        $user_id  = $request->user_id;
        $districts = District::where('id', $parent_id)->with('users')->get();
        // $users = Activity::where('user_id', $user_id)->with('user')->get();

        return response()->json([
            'activity' => $districts,
            'users' => $user_id
        ]);
    }



}
