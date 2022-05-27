<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCreateUserValidation;
use App\Models\Activity;
use App\Models\Circle;
use App\Models\District;
use App\Models\Division;
use App\Models\Holidays;
use App\Models\OfficesName;
use App\Models\Range;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Rules\MatchOldPassword;


class AdminController extends Controller
{
    public function adminView(){
        $users = User::all();
        return view('users.admin.dashboard', [
            'users' => $users
        ]);
    }

    public function manageUsers(Request $request){
        if($request->ajax()){
            $data= User::query()->orderBy("id", "desc");

            return DataTables::of($data)
                ->addIndexColumn()->addColumn('action', function($row){
                    $btn= '<a href="'.route('edit-users', ['id' => $row->id]).'"class=dit btn btn-primay btn-sm>View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])->make(true);


        }
        return view('users.admin.manageusers');
    }

    public function editUsers($id){
        $offices = OfficesName::all();
        $districts = District::all();
        $circles = Circle::all();
        $ranges = Range::all();
        $user = User::findOrFail($id);
        return view('users.admin.edituser',
        [
            'user' => $user,
            'offices' => $offices,
            'districts' => $districts,
            'ranges' => $ranges,
            'circles' => $circles
            

        ]);
    }

    public function createUserView(){
        $districts =  District::all();
        $circles  = Circle::all();
        $divisions = Division::all();
        $ranges   = Range::all();
        $offices = OfficesName::all();
        $dist_id = District::where('id',0)->get();
        $circle_id  = Circle::where('id', 0)->get();
        $division_id = Division::where('id', 0)->get();
        $range_id  = Range::where('id', 0)->get();

        return view('users.admin.createuser',[
             'districts' => $dist_id,
              'districts' => $districts,
              'circles' => $circle_id,
              'circles' => $circles,
              'divisions' => $divisions,
              'offices' => $offices,
              'divisions' => $division_id,
              'ranges' => $range_id,
              'ranges' => $ranges
        ])->with('success', "Let's Create new Employee");
    }


    public function adminGetCircle(Request $request)
    {
        $parent_id = $request->dist_id;
        $division_id = $request->dist_id;
        $range_id = $request->dist_id;
        $circles = District::where('id', $parent_id)
                              ->with('circles')
                              ->get();
        $divisions = Circle::where('district_id', $division_id)->with('divisions')->get();
        $ranges = Division::where('circle_id', $range_id)->with('ranges')->get();
        return response()->json([
            'circles' => $circles,
            'divisions' => $divisions,
            'ranges' => $ranges
        ]);
    }

    public function adminGetRanges(Request $request){
        $division_id = $request->id;
        $ranges = Division::where('id', $division_id)->with('ranges')->get();
        $districts = District::all();
        $offices = OfficesName::all();
        return response()->json([
            'ranges' => $ranges,
            'districts' => $districts, 
        ]);
    }


    public function createUser(AdminCreateUserValidation $request){
        $user = new User();
        $user->name = $request->name;
        $user->designation = $request->designation;
        $user->date_of_birth = $request->date_of_birth;
        $user->date_of_join = $request->date_of_join;
        $user->office_id = $request->office_id;
        $user->district_id = $request->district_id;
        $user->range_id = $request->range_id;
        $user->gender = $request->gender;
        $user->circle_id = $request->circle_id;
        $user->division_id = $request->division;
        $user->office_address = $request->office_address;
        $user->qualification = $request->qualification;
        $user->username =trim(strtolower($request->username));
        $user->password = Hash::make($request->password);
        $user->email = trim(strtolower($request->email));
        $user->contact = $request->contact;
        $user->isadmin  = $request->isadmin;
        $user->status = $request->status;
        $res = $user->save();
        if($res){
            return redirect()->intended(route('create-user'))->with('success', 'Employee Created Successfully');
        }
    }


    public function updateUser(Request $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->designation = $request->designation;
        $user->date_of_birth = $request->date_of_birth;
        $user->date_of_join = $request->date_of_join;
        $user->office_id = $request->office_id;
        $user->district_id = $request->district_id;
        $user->range_id = $request->range_id;
        $user->gender = $request->gender;
        $user->circle_id = $request->circle_id;
        $user->division_id = $request->division_id;
        $user->office_address = $request->office_address;
        $user->qualification = $request->qualification;
        if($request->password){
            $user->password = Hash::make($request->password);
        }else{
            $user->password = $user->password;
        }
        $user->username = $request->username;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->status = $request->status;
        $res = $user->save();
        if($res){
            return redirect()->intended(route('edit-users', ['id' => $user->id]))->with('success', 'Employee information Updated Successfully');
        }
    }



    public function createHoliday(){
        return view('users.admin.createholiday')->with('success', "Let's create new Holiday for employee's");
    }



    public function saveHoliday(Request $request){
        $holiday = new Holidays();
        $holiday->holiday_name = $request->holiday_name;
        $holiday->holiday_date = $request->holiday_date;
        $holiday->save();
        if($holiday){
            return redirect()->intended(route('create-holiday'))->with('success', 'Holiday Created Successfully!!');
        }
    }



    public function showHoliday(){
        $holidays = Holidays::all();
        return view('users.admin.showAllHoliday',[
            'holidays' => $holidays
        ]);
    }

    public function manageHolidays(Request $request){
        if($request->ajax()){
            $data= Holidays::query()->orderBy("id", "desc");

            return DataTables::of($data)
                ->addIndexColumn()->addColumn('action', function($row){
                    $btn= '<a href="'.route('edit-holidays', ['id' => $row->id]).'"class=dit btn btn-primay btn-sm>View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])->make(true);


        }
        return view('users.admin.createholiday');
    }


    public function editHolidays($id){
        $holidays = Holidays::findOrFail($id);
        return view('users.admin.edit-holiday',[
            'holidays' => $holidays
        ]);
    }

    public function updateHoliday(Request $request, $id){
        $holidays = Holidays::findOrFail($id);
        $holidays->holiday_name	= $request->holiday_name;
        $holidays->holiday_date = $request->holiday_date;
        $res = $holidays->save();
        if($res){
            return redirect()->intended(route('edit-holidays', ['id' => $holidays->id]))->with('success', 'Holiday Updated Successfully!!');
        }else{
            return redirect()->intended(route('edit-holidays', ['id' => $holidays->id]))->with('error', 'Oops something went wrong!!');
        }
    }



    public function viewAllUserActivities(Request $request){
        if($request->ajax()){
            $data= Activity::query()->orderBy("id", "desc");

            return DataTables::of($data)
                ->addIndexColumn()->addColumn('action', function($row){
                    $btn= '<a href="'.route('edit-admin-activity', ['id' => $row->id]).'"class=dit btn btn-primay btn-sm>View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])->make(true);


        }
        return view('users.admin.usersAllActivities');
    }


    public function editUserActivity($id){
        $activities = Activity::findOrFail($id);
        return view('users.admin.editUserActivity',
        [
            'activities' => $activities
        ]);
    }
    

    public function updateUserActivity(Request $request, $id){
        $activities = Activity::findOrFail($id);
        $activities->user_id = $request->user_id;
        $activities->name = $request->name;
        $activities->description = $request->description;
        $activities->activityName = $request->activityName;
        $activities->datetime = $request->datetime;
        $res = $activities->save();
        if($res){
            return back()->with('success', "Activity Updated Successfully!!");
        }
    }
    

    public function getAdminPassword(){
        return view('users.admin.changePassword');
    }

    public function storeAdminPassword(Request $request){
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

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->intended(route('manage-users'))->with('success', 'User Deleted Successfully');
    }

}
