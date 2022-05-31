<?php

namespace App\Http\Controllers;

use App\Http\Requests\userActivity;
use App\Models\Activity;
use App\Models\ActivityList;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function usersDashboard(Request $request){
        $user   = User::all();
        $offices = OfficesName::all();
        $activitylist = ActivityList::all();
        $office_d = OfficesName::where('id', 0)->get();

        return view('users.users.dashboard',[
            'user' => $user,
            'offices' => $offices,
            'offices'   => $office_d,
            'activitylist' => $activitylist
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
        
        $todayActivities =  Activity::whereDate('created_at', Carbon::today())->get()->count();

        if($todayActivities>=1){
            return back()->with('error', 'Only one Task is created not more than that...');
        }else{
            if($request->datetime<$today){
                return back()->with('error', 'Kindly create task with the current date, not with the back date...');
           }else{
            $user = Auth::user();
                $isAdmin = $request->isAdmin;
                $date = Carbon::now();
                $todayDdate = $date->toDayDateTimeString();
                
                $activityLog = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'description' => 'User Create new activity..',
                    'date_time' => $todayDdate
                ];
                $activityCount = Activity::where('created_at', '=', date('Y-m-d').' 00:00:00');
                
                $activity = new Activity();
                $activity->name = $request->name;
                $activity->description = $request->description;
                $activity->datetime  = $request->datetime;
                $activity->activityName = $request->activityName;
                $activity->user_id = Auth::user()->id;
                $activity->office_id  = Auth::user()->office_id;
                $activity->district_id  = Auth::user()->district_id;
                $activity->circle_id  = Auth::user()->circle_id;
                $activity->division_id  = Auth::user()->division_id;
                $activity->range_id   = Auth::user()->range_id ;
    
                if($request->datetime>$today){
                    return back()->with('error', 'Task created with the current date only not with the future date...');
                }else{
    
                    $res = $activity->save();
                    DB::table('activity_logs')->insert($activityLog);
                    if($res){
                        return redirect()->intended(route('user.index'))->with('success', 'Task Created Successfully!!');
                    }
        
                }
                
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
                ->rawColumns(['action', 'description'])->make(true);


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
            $user = Auth::user();
            $isAdmin = $request->isAdmin;
            $date = Carbon::now();
            $todayDdate = $date->toDayDateTimeString();
            
            $activityLog = [
                'name' => $user->name,
                'email' => $user->email,
                'description' => "user update activity",
                'date_time' => $todayDdate
            ];

            
            $activity->name = $request->name;
            $activity->description = $request->description;
            $activity->datetime  = $request->datetime;
            $activity->activityName = $request->activityName;
            $res = $activity->save();
            DB::table('activity_logs')->insert($activityLog);

            if($res){
                // dd($activityLog);
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
