@extends('layouts')

@section('content')

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
        <div class="row">  <!-- 2 column layout -->
            <!-- column 1 starts-->
            <div class="col-lg-8">
            
                <div class="col-lg-12">
                    <!-- mission status card -->
                    <div class="card">
                        <div class="p-3">
                            <h3 class="p-0">Mission# {{ $Data->id }}</h3>
                        </div>
                    </div>
                    <!-- mission status card ENDs-->
                    
                    <!-- mission info card -->
                    <div class="card height-600">
                        <div class="card-body pt-3">
                            <h5 class="card-title pt-3">Purpose</h5>
                            <p class="small">{{ $Data->purpose }}</p>

                        </div>
                        <div class="card-footer">
                            <button type="button" title="Edit Mission"
                                class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                                data-bs-target="#editMissionModal" 
                                data-id="{{ $Data->id }}">Edit</button>
                        </div>
                    </div>
                    <!-- mission info card ENDS -->
                    
                </div>

            </div>
            <!-- column 1 ends -->

            <!-- column 2 starts -->
            <div class="col-lg-4">
                
                <!-- assigned user card -->
                <div class="col-lg-12">
                    <div class="card height-600 pt-2">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col-lg-5">
                                    <h5 class="card-title p-0">Assigned Users</h5>
                                </div>
                                <div class="col-lg-3">
                                    <span style="font-size:1rem;font-wight:600;color:#fff;background:red;padding:0.5rem 1rem 0.5rem 1rem;">
                                        {{count($Data->users)}} / {{ $Data->num_of_staff }}
                                    </span>
                                </div>
                                <div class="col-lg-4">
                                @if( count($Data->users)  >=  $Data->num_of_staff )
                                <button type="button" title="Assign Missions"
                                        class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#assignMissionModal" onclick="onAssignMission()"
                                        data-id="{{ $Data->id }}" disabled>Assign</button>
                                @else
                                <button type="button" title="Assign Missions"
                                        class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#assignMissionModal" onclick="onAssignMission()"
                                        data-id="{{ $Data->id }}">Assign</button>
                                </div>
                                @endif
                            </div>                                
                        </div>
                        <div class="card-body pt-1">
                            <div class="table-responsive">
                                <table id="userTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __("User Details") }}</th>
                                        <th>{{ __("Allowance") }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($Data->users as $user)
                                    <tr>
                                        <td>
                                            <div class="mt-3">
                                                <h5>{{ $user->name }}</h5>
                                                <small> {{ $user->designation }} / {{ $user->department }}</small>
                                                <small><i>{{ $user->email }}</i></small>
                                                <small>{{ $user->phone }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <p>56</p>
                                        </td>
                                        <td>
                                            <button id="unassignUser" data-arg="{{ $user->id}}" class="btn btn-primary btn-sm">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- assigned user card - ends -->

            </div>
            <!-- column 2 ends -->
        </div>
    </section>

</main><!-- End #main -->

<!-- editMission Modal - start -->
<div class="modal fade" id="editMissionModal" tabindex="-1" role="dialog" aria-labelledby="editMissionModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                {!! Form::open(['id' => 'editmission']) !!}
                <div class="form-group col-md-12">
                    <label for="purpose" class="col-form-label text-dark">{{ __("Purpose") }}</label>
                    <input class="form-control font-style" name="purpose" type="text" id="purpose" required />
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-bs-dismiss="modal">{{ __("Close") }}</button>
                <input type="submit" class="btn btn-xs btn-primary" id="editMission" value='{{ __("Save") }}'/>
            </div>
        </div>
    </div>
</div>
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

<script>
    $("#editmission").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        // console.log(formData);
        fetch("{{ URL('mission/edit') }}", {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Handle success
        })
        .catch(error => {
            // Handle error
        });
    });

    $("#unassignUser").on('click',function(event){
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
                window.location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // hideloading();
                alert("error");
            }
        });

    });
   
    function onAssignMission(user_id){
        event.preventDefault();

        var mission_id = event.target.dataset.id;
        var userSelected = {};


        $("#assignMissionModal").css("display", "block");
        $('#assignMissionModal .modal-body').html("");

        var panel = $('<div class="panel panel-default">');
        var panelHeader = $('<div class="panel-header">');
        panelHeader.html("<h3>Select User</h3>");

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
            mission_id: mission_id
        }

        let callbacks = {
            success: function (data) {
                userList.html("");
                console.log(data);
                let tableData = data;

                // Create a table element
                var table = $('<table id="userTakb" class="table table-hover datatable" style="width:100%;">');
                var tbody = $('<tbody>');

                // Create a table header row
                var headerRow = $('<thead>');

                headerRow.append('<th> </th>');

                // Add table headers
                // for (var key in tableData[0]) {
                //     headerRow.append('<th>'+key.toUpperCase()+'</th>');
                // }
                    headerRow.append('<th>{{ __("Username") }}</th>');
                    headerRow.append('<th>{{ __("Employee Id") }}</th>');
                    headerRow.append('<th>{{ __("Designation") }}</th>');
                    headerRow.append('<th>{{ __("Department") }}</th>');
                    headerRow.append('<th>{{ __("Phone") }}</th>');
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
                        // row.append('<td>'+item["username"]+'</td>');
                        // row.append('<td>'+item["username"]+'</td>');
                    // }
                    tbody.append(row);
                });
                table.append(tbody);
                var newDiv = $('<div class="tableresponsive" style="overflow-x:auto;">');
                newDiv.append(table);
                userList.append(newDiv);

                let table2 = new DataTable('#missionTable');
            },

            failure: function (errmsg) {
                $("#assignMissionModal").css("display", "block");
                userList.html(errmsg);
            }
        };

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
                        window.location.reload();
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