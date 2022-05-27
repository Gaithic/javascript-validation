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
        $districts = District::all();
        foreach($districts as $dst){
            $dst->userCount= DB::table('activities')->whereDistrictId($dst->id)->count();
        }

        foreach($users as $use){
            $use->count = DB::table('activities')->whereUserId($use->id)->count();
        }
    	return view('users.admin.reports', [
            'districts'=> $districts,
            'users' =>  $users
           
        ]);
     
    }


   


  



}
