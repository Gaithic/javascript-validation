<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCreateUserValidation;
use App\Models\Activity;
use App\Models\ActivityList;
use App\Models\activityLog;
use App\Models\Circle;
use App\Models\District;
use App\Models\Division;
use App\Models\Holidays;
use App\Models\OfficesName;
use App\Models\Range;
use App\Models\User;
use App\Models\profile;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminView(){

        $users = User::all();
        $holidays = Holidays::all();
        $pending = User::where('status', 0)->get();
        $reject = User::where('status', 2)->get();

        return view('users.admin.dashboard', [
            'users' => $users,
            'pending' => $pending,
            'holidays' => $holidays,
            'reject' => $reject

        ]);
    }

    public function manageUsers(Request $request){
        if($request->ajax()){
            $data= User::query()->orderBy("id", "desc");

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    if($row->status == 1){
                        return 'Yes';
                    }else{
                        return 'No';
                    }
                })
                ->addColumn('action', function($row){
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
        $divisions = Division::all();
        $user = User::findOrFail($id);
        return view('users.admin.edituser',
        [
            'user' => $user,
            'offices' => $offices,
            'districts' => $districts,
            'ranges' => $ranges,
            'circles' => $circles,
            'divisions' => $divisions

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
        $user = Auth::user();
        $isAdmin = $user->isAdmin;
        $date = Carbon::now();
        $todayDdate = $date->toDayDateTimeString();

        $activityLog = [
            'name' => $user->name,
            'email' => $user->email,
            'description' => 'New user created by admin',
            'date_time' => $todayDdate
        ];
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
        $user->division_id = $request->division_id;
        $user->office_address = $request->office_address;
        $user->qualification = $request->qualification;
        $user->username =trim(strtolower($request->username));
        $user->password = Hash::make($request->password);
        $user->email = trim(strtolower($request->email));
        $user->contact = $request->contact;
        $user->isAdmin  = $request->isAdmin;
        $user->status = $request->status;
        $res = $user->save();

        if($res){
            DB::table('activity_logs')->insert($activityLog);
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
                ->editColumn('holiday_date', function($row){
                    $date = Carbon::parse($row['holiday_date'])->format('d-m-Y');
                    return $date;
                })
                ->editColumn('created_at', function($row){
                    $date = Carbon::parse($row['created_at'])->format('d-m-Y');
                    return $date;
                })
                ->editColumn('updated_at', function($row){
                    $date = Carbon::parse($row['updated_at'])->format('d-m-Y');
                    return $date;
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


    public function deleteHoliday($id){
        
        $holiday = Holidays::findOrFail($id);
        $holiday->delete();
        return redirect()->intended(route('show-holiday'))->with('success', 'Holiday Deleted Successfully');
    }



    public function viewAllUserActivities(Request $request){
        if($request->ajax()){
            $data= Activity::query()->with('user')->orderBy("created_at", "desc");

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function($row){
                    return $row->user->name;
                })
                ->addColumn('action', function($row){
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
            $activity = Activity::findOrFail($id);
            $user = Auth::user();
            $isAdmin = $request->isAdmin;
            $date = Carbon::now();
            $todayDdate = $date->toDayDateTimeString();

            $activityLog = [
                'name' => $user->name,
                'email' => $user->email,
                'description' => "Admin update activity",
                'date_time' => $todayDdate
            ];


            $activity->name = $request->name;
            $activity->description = $request->description;
            $activity->datetime  = $request->datetime;
            $activity->activityName = $request->activityName;
            $res = $activity->save();
            
            if($res){
                DB::table('activity_logs')->insert($activityLog);
                return back()->with('success', 'Activity Updated Successfully...');
            }else{
                return back()->with('success', 'Something Went Wrong!!, Try again Later...');
            }
    }



    public function deleteUserActivity($id){
        $user = Auth::user();

        $isAdmin = $user->isAdmin;
        $date = Carbon::now();
        $todayDdate = $date->toDayDateTimeString();

        $activityLog = [
            'name' => $user->name,
            'email' => $user->email,
            'description' => 'Deleted by Admin',
            'date_time' => $todayDdate
        ];

        DB::table('activity_logs')->insert($activityLog);

        $holiday = Activity::findOrFail($id);
        $holiday->delete();
        return redirect()->intended(route('show-user-activity'))->with('success', 'Activity Deleted Successfully');
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

    public function adminProfile(){

        $users = Activity::query()->with('user')->orderBy("created_at", "desc");
        $activity = Activity::where('user_id',auth()->user()->id)->paginate(4);
        $profile = profile::all();
        return view('users.admin.profile.adminProfile',[
            'users' => $users,
            'activity' => $activity,
            'profile' => $profile
        ]);
    }

    public function saveAdminProfile(Request $request){
        if($request->hasFile('profileImage')){
            $file = $request->file('profileImage');
            $fileName = $file->getClientOriginalName();
            $filepath = pathinfo($fileName, PATHINFO_FILENAME);
            $fileExtension = $request->file('profileImage')->getClientOriginalExtension();
            $fileNAmeTotore = $filepath.'-'.time().'.'.$fileExtension;
            $path = $file->move(public_path('/asset/images'), $fileNAmeTotore);
            // dd($path);
        }else{
            $fileNAmeTotore = 'noImage.jpg';
        }
        $profile = new Profile();
        $profile->education = $request->education;
        $profile->location = $request->location;
        $profile->companyName = $request->companyName;
        $profile->experience = $request->experience;
        $profile->profileImage = $fileNAmeTotore;
        $profile->skills = $request->skills;
        $profile->user_id = Auth::user()->id;
        $res = $profile->save();

        if($res){
            return back()->with('success', 'Profile Updated Successfully..', [
                'profile' => $profile
            ]);
        }




    }

    public function createNewActivityList(Request $request){
        return view('users.admin.createNewActivity');
    }

    public function saveNewActivityList(Request $request){
        $activitylist = new ActivityList();
        $activitylist->name = $request->name;
        $res = $activitylist->save();

        if($res){
            return redirect()->intended(route('create-acivity'))->with('success', 'Activity Created Successfully...');
        }
    }


    public function editUserActivityList(Request $request){
        if($request->ajax()){
            $data= ActivityList::query()->orderBy("id", "desc");

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn= '<a href="'.route('edit-activitylist', ['id' => $row->id]).'"class=dit btn btn-primay btn-sm>View</a>';
                    return $btn;
                })
                ->editColumn('created_at', function($row){
                    $date = Carbon::parse($row['created_at'])->format('d-m-y');
                    return $date;
                })
                ->rawColumns(['action'])->make(true);

        }

    }

    public function showUserActivityList($id){
        $activitylist= ActivityList::findOrfail($id);
        return view('users.admin.editActivitylist', [
            'activitylist' => $activitylist
        ]);
    }

    public function updateUserActivityList(Request $request, $id){
        $activitylist= ActivityList::findOrfail($id);
        $activitylist->name = $request->name;
        $res = $activitylist->save();
        if($res) {
            return redirect()->intended(route('create-acivity'))->with('success', 'Activity List Updated Successfully');
        }

    }

    public function destroy($id){
        $user = Auth::user();

        $isAdmin = $user->isAdmin;
        $date = Carbon::now();
        $todayDdate = $date->toDayDateTimeString();

        $activityLog = [
            'name' => $user->name,
            'email' => $user->email,
            'description' => 'Employee deleted by admin',
            'date_time' => $todayDdate
        ];

        DB::table('activity_logs')->insert($activityLog);
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->intended(route('manage-users'))->with('success', 'User Deleted Successfully');
    }

}
