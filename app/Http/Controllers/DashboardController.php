<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Models\Mission;
use App\Models\Department;
use App\Models\Employee;

use Log;
use DB;

class DashboardController extends Controller
{
	public function index(Request $request){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }
		
        $user = Auth::user();
        Log::debug($user);

		$ActiveAction = "dashboard";
        if($user["department"] != "Admin"){
		    $Data = Mission::where("department",$user["department"])->get();
        } else {
            $Data = Mission::get();
        }

        if($request->start_date != ""){
            $Data = $Data->where("start_date", ">=", $request->start_date." 00:00:00");
        }

        if($request->end_date != ""){
            $Data = $Data->where("end_date", "<=", $request->end_date." 23:59:59");
        }

        if($request->number != ""){
            $Data = $Data->where("id", $request->number);
        }

        if($request->department != ""){
            $Data = $Data->where("department", $request->department);
        }

        Log::debug($Data);
		return view('dashboard', compact("Data","ActiveAction"));
    }

	public function dashboardAdmin(){
		//for admin users.. show this
	}

	public function dashboardSuperAdmin(){
		//for super admin.. show this
	}


}