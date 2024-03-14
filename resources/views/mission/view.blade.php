@extends('layouts')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Mission Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Missions</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <!-- filters start  -->
                <form>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Filters</h5>
                            <div class="row row-align-items-basline">
                                <div class="col-lg-2">
                                    <label>{{ __("Mission Id") }}</label>
                                    <input type="text" class="form-control" id="mission_id" name="mission_id" value="{{ @$_GET['mission_id'] }}">
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
                                <div class="col-lg-2">
                                    <label>{{ __("Start Date") }}</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ @$_GET['start_date'] }}" onchange="validateDateRange()">
                                </div>
                                <div class="col-lg-2">
                                    <label>{{ __("End Date") }}</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ @$_GET['end_date'] }}" onchange="validateDateRange()">
                                </div>
                                <!-- <div class="col">
                                    <label>{{ __("Status") }}</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="">{{ __("All") }}</option>
                                        <option @if(@$_GET['status'] == 1) selected @endif value=1>{{ __("Planned") }}</option>
                                        <option @if(@$_GET['status'] == 2) selected @endif value=2>{{ __("Active") }}</option>
                                        <option @if(@$_GET['status'] == 3) selected @endif value=5>{{ __("Cancelled") }}</option>
                                        <option @if(@$_GET['status'] == 4) selected @endif value=3>{{ __("Finish") }}</option>
                                    </select>
                                </div>            -->
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

                <!-- mission table start -->
                <div class="card">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">Missions</h5>
                        <button type="button" title="Create Mission" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createMissionModal">Add</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="missionTable" class="table table-hover border datatable">
                                <thead>
                                    <tr>
                                        <th>{{ __("Mission ID") }}</th>
                                        <th>{{ __("Purpose") }}</th>
                                        <th>{{ __("City") }}</th>
                                        <th>{{ __("Country") }}</th>
                                        <th>{{ __("Department") }}</th>
                                        <th>{{ __("Directorate") }}</th>
                                        <th>{{ __("Staff Required") }}</th>
                                        <th>{{ __("Staff Assigned") }}</th>
                                        <th>{{ __("Number of days") }}</th>
                                        <th>{{ __("Number of nights") }}</th>
                                        <th>{{ __("Start Date") }}</th>
                                        <th>{{ __("End Date") }}</th>
                                        <th>{{ __("Vehicle Required") }}</th>
                                        <th>{{ __("Air Ticket Required") }}</th>
                                        <th style="position:sticky;"> </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($Data as $DT)

                                        <tr class="font-style">
                                            <td>{{ $DT->id }}</td>
                                            <td>{{ $DT->purpose }}</td>
                                            <td>{{ $DT->country }}</td>
                                            <td>{{ $DT->city }}</td>
                                            <td>{{ $DT->department }}</td>
                                            <td>{{ $DT->directorate }}</td>
                                            <td>{{ $DT->num_of_staff }}</td>
                                            <td>  <!-- staff assigned -->
                                                {{ count($DT->users) }}
                                            </td>
                                            <td>{{ $DT->num_of_days }}</td>
                                            <td>{{ $DT->num_of_nights }}</td>
                                            <td>{{ $DT->start_date }}</td>
                                            <td>{{ $DT->end_date }}</td>
                                            <td>{{ $DT->vehicle_required }}</td>
                                            <td>{{ $DT->air_ticket_required }}</td>
                                            <td class="Action" style="position:sticky;">
                                                <span>
                                                    <div class="action-btn ms-2">
                                                        <a href="{{ URL('mission') }}/{{ $DT->id }}/edit"
                                                            class="mx-3 btn btn-sm align-items-center"
                                                            data-url="{{ URL('mission') }}/{{ $DT->id }}/edit"
                                                            data-ajax-popup="true" data-title="Edit Coupon"
                                                            data-bs-toggle="tooltip" title="Edit"
                                                            data-original-title="Edit">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->



<!-- Modal create mission -->
<div class="modal fade" id="createMissionModal" tabindex="-1" role="dialog" aria-labelledby="createMissionModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMissonModal">{{ __("Create New Mission") }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        {!! Form::open(['id' => 'createmission']) !!}
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="purpose" class="col-form-label text-dark">{{ __("Purpose") }}</label>
                                <input class="form-control font-style" name="purpose" type="text" id="purpose" required />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="country" class="col-form-label text-dark">{{ __("Country") }}</label>
                                <input class="form-control font-style" name="country" type="text" id="country" required />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city" class="col-form-label text-dark">{{ __("City") }}</label>
                                <input class="form-control font-style" name="city" type="text" id="city" required />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="start_date" class="col-form-label text-dark">{{ __("Start") }}</label>
                                <input class="form-control font-style" name="start_date" type="date" id="start_date" required />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end_date" class="col-form-label text-dark">{{ __("End") }}</label>
                                <input class="form-control font-style" name="end_date" type="date" id="end_date" required />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="travel_start_date" class="col-form-label text-dark">{{ __("Travel Start") }}</label>
                                <input class="form-control font-style" name="travel_start_date" type="date" id="travel_start_date" required />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="travel_return_date" class="col-form-label text-dark">{{ __("Travel Return") }}</label>
                                <input class="form-control font-style" name="travel_return_date" type="date" id="travel_return_date" required />
                            </div>


                            <div class="form-group col-md-4">
                                <label for="num_of_staff" class="col-form-label text-dark">{{ __("Number of Staff") }}</label>
                                <input class="form-control font-style" name="num_of_staff" type="number" id="num_of_staff" required min="0" step="1" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="num_of_days" class="col-form-label text-dark">{{ __("Number of Days") }}</label>
                                <input class="form-control font-style" name="num_of_days" type="number" id="num_of_days" required min="0" step="1"/>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="num_of_nights" class="col-form-label text-dark">{{ __("Number of Nights") }}</label>
                                <input class="form-control font-style" name="num_of_nights" type="number" id="num_of_nights" required min="0" step="1"/>
                            </div>

                            <!-- <div class="form-group col-md-4">
                                <label for="section" class="col-form-label text-dark">{{ __("Section") }}</label>
                                <input class="form-control font-style" name="section" type="text" id="section" required/>
                            </div> -->
                            <div class="form-group col-md-8">
                                <label for="department" class="col-form-label text-dark">{{ __("Department") }}</label>
                                <input class="form-control font-style" name="department" type="text" id="department" required/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="directorate" class="col-form-label text-dark">{{ __("Directorate") }}</label>
                                <input class="form-control font-style" name="directorate" type="text" id="directorate" required/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="travelling_area_from" class="col-form-label text-dark">{{ __("Travelling Area From") }}</label>
                                <input class="form-control font-style" name="travelling_area_from" type="text" id="travelling_area_from" required/>
                            </div>

                            <div class="form-check col-md-6 mt-4 mr-4">
                                <input class="form-check-input ml-2" type="checkbox" name="air_ticket_required" value="" id="air_ticket_required">
                                <label class="form-check-label" for="air_ticket_required">
                                    Air Ticket Required ?
                                </label>
                            </div>
                            <div class="form-check col-md-6 mt-4">
                                <input class="form-check-input ml-2" type="checkbox" name="vehicle_required" value="" id="vehicle_required">
                                <label class="form-check-label" for="vehicle_required">
                                    Vehicle Required ?
                                </label>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="remarks" class="col-form-label text-dark">{{ __("Remarks") }}</label>
                                <textarea class="form-control font-style" name="remarks" id="remarks" placeholder="enter remarks" rows=3></textarea>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __("Close") }}</button>
                <input class="btn btn-xs btn-primary" type="submit" value='{{ __("Send") }}'>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>

$("#createmission").submit(function (event) {
    event.preventDefault();

    var formData = {
        purpose: $("#createmission #purpose").val(),
        country:$("#createmission #country").val(),
        city:$("#createmission #city").val(),
        num_of_staff: $("#createmission #num_of_staff").val(),
        num_of_days: $("#createmission #num_of_days").val(),
        num_of_nights:$("#createmission #num_of_nights").val(),
        section:$("#createmission #section").val(),
        department:$("#createmission #department").val(),
        directorate:$("#createmission #directorate").val(),
        travelling_area_from: $("#createmission #travelling_area_from").val(),
        start_date:$("#createmission #start_date").val(),
        end_date:$("#createmission #end_date").val(),
        travel_start_date:$("#createmission #travel_start_date").val(),
        travel_return_date:$("#createmission #travel_return_date").val(),
        remarks:$("#createmission #remarks").val(),
        air_ticket_required:$("#createmission #air_ticket_required").is(":checked"),
        vehicle_required:$("#createmission #vehicle_required").is(":checked")
    };

    // showloading();
    $.ajax({
        url: "{{ URL('mission/add') }}",
        method: "POST",
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        data: formData,
        dataType: "json",
        encode: true,
        success: function( data, textStatus, jqXHR ) {
            // hideloading();
            $('#createMissionModal').modal("hide");
            alert("mission successfully added");
            window.location.reload();
        },
        error: function( jqXHR, textStatus, errorThrown ) {
            // hideloading();
            alert("error");
        }
    })
});
</script>

<!-- modal create mission END -->

@endsection