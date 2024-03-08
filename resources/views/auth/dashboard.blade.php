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
                    <h2>Missions</h2>
                    <button type="button" title="Create Mission" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createMissionModal">Add</button>
                </div>
                <!-- filter start -->
                <form>
                    <div class="bg-light p-4">
                        <div class="row row align-items-end m-1">
                            <div class="col">
                                <label>{{ __("Mission Number") }}</label>
                                <input type="text" class="form-control" id="number" name="number" value="{{ @$_GET['number'] }}">
                            </div>

                            <div class="col">
                                <label>{{ __("Department") }}</label>
                                <input type="text" class="form-control" id="department" name="department" value="{{ @$_GET['department'] }}">
                            </div>

                            <div class="col">
                                <label>{{ __("Pickup From Date") }}</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ @$_GET['start_date'] }}" onchange="validateDateRange()">
                            </div>

                            <div class="col">
                                <label>{{ __("Pickup To Date") }}</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ @$_GET['end_date'] }}" onchange="validateDateRange()">
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
                                        <th>{{ __("Mission ID") }}</th>
                                        <th>{{ __("Purpose") }}</th>
                                        <th>{{ __("City") }}</th>
                                        <th>{{ __("Country") }}</th>
                                        <th>{{ __("Department") }}</th>
                                        <th>{{ __("Directorate") }}</th>
                                        <th>{{ __("Number of staff") }}</th>
                                        <th>{{ __("Number of days") }}</th>
                                        <th>{{ __("Number of nights") }}</th>
                                        <th>{{ __("Start Date") }}</th>
                                        <th>{{ __("End Date") }}</th>
                                        <th>{{ __("Vehicle Required") }}</th>
                                        <th>{{ __("Air Ticket Required") }}</th>
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
                                            <td>{{ $DT->num_of_days }}</td>
                                            <td>{{ $DT->num_of_nights }}</td>
                                            <td>{{ $DT->start_date }}</td>
                                            <td>{{ $DT->end_date }}</td>
                                            <td>{{ $DT->vehicle_required }}</td>
                                            <td>{{ $DT->air_ticket_required }}</td>
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

<!-- Modal create mission -->
<div class="modal" id="createMissionModal" tabindex="-1" role="dialog" aria-labelledby="createMissionModal" aria-hidden="true">
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