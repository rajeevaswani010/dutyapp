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
use App\Models\User;
use App\Models\GradeAllowance;

use Log;
use DB;

class UserController extends Controller
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

        $ActiveAction = "user";
		// $Data = User::get();
        $Data = User::with('missions')->get();


        if($request->emp_id != ""){
            $Data = $Data->where("employee_id", $request->emp_id);
        }

        if($request->department != ""){
            $Data = $Data->where("department", $request->department);
        }
        $Departments = Department::get();

        Log::debug($Data);
        return view('user.view', compact("Data","Departments", "ActiveAction"));
    }

    public function create(Request $request){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }
		
        $user = Auth::user();
        Log::debug($user);

        $Data = array();
        $ActiveAction = "user";
        return view('user.add', compact("Data", "ActiveAction"));
    }

    public function store(Request $request){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }

        $Input = $request->all();

        return json_encode(array("Status" =>  1, "Message" => "Mission Recorded Successfully"));
    }

    public function show(Request $request){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }

        $Input = $request->all();

        return view('mission.show', compact("ActiveAction"));
    }

    public function edit(Request $request){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }

        $Input = $request->all();

        return view('mission.edit', compact("ActiveAction"));
    }

    public function update(Request $request){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }

        $Input = $request->all();

        return json_encode(array("Status" =>  1, "Message" => "Mission Updated Successfully"));
    }

    public function destroy($id)
    {
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }

        $Input = $request->all();

        return json_encode(array("Status" =>  1, "Message" => "Mission Deleted Successfully"));
    }

    public function assignUserToMissions(Request $request){
        try {
            if( !Auth::check() )
            {
                return redirect()->route('login')
                    ->withErrors([
                    'email' => 'Please login to access the dashboard.',
                ])->onlyInput('email');
            }
            $Input = $request->all();
            Log::info($request);

            $userObj = User::find($request->user_id);
            // $userObj->missions()->syncWithoutDetaching($request->missions);

            foreach($request->missions as $missionId){
                $mission = Mission::find($missionId);
                // $userobjGrade = Employee::select("grade")->where("employee_id",$userObj->employee_id)->first();
                $userobjGrade = $userObj->grade;
                Log::debug("user grade - ".$userobjGrade);
                $allowance = 0;
                if($mission->type == "internal"){
                    $allowance = GradeAllowance::select("allowance as allowance")->where("grade",$userobjGrade)->first();
                } else {
                    $allowance = GradeAllowance::select("allowance_ext as allowance")->where("grade",$userobjGrade)->first();
                }
                Log::debug("user allowance - ".$allowance);
                $total_allowance = $allowance["allowance"] * $mission->num_of_days * $mission->allowance_percentage/100;
                $userObj->missions()->attach($missionId,['allowance_percent' => $mission->allowance_percentage, 'allowance' => $total_allowance]);

                foreach ($mission->users as $user) {
                    Log::debug("user allowance - ".$user->pivot->allowance);
                }
            }

            return json_encode(array("Status" =>  1, "Message" => "Mission assignment success"));
        } catch(Exception $e){
            Log::error($e);
            return json_encode(array("Status" =>  0, "Message" => "Mission assignment failed"));
        }
    }

    public function unAssignUserFromMissions(Request $request){
        try {
            if( !Auth::check() )
            {
                return redirect()->route('login')
                    ->withErrors([
                    'email' => 'Please login to access the dashboard.',
                ])->onlyInput('email');
            }
            $Input = $request->all();
            Log::info($request);

            $userObj = User::find($request->user_id);

            $userObj->missions()->detach($request->missions);
            return json_encode(array("Status" =>  1, "Message" => "Mission detachment success"));
        } catch(Exception $e){
            Log::error($e);
            return json_encode(array("Status" =>  0, "Message" => "Mission detach failed"));
        }
    }

    public function getUsers(Request $request){
        try {
            if( !Auth::check() )
            {
                return redirect()->route('login')
                    ->withErrors([
                    'email' => 'Please login to access the dashboard.',
                ])->onlyInput('email');
            }
            
            $mission = Mission::find($request->mission_id);
            Log::debug("inside user controller - " . $mission);

            // $Data = User::where("department",$mission["department"])->get();
            $Data =User::where("department",$mission["department"])
                ->whereDoesntHave('missions', function ($query) use($request) {
                    $query->where('mission_id', $request->mission_id);
                })->get();

            return json_encode(array("Status" =>  1, "Data" => $Data ,"Message" => "Users fetched successfully"));
        } catch(Exception $e){
            Log::error($e);
            return json_encode(array("Status" =>  0, "Message" => "User fetch failed."));
        }
    }

}