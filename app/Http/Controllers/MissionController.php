<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Classes\Status;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Export\MissionExport;
use App\Models\Mission;
use App\Models\User;
use App\Models\Department;
use App\Models\Country;
use App\Models\Employee;

use Log;
use DB;
use Excel;

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
        if($user["department"] != "Admin"){
		    $Data = Mission::where("department",$user["department"])->orderBy("created_at", "DESC")->get();
        } else {
            $Data = Mission::orderBy("created_at", "DESC")->get();
        }

        if($request->end_date != ""){
            $Data = $Data->where("start_date", "<=", $request->end_date." 23:59:59");
        }

        if($request->start_date != ""){
            $Data = $Data->where("end_date", ">=", $request->start_date." 00:00:00");
        }

        if($request->number != ""){
            $Data = $Data->where("id", $request->number);
        }

        if($request->mission_id != ""){
            $Data = $Data->where("id", $request->mission_id);
        }

        if(isset($request->export) && $request->export == "Export"){
            return Excel::download(new MissionExport($Data), 'Mission.xlsx');
        }

        $Departments = Department::get();
        $Countries = Country::get();
        Log::debug($Data);
		return view('mission.view', compact("Data","Departments","Countries","ActiveAction"));
    }

    public function create(){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }

        $Input = $request->all();


        $ActiveAction = "Mission";
        return view('mission.add', compact("ActiveAction"));
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

            $MissionObj->type = $request->type;
            $MissionObj->allowance_percentage = $request->allowance;        
            $MissionObj->purpose = $request->purpose;
            $MissionObj->country = $request->country;
            $MissionObj->city = $request->city;
            $MissionObj->section = $request->section;
            $MissionObj->directorate = $request->directorate;

            $MissionObj->department = $request->department;
            $MissionObj->num_of_staff = $request->num_of_staff;

            $MissionObj->num_of_days = $request->num_of_days;
            $MissionObj->num_of_nights = $request->num_of_days - 1;

            $MissionObj->fees = $request->fees;
            $MissionObj->remarks = $request->remarks;

            $MissionObj->status = Status::PLANNED;

            $MissionObj->save();

            // //notify department admin for booking creation


            $response = array("status"=>"success");
            return json_encode(array("Status" =>  1, "Message" => "Mission Created Successfully"));

        } catch(Exception $e){
            Log::error($e);
            return json_encode(array("Status" =>  0, "Message" => "Mission creation failed"));
        }
    }

    public function show($id){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }
        $Data = Mission::with('users')->find($id);
        Log::debug($id);
        // $Data = Mission::with('users')->where("id",$user["department"])->get();

		$ActiveAction = "mission";

        return view('mission.show', compact("Data","ActiveAction"));
    }

    public function edit($id){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }
        $Data = Mission::with('users')->find($id);
        Log::debug($Data);

        if($Data->start_date != null || $Data->end_date != null || count($Data->users) > 0){
            Log::debug("inside conidton 1");
            $Data->status = Status::WORKING;
        }

        if($Data->start_date != null && $Data->end_date != null && count($Data->users) == $Data->num_of_staff) {
            Log::debug("inside conidton 2");
            $Data->status = Status::APPROVED;
        }
        $Data->save();


        $Departments = Department::get();
        $Countries = Country::get();

		$ActiveAction = "mission";
        return view('mission.edit', compact("Data","Departments","Countries","ActiveAction"));
    }

    public function update(Request $request, $id){
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }
        
        $mission = Mission::find($id);
        if($mission == null){
            return json_encode(array("Status" =>  0, "Message" => "Mission not found"));
        }

          // Remove the _token field from the request data
        $requestData = $request->except('_token');

        // $Input = $requestData->all();
        // Log::debug($requestData);

        Mission::where('id', $id)->update($requestData);

        $mission = Mission::with('users')->find($id);
        Log::debug($mission);

        return json_encode(array("Status" =>  1, "Message" => "Mission Updated Successfully"));
    }

    public function destroy(Mission $id)
    {
        if( !Auth::check() )
        {
            return redirect()->route('login')
                ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
        }


        return json_encode(array("Status" =>  1, "Message" => "Mission Deleted Successfully"));
    }

    public function getMissions(Request $request){
        try {
            if( !Auth::check() )
            {
                return redirect()->route('login')
                    ->withErrors([
                    'email' => 'Please login to access the dashboard.',
                ])->onlyInput('email');
            }
            
            $user = User::find($request->user_id);
            Log::debug("inside mission controller - " . $user);

            $Data = Mission::where("department",$user["department"])->get();

            Log::debug($Data);
            return json_encode(array("Status" =>  1, "Data" => $Data ,"Message" => "Mission fetched successfully"));
        } catch(Exception $e){
            Log::error($e);
            return json_encode(array("Status" =>  0, "Message" => "Mission fetch failed"));
        }
    }

}