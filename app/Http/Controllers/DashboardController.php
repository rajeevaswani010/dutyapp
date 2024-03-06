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
	public function index(){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }
		
		$ActiveAction = "dashboard";
		$Data = Mission::get();
        Log::debug($Data);
		return view('auth.dashboard', compact("Data","ActiveAction"));
    }

	public function dashboardAdmin(){
		//for admin users.. show this
	}

	public function dashboardSuperAdmin(){
		//for super admin.. show this
	}


}