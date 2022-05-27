<?php

namespace App\Http\Controllers;

use App\Http\Requests\userActivity;
use App\Models\Activity;
use App\Models\Holidays;
use App\Models\OfficesName;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Yajra\DataTables\Facades\DataTables;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function usersDashboard(Request $request){
        $user   = User::all();
        $offices = OfficesName::all();
        $office_d = OfficesName::where('id', 0)->get();

        return view('users.users.dashboard',[
            'user' => $user,
            'offices' => $offices,
            'offices'   => $office_d
        ]);
    }



    public function getOffices(Request $request){

        $parent_id = $request->activity_id;
        $offices = OfficesName::where('office_id', $parent_id)
                              ->with('offices')
                              ->get();
        return response()->json([
            'offices' => $offices
        ]);
    }

    public function saveActivity(userActivity $request){
       $today = date('Y-m-d');
       if($request->datetime<$today){
            return back()->with('error', 'Task is added to the current date only');
       }else{
        $activity = new Activity();
        $activity->name = $request->name;
        $activity->description = $request->description;
        $activity->datetime  = $request->datetime;
        $activity->activityName = $request->activityName;
        $activity->user_id = Auth::user()->id;
 
        $res = $activity->save();
            if($res){
                return redirect()->intended(route('user.index'))->with('success', 'Task Created Successfully!!');
            }else{
                return redirect()->intended(route('user.index'))->with('error', 'oops Something Went Wrong..');
            }
  
       }
      
    }

    public function showAllActivity(Request $request){
        if($request->ajax()){
            $data= Activity::where('user_id', '=', Auth::id())->get();

            return DataTables::of($data)
                ->addIndexColumn()->addColumn('action', function($row){
                    $btn= '<a href="'.route('edit-activity', ['id' => $row->id]).'"class=dit btn btn-primay btn-sm>View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])->make(true);


        }
        return view('users.users.showAllActivity');
    }

    public function editOwnActivity($id){
        $activity = Activity::findOrFail($id);
        return view('users.users.editActivity', [
            'activity' => $activity
        ]);
    }



    public function updateOwnActivity(Request $request, $id){
        $activity = Activity::findOrFail($id);
        $today = date('Y-m-d');
        if($today>$activity->created_at){
            return back()->with('error', "Sorry you don't have a permission to Edit the Previous days activities...");
        }else{
            $activity->name = $request->name;
            $activity->description = $request->description;
            $activity->datetime  = $request->datetime;
            $activity->activityName = $request->activityName;
            $res = $activity->save();

            if($res){
                return back()->with('success', 'Activity Updated Successfully...');
            }else{
                return back()->with('success', 'Something Went Wrong!!, Try again Later...');
            }
        }


    }

    public function getPassword(){
        return view('users.users.changePassword');
    }

    public function storeNewPassword(Request $request){
        $request->validate([

            'current_password' => ['required', new MatchOldPassword],

            'new_password' => ['required'],

            'new_confirm_password' => ['same:new_password'],

        ]);



       $newpassword =  User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
    
       if($newpassword){
           return back()->with('success', "your Password is updated...");
       }else{
        return back()->with('success', "Oops something Went Wrong...");
       }
       
    }
}
