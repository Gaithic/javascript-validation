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

    public function getDistrict(){
        $users = User::all();
        $user_id = User::where('id', 0)->get();
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
        $users = User::where('id', $user_id)->with('activities')->get();
        $circles = District::where('id', $parent_id)
                              ->with('circles')
                              ->get();
        $divisions = Circle::where('district_id', $division_id)->with('divisions')->get();
        $ranges = Division::where('circle_id', $range_id)->with('ranges')->get();
        return response()->json([
            'users' => $users,
            'circles' => $circles,
            'divisions' => $divisions,
            'ranges' => $ranges
        ]);
    }

   
  



   


  



}
