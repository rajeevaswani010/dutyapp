@extends('auth.layouts')

@section('content')

<!-- <div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-success">
                        You are logged in!
                    </div>       
                @endif                
            </div>
        </div>
    </div>    
</div> -->
    

<div class="row justify-content-center mt-5">
    <div class="col-lg-12">

        <div class="row">
            <div class="col-sm-12">
                <div class="header">
                    <h2>Users</h2>
                    <button type="button" title="Create Mission" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createMissionModal">Add</button>
                </div>
                <!-- filter start -->
                <form>
                    <div class="bg-light p-4">
                        <div class="row row align-items-end m-1">

                            <div class="col-md-2">
                                <label>{{ __("Department") }}</label>
                                <input type="text" class="form-control" id="department" name="department" value="{{ @$_GET['department'] }}">
                            </div>

                            <div class="col"><button class="btn btn-primary" role="button">{{ __("Search") }}</button></div>
                        </div>
                    </div>
                </form>
                <!-- filter end -->

                <div class="bg-light mt-4 p-4">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __("Username") }}</th>
                                        <th>{{ __("Employee Id") }}</th>
                                        <th>{{ __("Designation") }}</th>
                                        <th>{{ __("Department") }}</th>
                                        <th>{{ __("Gender") }}</th>
                                        <th>{{ __("Phone") }}</th>
                                        <th>{{ __("Email") }}</th>
                                        <th>{{ __("Address") }}</th>
                                        <th>{{ __("Date of Birth") }}</th>
                                        <th>{{ __("Date of Joining") }}</th>
                                        <th>{{ __("Active") }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($Data as $DT)

                                        <tr class="font-style">
                                            <td>{{ $DT->name }}</td>
                                            <td>{{ $DT->employee_id }}</td>
                                            <td>{{ $DT->designation }}</td>
                                            <td>{{ $DT->department }}</td>
                                            <td>{{ $DT->gender }}</td>
                                            <td>{{ $DT->phone }}</td>
                                            <td>{{ $DT->email }}</td>
                                            <td>{{ $DT->address }}</td>
                                            <td>{{ $DT->dob }}</td>
                                            <td>{{ $DT->doj }}</td>
                                            <td>{{ $DT->is_active }}</td>
                                            <td>
                                                <button type="button" title="Assign Missions" class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                                                    data-bs-target="#assignMissionModal" onclick="onAssignMission()" data-id="{{ $DT->id }}">Assign</button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                </div>
            <script>
                let table = new DataTable('#myTable');
            </script>
        </div>
    </div>    
</div>

<!-- Modal assign mission  START-->

<div class="modal" id="assignMissionModal"  tabindex="-1" role="dialog" aria-labelledby="assignMissionModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignMissionModal">{{ __("Select Mission") }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="missions">
                    <div id="missionList">
                        Loading...
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __("Close") }}</button>
                <input class="btn btn-xs btn-primary" type="submit" id="assignMissions" value='{{ __("Send") }}'>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    function onAssignMission(user_id){
        var user_id = event.target.dataset.id;
        var missionSelected = {};

        $("#assignMissionModal").css("display", "block");
        $("#missionList").html("Loading...");

        var form_data = {
            user_id: user_id
        }


        let callbacks = {
            success: function(data){
                $("#missionList").empty();
                console.log(data);
                let tableData = data;

                // Create a table element
                var table = document.createElement("table");
                table.id = "missionTable";
                table.classList.add("table");
                table.classList.add("table-hover");
                // Create a table header row
                var headerRow = table.insertRow();
                // Add table headers
                for (var key in tableData[0]) {
                    var headerCell = headerRow.insertCell();
                    headerCell.textContent = key.toUpperCase();
                }
                // Create and populate the table rows with data
                tableData.forEach(function(item) {
                    var row = table.insertRow();
                    
                    var checkboxCell = row.insertCell();
                    var checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.dataset.arg = item.id;
                    checkbox.classList.add("form-check-input")
                    checkboxCell.appendChild(checkbox);

                    // row.addEventListener("click", function() {
                    //     // Toggle row selection on click
                    //     checkbox.checked = !(checkbox.checked);
                    // }); 
                    
                    checkbox.addEventListener("change", function(){
                        var id = event.target.dataset.arg;
                        if(event.target.checked){
                            missionSelected[id] = 1;
                        } else {
                            delete missionSelected[id];
                        }
                    })

                    for (var key in item) {
                        var cell = row.insertCell();
                        cell.textContent = item[key];
                    }
                });

                var newDiv = document.createElement("div");
                // Add a class to the div
                newDiv.classList.add("table-responsive");
                newDiv.appendChild(table);
                $("#missionList").append(newDiv);

                let missiontable = new DataTable('#missionTable'); //to activate datatable.. 
            },

            failure: function(errmsg){
                $("#assignMissionModal").css("display", "block");
                $("#missionList").html(errmsg);
            }
        }

        $.ajax({
            url: "{{ URL('mission/getAll') }}",
            method: "GET",
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            data: form_data,
            dataType: "json",
            encode: true,
            success: function( data, textStatus, jqXHR ) {
                console.log("mission fetched successfully");
                callbacks.success(data.Data);
                // window.location.reload();
            },
            error: function( jqXHR, textStatus, errorThrown ) {
                // hideloading();
                alert("error");
                callbacks.failure("fail to fetch data");
            }
        });

        $("#assignMissions").click(function (event) {
            event.preventDefault();

            console.log("inside assign missions");
            var missions=[];
            for (var key in missionSelected) {
                if (missionSelected.hasOwnProperty(key)) {
                    console.log("Key:", key);
                    missions.push(key);
                }
            }
            var form_data = {
                user_id: user_id,
                missions: missions
            }

            $.ajax({
                url: "{{ URL('user/assignMissions') }}",
                method: "POST",
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                data: form_data,
                dataType: "json",
                encode: true,
                success: function( data, textStatus, jqXHR ) {
                    console.log("operation performed successfully");
                    $("#assignMissionModal").modal('hide');
                    alert("success");
                    // window.location.reload();
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    // hideloading();
                    alert("error");

                }
        });

    });


    }

</script>

<!-- modal assign mission END -->

@endsection