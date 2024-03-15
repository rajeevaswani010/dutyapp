@extends('layouts')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>User Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="row">
            <!-- filters start  -->
            <form>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Filters</h5>
                            <div class="row row-align-items-basline">
                                <div class="col-lg-2">
                                    <label>{{ __("Employee Id") }}</label>
                                    <input type="text" class="form-control" id="emp_id" name="emp_id" value="{{ @$_GET['emp_id'] }}">
                                </div>
                                <div class="col-lg-2">
                                    <label>{{ __("Department") }}</label>
                                    <select class="form-control" name="department" id="filter-department">
                                        <option value="">{{ __("All") }}</option>
                                        @foreach ($Departments as $department)
                                            <option value={{ $department['name'] }}>{{ $department['name'] }}</option>
                                        @endforeach
                                        <script>
                                        @if( isset($_GET['department']) )
                                            $('#filter-department').val("{{ $_GET['department'] }}");
                                        @endif
                                        </script>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-primary float-right" role="button">{{ __("Search") }}</button>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-primary btn-outline float-right" role="button" onclick="clearFilters();">{{ __("Clear") }}</button>
                                </div>
                                <script>
                                    function clearFilters(){
                                        event.preventDefault();
                                        $('#mission_id').val(null);
                                        $('#filter-department').val('Operations');
                                        $('#start_date').val(null);
                                        $('#end_date').val(null);
                                    }    
                                </script>
                        </div>
                    </div>
                </div>
            </form>
            <!-- filters end -->
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">Users</h5>
                        <button type="button" title="Create Mission" class="btn btn-primary btn-sm"
                            data-bs-toggle="modal" data-bs-target="#createMissionModal">Add</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="userTable" class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>{{ __("Username") }}</th>
                                        <th>{{ __("Employee Id") }}</th>
                                        <th>{{ __("Designation") }}</th>
                                        <th>{{ __("Department") }}</th>
                                        <!-- <th>{{ __("Gender") }}</th> -->
                                        <th>{{ __("Phone") }}</th>
                                        <th>{{ __("Email") }}</th>
                                        <!-- <th>{{ __("Address") }}</th> -->
                                        <!-- <th>{{ __("Date of Birth") }}</th> -->
                                        <!-- <th>{{ __("Date of Joining") }}</th> -->
                                        <!-- <th>{{ __("Active") }}</th> -->
                                        <th>{{ __("Assigned Missions") }}</th>
                                        <!-- <th>{{ __("Num of upcoming Missions") }}</th> -->
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
                                            <!-- <td>{{ $DT->gender }}</td> -->
                                            <td>{{ $DT->phone }}</td>
                                            <td>{{ $DT->email }}</td>
                                            <!-- <td>{{ $DT->address }}</td> -->
                                            <!-- <td>{{ $DT->dob }}</td> -->
                                            <!-- <td>{{ $DT->doj }}</td> -->
                                            <!-- <td>{{ $DT->is_active }}</td> -->
                                            <td>{{ count($DT->missions) }}</td>
                                            <!-- <td>{{ count($DT->missions) }}</td> -->
                                            <td>
                                                <button type="button" title="Assign Missions"
                                                    class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#assignMissionModal" onclick="onAssignMission()"
                                                    data-id="{{ $DT->id }}">Assign</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

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
<script>
   
    function onAssignMission(user_id){
        var user_id = event.target.dataset.id;
        var missionSelected = {};

        $("#assignMissionModal").css("display", "block");
        $('#assignMissionModal .modal-body').html("");

        var panel = $('<div class="panel panel-default">');
        var panelHeader = $('<div class="panel-header">');
        panelHeader.html("<h3>Select Mission</h3>");

        var panelBody = $('<div class="panel-body" style="margin-top:1rem;">');
        var missionList = $('<div>');
        missionList.html("Loading data...");
        panelBody.append(missionList);
        var panelFooter = $('<div class="panel-footer">');

        panel.append(panelHeader);
        panel.append(panelBody);
        panel.append(panelFooter);

        // Append panel to modal body
        $('#assignMissionModal .modal-body').append(panel);
        
        var form_data = {
            user_id: user_id
        }

        let callbacks = {
            success: function (data) {
                missionList.html("");
                console.log(data);
                let tableData = data;

                // Create a table element
                var table = $('<table id="missionTable" class="table table-hover datatable" style="width:100%;">');
                var tbody = $('<tbody>');

                // Create a table header row
                var headerRow = $('<thead>');

                headerRow.append('<th> </th>');

                // Add table headers
                for (var key in tableData[0]) {
                    headerRow.append('<th>'+key.toUpperCase()+'</th>');
                }
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
                            missionSelected[id] = 1;
                        } else {
                            delete missionSelected[id];
                        }
                    })

                    for (var key in item) {
                        row.append('<td>'+item[key]+'</td>');
                    }
                    tbody.append(row);
                });
                table.append(tbody);
                var newDiv = $('<div class="tableresponsive" style="overflow-x:auto;">');
                newDiv.append(table);
                missionList.append(newDiv);

                let table2 = new DataTable('#missionTable');
            },

            failure: function (errmsg) {
                $("#assignMissionModal").css("display", "block");
                missionList.html(errmsg);
            }
        };

        $.ajax({
            url: "{{ URL('/getMissions') }}",
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
            console.log(missionSelected)
            var missions = [];
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
                    alert("success");
                    // window.location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // hideloading();
                    alert("error");
                }
            });

        });
    }


</script>

@endsection