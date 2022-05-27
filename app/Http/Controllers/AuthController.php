<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterFormValidation;
use App\Models\activityLog;
use App\Models\Circle;
use App\Models\District;
use App\Models\Division;
use App\Models\Holidays;
use App\Models\OfficesName;
use App\Models\Range;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class AuthController extends Controller
{
    public function mainView(){
        return view('layout.master');
    }

    public function registerView(){
        $offices = OfficesName::all();
        $districts =  District::all();
        $circles  = Circle::all();
        $divisions = Division::all();
        $ranges   = Range::all();
        $dist_id = District::where('id',0)->get();
        $circle_id  = Circle::where('id', 0)->get();
        $division_id = Division::where('id', 0)->get();
        $range_id  = Range::where('id', 0)->get();

      return view('auth.register',["districts" => $dist_id,
            'districts' => $districts,
            'circles' => $circle_id,
            'circles' => $circles,
            'divisions' => $divisions,
            'divisions' => $division_id,
            'ranges' => $range_id,
            'ranges' => $ranges,
            'offices' => $offices
        ]);
    }


    public function getCircle(Request $request)
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

    public function getRanges(Request $request){
        $division_id = $request->id;
        $ranges = Division::where('id', $division_id)->with('ranges')->get();
        return response()->json([
            'ranges' => $ranges,
        ]);
    }



    public function saveRegisterUser(RegisterFormValidation $request){
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
        $user->isadmin  = 0;
        $user->status = 0;
        $res = $user->save();

        if($res){
            return redirect()->intended(route('login-view'))->with('message', " '".$request->username."' Your account is created Kindly Wait for Admin Approval!!");
        }else{
            return redirect()->intended(route('regiter-view'))->with('error', 'Oops Something Went Wrong Kindly try after sometime!');
        }
    }

    public function loginview(){
        return view('auth.login');
    }


    public function loginUsers(LoginValidation $request){
        // dd(date('Y-m-d'));
        $local_holiday = Holidays::whereDate('holiday_date', Carbon::today())->get()->first();
        if($local_holiday){
            $local_holiday = $local_holiday->holiday_date;
        }
        $date = date('Y-m-d');
        $date1 = now()->format('l');
        $year=date('Y');
        $month=date('m');
        $firstday = new  DateTime("$year-$month-1 0:0:0");
        $first_w=$firstday->format('w');
        $saturday1=new DateTime;
        $saturday1->setDate($year,$month,14-$first_w);
        $holiday = $saturday1->format('Y-m-d');

        if($date == $local_holiday){
            return redirect()->intended(route('login-view'))->with('success', 'Today is off!! try on working Days');
        }else{
            if($date1=="Sunday"){
                return redirect()->intended(route('login-view'))->with('success', 'Today is off!! try on working Days');
           }else{
                if($date == $holiday){
                    return redirect()->intended(route('login-view'))->with('success', 'Today is Second Saturday!! try on working Days');
                }else{
                    $credentials = $request->only('username', 'password');
                    if($credentials!=null){
                        if(Auth::attempt($credentials)){
                            if(Auth::check()){
                                return redirect()->intended(route('auth.index'))->with('success', 'Welcome to Dashboard');
                            }
                        }else{
                            return redirect()->intended(route('login-view'))->with('error', 'Password does not match');
                
                        }
                    }else{
                        return redirect()->intended(route('user-register'))->with('error', 'user does not exist kindly register first');
                    }
                }
           }
        }





    }




    public function dashboard(){
        $user = Auth::user();
        if(Auth::check()){
            if($user->isAdmin==1){
                return redirect()->intended(route('admin-index'))->with('success', 'Welcome to Dashboard!!');

            }elseif($user->isAdmin==0){
                return redirect()->intended(route('user.index'))->with('success', 'Welcome to Dashboard!!');
            }else{
                return redirect()->intended(route('login-view'))->with('error', 'Access Denied!!');
            }
        }

    }


    

        public function logout(Request $request) {
            $user = Auth::user();

            $isAdmin = $request->isAdmin;
            $date = Carbon::now();
            $todayDdate = $date->toDayDateTimeString();
            
            $activityLog = [
                'name' => $user->name,
                'email' => $user->email,
                'description' => 'logout',
                'date_time' => $todayDdate
            ];

            DB::table('activity_logs')->insert($activityLog);
            
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerate();
            return redirect()->intended(route('login-view'))->with('success', 'You logged out!!');
    
        }

}
