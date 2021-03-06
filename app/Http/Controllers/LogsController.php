<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\activityLog;
use App\Models\Holidays;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LogsController extends Controller
{
    public function acitivityLogInLogOut(Request $request){
        if($request->ajax()){
            $data= activityLog::query()->orderBy("id", "desc");

            return DataTables::of($data)
                ->addIndexColumn()->addColumn('action', function($row){
                    $btn= '<a href="'.route('delete-log', ['id' => $row->id]).'"class=dit btn btn-primay btn-sm><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])->make(true);


        }

        return view('users.admin.logsPage');
    }

    public function destroyLog($id){
        $logs = activityLog::findOrFail($id);
        $logs->delete();
        return redirect()->intended(route('activity-logIn-logOut'))->with('success', 'Log Deleted Successfully');
    }
}
