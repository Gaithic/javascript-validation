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

   
   
    public function getDistrict(){
        $users = User::all();
        foreach($users as $use){
            $use->activityCount = DB::table('activities')->whereUserId($use->id)->count();
        }
    	return view('users.admin.reports', [
            'users' =>  $users
           
        ]);
     
    }



    
    public function getUserReport(Request $request)
    {
        $parent_id = $request->user_id;
        $users = DB::table('activities')->where('user_id', $parent_id)->get();
        return response()->json([
            'users' => $parent_id,
            'users' => $users
        ]);
   
    }

    public function getRangesReport(Request $request){
        $division_id = $request->id;
        $ranges = Division::where('id', $division_id)->with('ranges')->get();
        return response()->json([
            'ranges' => $ranges,
        ]);
    }



    public function toSearchUserReport(){
        
    }



   


  



}
