<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Models\Mission;
use App\Models\User;
use App\Models\Department;
use App\Models\Employee;

use Log;
use DB;

class MissionController extends Controller
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
        Log::debug("inside mission controller - " . $user);

		$ActiveAction = "dashboard";
		$Data = Mission::where("department",$user["department"])->get();

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
		return view('auth.dashboard', compact("Data","ActiveAction"));
    }

    public function create(Request $request){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }

        $Input = $request->all();


        $ActiveAction = "Mission";
        $Conuntry = Country::orderBy("name")->get();
        return view('Mission.add', compact("ActiveAction", "Conuntry", "Requirements", "CustomerId", "InviteId"));
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

    public function add(Request $request){
        try {
            if( !Auth::check() )
            {
                return redirect()->route('login')
                    ->withErrors([
                    'email' => 'Please login to access the dashboard.',
                ])->onlyInput('email');
            }

            Log::info($request);

            //create mission obj.
            $MissionObj = new Mission();

            //set attributes
            $MissionObj->purpose = $request->purpose;
            $MissionObj->country = $request->country;
            $MissionObj->city = $request->city;
            $MissionObj->num_of_days = $request->num_of_days;
            $MissionObj->num_of_nights = $request->num_of_nights;
            $MissionObj->section = $request->section;
            $MissionObj->department = $request->department;
            $MissionObj->directorate = $request->directorate;
            $MissionObj->num_of_staff = $request->num_of_staff;
            $MissionObj->travelling_area_from = $request->travelling_area_from;
            $MissionObj->start_date = $request->start_date;
            $MissionObj->end_date = $request->end_date;
            $MissionObj->travel_start_date = $request->travel_start_date;
            $MissionObj->travel_return_date = $request->travel_return_date;
            $MissionObj->remarks = $request->remarks;
            $MissionObj->air_ticket_required = ($request->air_ticket_required == true)?1:0;
            $MissionObj->vehicle_required = ($request->vehicle_required == true )?1:0;

            $MissionObj->save();

            // //notify department admin for booking creation


            $response = array("status"=>"success");
            return json_encode(array("Status" =>  1, "Message" => "Mission Created Successfully"));

        } catch(Exception $e){
            Log::error($e);
            return json_encode(array("Status" =>  0, "Message" => "Mission creation failed"));
        }
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

    public function getMissions(Request $request){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }
		
        $user = User::find($request->user_id);
        Log::debug("inside mission controller - " . $user);

		$ActiveAction = "dashboard";
		$Data = Mission::where("department",$user["department"])->get();

        Log::debug($Data);
        return json_encode(array("Status" =>  1, "Data" => $Data ,"Message" => "Mission fetched successfully"));
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
}