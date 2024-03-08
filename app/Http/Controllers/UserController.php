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
		$Data = User::get();

        // if($request->start_date != ""){
        //     $Data = $Data->where("start_date", ">=", $request->start_date." 00:00:00");
        // }

        // if($request->end_date != ""){
        //     $Data = $Data->where("end_date", "<=", $request->end_date." 23:59:59");
        // }

        // if($request->number != ""){
        //     $Data = $Data->where("id", $request->number);
        // }

        // if($request->department != ""){
        //     $Data = $Data->where("department", $request->department);
        // }

        Log::debug($Data);
        return view('user.view', compact("Data", "ActiveAction"));
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

    public function assignMissions(Request $request){
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
            $userObj->missions()->attach($request->missions);
            return json_encode(array("Status" =>  1, "Message" => "Mission assignment success"));
        } catch(Exception $e){
            Log::error($e);
            return json_encode(array("Status" =>  0, "Message" => "Mission assignment failed"));
        }
    }

    public function unAssignMissions(Request $request){
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

            $userObj->missions()->sync($missions);
            return json_encode(array("Status" =>  1, "Message" => "Mission assignment success"));
        } catch(Exception $e){
            Log::error($e);
            return json_encode(array("Status" =>  0, "Message" => "Mission assignment failed"));
        }
    }
}