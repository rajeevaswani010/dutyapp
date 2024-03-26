@extends('layouts')

@section('content')
<style>
    .label{
        font-weight: 600;
        color: rgba(1, 41, 112, 0.6);
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Mission</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Missions</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">  <!-- 2 row layout -->

            <!-- column 1 starts-->
            
            <div class="col-lg-12">
                <!-- mission status card -->
                <div class="card">
                    <div class="p-3" style="display:flex;">
                        <h3 class="p-0" style="flex:1;">Mission# {{ $Data->id }}</h3>
                        @if($Data->status == 1)
                            <span
                                class="indicator-line rounded bg-secondary status planned">{{ __("Planned") }}</span>
                        @elseif($Data->status == 2)
                            <span
                                class="indicator-line rounded bg-yellow status working">{{ __("Working") }}</span>
                        @elseif($Data->status == 3)
                            <span
                                class="indicator-line rounded bg-success  status approved">{{ __("Approved") }}</span>
                        @elseif($Data->status == 4)
                            <span
                                class="indicator-line rounded bg-primary status active">{{ __("Active") }}</span>
                        @elseif($DataT->status == 5)
                            <span
                                class="indicator-line rounded bg-info status complete">{{ __("Complete") }}</span>
                        @elseif($Data->status == 0)
                            <span
                                class="indicator-line rounded bg-danger status cancelled">{{ __("Cancelled") }}</span>
                        @endif
                    </div>
                </div>
                <!-- mission status card ENDs-->
                
                <div class="row">
                    <!-- mission duration and info card -->
                    <div class="col-lg-6">
                        <!-- mission duration card START -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title p-0">Missions Dates</h5>
                                <button type="button" title="Edit Mission"
                                    class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                                    data-bs-target="#editMissionDurationAndResourceModal" 
                                    data-id="{{ $Data->id }}">Edit</button>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row">

                                    <div class="col-lg-6 mb-3">
                                        <div class="label mb-1">Start Date</div>
                                        <div> 
                                            @if( empty($Data->start_date) )
                                                -
                                            @else 
                                                {{ $Data->start_date }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="label mb-1">End Date</div>
                                        <div> 
                                            @if( empty($Data->end_date) )
                                                -
                                            @else 
                                                {{ $Data->end_date }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- mission duration card END -->

                        <!-- info card - start -->
                        <div class="card">
                        <div class="card-header">
                            <h5 class="card-title p-0">Information</h5>
                            <button type="button" title="Edit Mission"
                                class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                                data-bs-target="#editMissionModal" 
                                data-id="{{ $Data->id }}">Edit</button>
                        </div>
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="label mb-1">Purpose</div>
                                    <div>{{ $Data->purpose }}</div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="label mb-1">Type</div>
                                    <div>
                                        @if ($Data->type == "external")
                                            {{ __("Outside") }}
                                        @elseif ($Data->type == "internal")
                                            {{ __("Inside") }}
                                        @else
                                            {{ __("????") }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="label mb-1">Country</div>
                                    <div>{{ $Data->country }}</div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="label mb-1 col-lg-3">City</div>
                                    <div>{{ $Data->city }}</div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="label mb-1">Section</div>
                                    <div>{{ $Data->section }}</div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="label mb-1">Directorate</div>
                                    <div>{{ $Data->directorate }}</div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="label mb-1">Department</div>
                                    <div>{{ $Data->department }}</div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="label mb-1">Required Staff</div>
                                    <div>{{ $Data->num_of_staff }}</div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="label mb-1">Number of Days</div>
                                    <div>{{ $Data->num_of_days }}</div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="label mb-1">Mission Fees</div>
                                    <div>
                                        @if($Data->fees == null)
                                            0 OMR
                                        @else 
                                            {{ $Data->fees }} OMR
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="label mb-1">Allowance</div>
                                    <div>{{ $Data->allowance_percentage }} %</div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="label mb-1">Remarks</div>
                                    <div>{{ $Data->remarks }}</div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- info card - end -->
                    </div>
                    <!-- mission duration and info card ENDS -->
                    
                    <!-- mission department resources  -->
                    <div class="col-lg-6">
                        <!-- mission resource card START -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title p-0">Missions Resources Summary</h5>
                                <!-- <button type="button" title="Edit Mission"
                                    class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                                    data-bs-target="#editMissionResourceModal" 
                                    data-id="{{ $Data->id }}">Edit</button> -->
                            </div>
                            <div class="card-body pt-3">
                                <div class="row">
                                    <!-- donut chart -->
                                    <div id="resourceChart" class="col-lg-12">

                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="label mb-1">Department</div>
                                        <div>{{ $Data->department }}</div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="label mb-1">Assigned Staff / Required Staff</div>
                                        @if( count($Data->users) == $Data->num_of_staff )
                                        <span
                                            style="font-size:1rem;font-weight:600;color:#fff;background:#11d755;padding:0.25rem 1rem 0.25rem 1rem;">
                                            {{ count($Data->users) }} / {{ $Data->num_of_staff }}
                                        </span>
                                        @else
                                        <span
                                            style="font-size:1rem;font-weight:600;color:#fff;background:red;padding:0.25rem 1rem 0.25rem 1rem;">
                                            {{ count($Data->users) }} / {{ $Data->num_of_staff }}
                                        </span>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- mission resource card END -->
                    </div>
                    <!-- mission start end and department resources  END -->            
                </div>

            </div>

            <!-- column 1 ends -->

            <!-- column 2 starts -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- assign users  table start -->
                    <div class="card">
                        <div class="card-header ">
                                <div class="col-lg-9">
                                    <h5 class="card-title p-0">Assigned Users</h5>
                                </div>
                                <div class="col-lg-3">
                                    @if( count($Data->users)  >=  $Data->num_of_staff )
                                        <button type="button" title="Assign Missions" class="btn btn-primary btn-sm "
                                            data-bs-toggle="modal" data-bs-target="#assignMissionModal"
                                            onclick="onAssignMission()" data-id="{{ $Data->id }}"
                                            style="float:right;" disabled>Assign</button>
                                    @else
                                        <button type="button" title="Assign Missions" class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#assignMissionModal"
                                            onclick="onAssignMission()" data-id="{{ $Data->id }}" style="float:right;">Assign</button>
                                    @endif
                                </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="assignedUserTable" class="datatable display pt-3 pb-3">
                                    <thead>
                                        <tr>
                                            <th>{{ __("Name") }}</th>
                                            <th>{{ __("Emp Id") }}</th>
                                            <th>{{ __("Department") }}</th>
                                            <th>{{ __("Designation") }}</th>
                                            <th>{{ __("Phone") }}</th>
                                            <th>{{ __("Email") }}</th>
                                            <th>{{ __("Allowance Percentage") }}</th>
                                            <th>{{ __("Total Allowance") }}</th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Data->users as $user)
                                            <tr class="font-style">
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->employee_id }}</td>
                                                <td>{{ $user->department }}</td>
                                                <td>{{ $user->designation }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->pivot->allowance_percent }}</td>
                                                <td>{{ $user->pivot->allowance }}</td>
                                                <td> 
                                                    <button type="button" title="Edit User"
                                                        class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editMissionUserModal" 
                                                        data-id="{{ $Data->id }}">Edit</button>
                                                    <button onclick="unAssignMission()" data-arg="{{ $user->id }}"
                                                        class="btn btn-danger btn-sm">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                    <!-- assign users table end -->

                </div>
            </div>
            <!-- column 2 ends -->
        </div>
    </section>
<script>
    $(document).ready(function(){
        var datatable = new DataTable('.datatable',{
            fixedColumns: {
                end: 1
            }
        });

        // radial bar chart - start
            // based on assigned user / total required user percentage.

        var assignedUsers = '{{ count($Data->users) }}';
        var requiredUsers = '{{ $Data->num_of_staff }}';
        var percentage = (assignedUsers/requiredUsers)*100

        var options = {
          series: [percentage],
          chart: {
          height: 480,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
            hollow: {
              size: '70%',
            }
          },
        },
        labels: ['Assigned Staff'],
        };

        var chart = new ApexCharts(document.querySelector("#resourceChart"), options);
        chart.render();

        // radial bar chart - end
});

</script>
</main><!-- End #main -->

<!-- editMission Modal - start -->
<div class="modal fade" id="editMissionModal" tabindex="-1" role="dialog" aria-labelledby="editMissionModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" id="editMissionModal">{{ __("Edit Mission") }}</h3>
                            <button class="btn btn-danger btn-sm window-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    {!! Form::open(['id' => 'editMission']) !!}
                                    <div class="row form-content">
                                        <div class="form-group col-md-4 mb-1">
                                            <label for="type"
                                                class="col-form-label text-dark">{{ __("Type") }}</label>
                                            <select class="form-control" name="type" id="type" value="" required>
                                                <option value="internal">{{ __("Inside") }}</option>
                                                <option value="external">{{ __("Outside") }}</option>
                                            </select>
                                            <script>
                                                    var jsVariable = {!! json_encode($Data->type) !!};
                                                    $('#editMissionModal #type').val(jsVariable);
                                            </script>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="form-group col-md-4 mb-1">
                                            <label for="type"
                                                class="col-form-label text-dark">{{ __("Allowance") }}</label>
                                            <select class="form-control" name="allowance_percentage" id="allowance_percentage" value="{{ $Data->allowance_percentage }}" required>
                                                <option value="0">0</option>
                                                <option value="25">25%</option>
                                                <option value="50">50%</option>
                                                <option value="75">75%</option>
                                                <option value="100" selected>100%</option>
                                            </select>
                                            <script>
                                                    var jsVariable = {!! json_encode($Data->allowance_percentage) !!};
                                                    console.log("var - "+jsVariable);
                                                    $('#editMissionModal #allowance_percentage').val(jsVariable);
                                            </script>
                                        </div>

                                        <div class="form-group col-md-12 mb-1">
                                            <label for="purpose"
                                                class="col-form-label text-dark">{{ __("Purpose") }}</label>
                                            <textarea class="form-control font-style" row=2 name="purpose" id="purpose" value="" required >{{ $Data->purpose }}</textarea>
                                        </div>

                                        <div class="form-group col-md-6 mb-1">
                                            <label for="country"
                                                class="col-form-label text-dark">{{ __("Country") }}</label>
                                            <select class="form-control" name="country" id="country">
                                                <option value="">{{ __("--Select Country--") }}
                                                </option>
                                                @foreach($Countries as $country)
                                                    <option value={{ $country['name'] }}>
                                                        {{ $country['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <script>
                                                    var jsVariable = {!! json_encode($Data->country) !!};
                                                    console.log("var - "+jsVariable);
                                                    $('#editMissionModal #country').val(jsVariable);
                                            </script>
                                        </div>
                                        
                                        <div class="form-group col-md-6  mb-1">
                                            <label for="city"
                                                class="col-form-label text-dark">{{ __("City") }}</label>
                                            <input class="form-control font-style" name="city" type="text" id="city" 
                                                value="{{ $Data->city }}" required />
                                        </div>
                                                                                
                                        <div class="form-group col-md-4  mb-1">
                                            <label for="section"
                                                class="col-form-label text-dark">{{ __("Section") }}</label>
                                            <input class="form-control font-style" name="section" type="text"
                                                id="section" value="{{ $Data->section }}" />
                                        </div>

                                        <div class="form-group col-md-8  mb-1">
                                            <label for="directorate"
                                                class="col-form-label text-dark">{{ __("Directorate") }}</label>
                                            <input class="form-control font-style" name="directorate" type="text"
                                                id="directorate"  value="{{ $Data->directorate }}" />
                                        </div>

                                        <div class="form-group col-md-12  mb-1">
                                            <label for="department"
                                                class="col-form-label text-dark">{{ __("Department") }}</label>
                                            <select class="form-control" name="department" id="department">
                                                <option value="" required> {{ __("--Select Department--") }}
                                                </option>
                                                @foreach($Departments as $department)
                                                    <option value={{ $department['name'] }}>
                                                        {{ $department['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <script>
                                                    var jsVariable = {!! json_encode($Data->department) !!};
                                                    console.log("var - "+jsVariable);
                                                    $('#editMissionModal #department').val(jsVariable);
                                            </script>
                                        </div>

                                        <div class="form-group col-md-5 col-sm-12  mb-1">
                                            <label for="num_of_emp"
                                                class="col-form-label text-dark">{{ __("Number of Employees") }}</label>
                                            <input class="form-control font-style" name="num_of_staff" type="number"
                                                id="num_of_staff" value="{{ $Data->num_of_staff }}" required min="0" step="1" required/>
                                        </div>

                                        <div class="form-group col-md-5 col-sm-12  mb-1">
                                            <label for="num_of_days"
                                                class="col-form-label text-dark">{{ __("Number of Days") }}</label>
                                            <input class="form-control font-style" name="num_of_days" type="number"
                                                id="num_of_days" value="{{ $Data->num_of_days }}" required min="0" step="1" />
                                        </div>

                                        <div class="form-group col-md-8 col-sm-12  mb-1">
                                            <label for="fees"
                                                class="col-form-label text-dark">{{ __("Mission Fees") }}</label>
                                            <div class="row">
                                                <div class="col-8">
                                                    <input class="form-control hidestep text-end font-style" name="fees" type="number"
                                                        id="fees" value="{{ $Data->fees }}" required min="0"/>
                                                </div>
                                                <div class="col-4">( OMR )</div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="remarks"
                                                class="col-form-label text-dark">{{ __("Remarks") }}</label>
                                            <textarea class="form-control font-style" name="remarks" id="remarks"
                                                placeholder="enter remarks" rows=3>{{ $Data->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div style="float:right;">
                                <button type="button" class="btn btn-danger" style="margin-right: 2rem;" data-bs-dismiss="modal">{{ __("Close") }}</button>
                                <input class="btn btn-xs btn-primary" type="submit" value='{{ __("Send") }}'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    $("#editMission").submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();

        // console.log(formData);
        $.ajax({
                url: "{{ route('mission.update', ['mission' => $Data->id]) }}", // URL to your update route
                method: 'PUT', // Use PUT method for updating
                data: formData, // Form data
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Redirect or update the UI as needed
                    alert("mission updated successfully")
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                    alert("mission update failed")
                }
        });
    });
</script>
<!-- editMission Modal - ends -->

<!-- assign mission modal - start -->
<div class="modal fade" id="assignMissionModal" tabindex="-1" role="dialog" aria-labelledby="assignMissionModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <!-- <div id="missions">
                    <div id="missionList">
                        Loading...
                    </div>
                </div> -->

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-bs-dismiss="modal">{{ __("Close") }}</button>
                <button class="btn btn-xs btn-primary" type="button" id="assignMissions">
                    {{ __("Save") }}</button>
            </div> -->
        </div>
    </div>
</div>
<!-- assign mission modal - ends -->


<!-- editMissionDurationAndResource Modal - start -->
<div class="modal fade" id="editMissionDurationAndResourceModal" tabindex="-1" role="dialog" aria-labelledby="editMissionDurationAndResourceModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __("Edit Mission Dates") }}</h3>
                            <button class="btn btn-danger btn-sm window-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    {!! Form::open(['id' => 'editMissionDurationAndResource']) !!}
                                    <div class="row form-content">
                                        <div class="row">
                                            <div class="form-group col-lg-6  mb-3">
                                                <label for="start_date"
                                                    class="col-form-label text-dark mb-1">{{ __("Start Date") }}</label>
                                                <input class="form-control hidestep text-end font-style" name="start_date"
                                                    type="date" id="start_date" value="{{ $Data->start_date }}" required
                                                    />
                                            </div>
                                            <div class="form-group col-lg-6  mb-3">
                                                <label for="start_date"
                                                    class="col-form-label text-dark mb-1">{{ __("End Date") }}</label>
                                                <input class="form-control hidestep text-end font-style" name="end_date"
                                                    type="date" id="end_date" value="{{ $Data->end_date }}"
                                                    />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 mb-3">
                                            <label for="num_of_days"
                                                class="col-form-label text-dark mb-1">{{ __("Number of Days") }}</label>
                                            <input class="form-control font-style" name="num_of_days" type="number"
                                                id="num_of_days" value="{{ $Data->num_of_days }}" required min="0"
                                                step="1" />
                                        </div>
                                        <script>
                                            $('#num_of_days').on('input', function(){
                                                var val = $(this).val();
                                                var currentDate = new Date($Data->start_date); // Get current date
                                                var futureDate = new Date(currentDate.getTime() + (n * 24 * 60 * 60 * 1000)); // Add n days
                                                // $('#end_date').val
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div style="float:right;">
                                <button type="button" class="btn btn-danger" style="margin-right: 2rem;" data-bs-dismiss="modal">{{ __("Close") }}</button>
                                <input class="btn btn-xs btn-primary" type="submit" value='{{ __("Send") }}'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    $("#editMissionDurationAndResource").submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();

        // console.log(formData);
        $.ajax({
                url: "{{ route('mission.update', ['mission' => $Data->id]) }}", // URL to your update route
                method: 'PUT', // Use PUT method for updating
                data: formData, // Form data
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Redirect or update the UI as needed
                    alert("mission updated successfully")
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                    alert("mission update failed")
                }
        });
    });
</script>

<!-- editMissionUser Modal - start -->
<div class="modal fade" id="editMissionUserModal" tabindex="-1" role="dialog" aria-labelledby="editMissionUserModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __("Edit User") }}</h3>
                            <button class="btn btn-danger btn-sm window-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                {!! Form::open(['id' => 'editMissionUser']) !!}
                                        <div class="row form-content">

                                        </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div style="float:right;">
                                    <button type="button" class="btn btn-danger" style="margin-right: 2rem;" data-bs-dismiss="modal">{{ __("Close") }}</button>
                                    <input class="btn btn-xs btn-primary" type="submit" value='{{ __("Send") }}'>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    $("#editMissionUser").submit(function (event) {
        var formData = $(this).serialize();

        // console.log(formData);
        $.ajax({
            //todo
        });
    });
</script>


<script>
    document.querySelector("#myEventRouter").addEventListener("userassigned", (event) => {
        console.log(event);
        alert("user assigned successfully");
    });

    function unAssignMission(){
        event.preventDefault();

        console.log("inside uassign missions");
        var missions = [{{ $Data->id }}];

        var form_data = {
            user_id: event.target.getAttribute('data-arg'),
            missions: missions
        }

        $.ajax({
            url: "{{ URL('/unassignuserfrommissions') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            dataType: "json",
            encode: true,
            success: function (data, textStatus, jqXHR) {
                console.log("operation performed successfully");
                toastr["success"](data.Message);
                // window.location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // hideloading();
                alert("error");
            }
        });

    };
   
    function onAssignMission(){
        event.preventDefault();

        var mission_id = event.target.dataset.id;
        var userSelected = {};


        $("#assignMissionModal").css("display", "block");
        $('#assignMissionModal .modal-body').html("");

        var panel = $('<div id="userlistpanel" class="panel panel-default">');
        var panelHeader = $('<div class="panel-header">');
        panelHeader.append('<div class="row"><div class="col-lg-6"><h3 class="col-lg-9 card-title">Select User</h3></div> \
            <div class="col-lg-6"><div class="input-group mb-3"> \
            <input type="text" class="form-control" placeholder="Search..." id="search" aria-label="Search" value="ttt" aria-describedby="basic-addon2"> \
            <div class="input-group-append"> \
                <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i>\
                </button> \
            </div></div></div></div>');

        var panelBody = $('<div class="panel-body" style="margin-top:1rem;">');
        var userList = $('<div>');
        userList.html("Loading data...");
        panelBody.append(userList);
        var panelFooter = $('<div class="panel-footer">');

        panel.append(panelHeader);
        panel.append(panelBody);
        panel.append(panelFooter);

        // Append panel to modal body
        $('#assignMissionModal .modal-body').append(panel);
        

        var form_data = {
            mission_id: mission_id,
            filter: $('#userlistpanel #search').val()
        }
        let callbacks = {
            success: function (data) {
                userList.html("");
                console.log(data);
                let tableData = data;

                // Create a table element
                var table = $('<table id="userTable" class="table table-hover datatable" style="width:100%;">');
                var tbody = $('<tbody>');

                // Create a table header row
                var headerRow = $('<thead>');

                headerRow.append('<th></th>');

                // Add table headers
                // for (var key in tableData[0]) {
                //     headerRow.append('<th>'+key.toUpperCase()+'</th>');
                // }
                    headerRow.append('<th>{{ __("Username") }}</th>');
                    headerRow.append('<th>{{ __("Id") }}</th>');
                    headerRow.append('<th>{{ __("Designation") }}</th>');
                    headerRow.append('<th>{{ __("Department") }}</th>');
                    headerRow.append('<th>{{ __("Phone") }}</th>');
                    headerRow.append('<th>{{ __("Gender") }}</th>');
                    headerRow.append('<th>{{ __("Email") }}</th>');
                
                table.append(headerRow);

                // Create and populate the table rows with data
                tableData.forEach(function (item) {
                    var row = $('<tr>');

                    var checkboxCell = $('<td>');
                    var checkbox = $('<input type="checkbox">');
                    checkbox.attr('data-arg',item.id);
                    checkbox.addClass('formcheckinput');
                    checkboxCell.append(checkbox);

                    row.append(checkboxCell);
                    // row.on("click", function() {
                    //     // Toggle row selection on click
                    //     // checkbox.checked = !(checkbox.checked);
                    //     checkbox.prop('checked', function(i, val) {
                    //         return !val; // Invert current checked state
                    //     });
                    // }); 

                    checkbox.on('change', function (event) {
                        event.stopPropagation(); // Stop event propagation

                        var id = event.target.dataset.arg;
                        console.log(id);
                        if (event.target.checked) {
                            userSelected[id] = 1;
                        } else {
                            delete userSelected[id];
                        }
                    })

                    // for (var key in item) {
                        row.append('<td>'+item["name"]+'</td>');
                        row.append('<td>'+item["employee_id"]+'</td>');
                        row.append('<td>'+item["designation"]+'</td>');
                        row.append('<td>'+item["department"]+'</td>');
                        row.append('<td>'+item["phone"]+'</td>');
                        row.append('<td>'+item["gender"]+'</td>');
                        row.append('<td>'+item["email"]+'</td>');
                    // }
                    tbody.append(row);
                });
                table.append(tbody);
                var newDiv = $('<div class="table table-responsive p-3" style="max-height:600px; overflow: scroll;">');
                newDiv.append(table);
                userList.append(newDiv);

                var table2 = new DataTable('#userTable',{
                    fixedColumns: true
                });
            },

            failure: function (errmsg) {
                $("#assignMissionModal").css("display", "block");
                userList.html(errmsg);
            }
        };

        // get users details to assign for the mission.. 
        $.ajax({
            url: "{{ URL('/getUsers') }}",
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            dataType: "json",
            encode: true,
            success: function (data, textStatus, jqXHR) {
                console.log("mission fetched successfully");
                callbacks.success(data.Data);
                // window.location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // hideloading();
                alert("error");
                callbacks.failure("fail to fetch data");
            }
        });

        var btnClose = $('<button class="btn btn-danger" data-bs-dismiss="modal">close</button>');
        panelFooter.append(btnClose);

        var btnSubmit = $('<button class="btn btn-primary">Submit</button>');
        panelFooter.append(btnSubmit);
        btnSubmit.on('click',function(event){
            event.preventDefault();

            console.log("inside assign missions");
            console.log(userSelected)
            var missions = [mission_id];
            for (var key in userSelected) {

                var form_data = {
                    user_id: key,
                    missions: missions
                }

                $.ajax({
                    url: "{{ URL('/assignusertomissions') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    dataType: "json",
                    encode: true,
                    success: function (data, textStatus, jqXHR) {
                        console.log("operation performed successfully");
                        $("#assignMissionModal").modal('hide');
                        toastr["success"](data.Message);
                        // window.location.reload();
                        const myevent = createUserAssignedEvent();
                        document.querySelector("#myEventRouter").dispatchEvent(myevent);

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // hideloading();
                        alert("error");
                    }
                });
            }
        });
            
    }

</script>


@endsection
