@extends('layouts')

@section('content')
<style>

#createMissionModal .modal-dialog{
    position: absolute;
    top: -3vh;
    left: 32vw;
}

#createMissionModal .modal-content{
    width: 36vw;
}

#createMissionModal .form-content{
    height: 78vh;
    overflow-y: auto; 
}

input.hidestep::-webkit-outer-spin-button,
input.hidestep::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

</style>

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
                                <div class="col-1">
                                    <div class="col"><button class="btn btn-primary float-lg-right" style="float:right;" role="button" name="export" value="Export">{{ __("Export") }}</button></div>
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
                            <table id="missionTable" class="display pt-3 pb-3 stripe row-border order-column">
                                <thead>
                                    <tr>
                                        <th>{{ __("Mission ID") }}</th>
                                        <th>{{ __("Purpose") }}</th>
                                        <th>{{ __("City") }}</th>
                                        <th>{{ __("Country") }}</th>
                                        <th>{{ __("Department") }}</th>
                                        <th>{{ __("Directorate") }}</th>
                                        <th>{{ __("Status") }}</th>
                                        <th>{{ __("Staff Required") }}</th>
                                        <th>{{ __("Staff Assigned") }}</th>
                                        <th>{{ __("Number of days") }}</th>
                                        <th>{{ __("Start Date") }}</th>
                                        <th>{{ __("End Date") }}</th>
                                        <th>{{ __("Vehicle Required") }}</th>
                                        <th>{{ __("Air Ticket Required") }}</th>
                                        <th>{{ __("Created at") }}</th>
                                        <th>{{ __("Created by") }}</th>
                                        <th class="sticky-column-end" style="left:0;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($Data as $DT)

                                        <tr id="{{ $DT->id }}"class="font-style">
                                            <td >{{ $DT->id }}</td>
                                            <td>{{ $DT->purpose }}</td>
                                            <td>{{ $DT->country }}</td>
                                            <td>{{ $DT->city }}</td>
                                            <td>{{ $DT->department }}</td>
                                            <td>{{ $DT->directorate }}</td>
                                            <td>
                                                @if($DT->status == 1)
                                                    <span
                                                        class="indicator-line rounded bg-secondary status planned">{{ __("Planned") }}</span>
                                                @elseif($DT->status == 2)
                                                    <span
                                                        class="indicator-line rounded bg-yellow status working">{{ __("Working") }}</span>
                                                @elseif($DT->status == 3)
                                                    <span
                                                        class="indicator-line rounded bg-warning status assigned">{{ __("Assigned") }}</span>
                                                @elseif($DT->status == 4)
                                                    <span
                                                        class="indicator-line rounded bg-success  status approved">{{ __("Approved") }}</span>
                                                @elseif($DT->status == 5)
                                                    <span
                                                        class="indicator-line rounded bg-primary status active">{{ __("Active") }}</span>
                                                @elseif($DT->status == 6)
                                                    <span
                                                        class="indicator-line rounded bg-info status complete">{{ __("Complete") }}</span>
                                                @elseif($DT->status == 0)
                                                    <span
                                                        class="indicator-line rounded bg-danger status cancelled">{{ __("Cancelled") }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $DT->num_of_staff }}</td>
                                            <td>  <!-- staff assigned -->
                                                {{ count($DT->users) }}
                                            </td>
                                            <td>{{ $DT->num_of_days }}</td>                                            
                                            <td>{{ $DT->start_date }}</td>
                                            <td>{{ $DT->end_date }}</td>
                                            <td>{{ $DT->vehicle_required }}</td>
                                            <td>{{ $DT->air_ticket_required }}</td>
                                            <td>{{ $DT->created_at }}</td>
                                            <td >{{ $DT->created_by }}</td>
                                            <td class="Action sticky-column-end">
                                                <span>
                                                    <div class="action-btn ms-2">
                                                        <a href="{{ URL('mission') }}/{{ $DT->id }}/edit"
                                                            class="mx-3 btn btn-sm align-items-center"
                                                            data-url="{{ URL('mission') }}/{{ $DT->id }}/"
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
                <!-- mission table end -->
            </div>
        </div>
    </section>

</main><!-- End #main -->



<!-- Modal create mission -->
<div class="modal fade" id="createMissionModal" tabindex="-1" role="dialog" aria-labelledby="createMissionModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" id="createMissonModal">{{ __("Create New Mission") }}</h3>
                            <button class="btn btn-danger btn-sm window-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    {!! Form::open(['id' => 'createmission']) !!}
                                    <div class="row form-content">
                                        <div class="form-group col-md-4 mb-1">
                                            <label for="type"
                                                class="col-form-label text-dark">{{ __("Type") }}</label>
                                            <select class="form-control" name="type" id="type" value="" required>
                                                <option value="internal">{{ __("Inside") }}</option>
                                                <option value="external">{{ __("Outside") }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="form-group col-md-4 mb-1">
                                            <label for="allowance"
                                                class="col-form-label text-dark">{{ __("Allowance") }}</label>
                                            <select class="form-control" name="allowance" id="allowance" value="" required>
                                                <option value=0>0</option>
                                                <option value=25>25%</option>
                                                <option value=50>50%</option>
                                                <option value=75>75%</option>
                                                <option value=100 selected>100%</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12 mb-1">
                                            <label for="purpose"
                                                class="col-form-label text-dark">{{ __("Purpose") }}</label>
                                            <textarea class="form-control font-style" row=2 name="purpose" id="purpose" required ></textarea>
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
                                        </div>
                                        
                                        <div class="form-group col-md-6  mb-1">
                                            <label for="city"
                                                class="col-form-label text-dark">{{ __("City") }}</label>
                                            <input class="form-control font-style" name="city" type="text" id="city"
                                                required />
                                        </div>
                                                                                
                                        <div class="form-group col-md-4  mb-1">
                                            <label for="section"
                                                class="col-form-label text-dark">{{ __("Section") }}</label>
                                            <input class="form-control font-style" name="section" type="text"
                                                id="section" required />
                                        </div>

                                        <div class="form-group col-md-8  mb-1">
                                            <label for="directorate"
                                                class="col-form-label text-dark">{{ __("Directorate") }}</label>
                                            <input class="form-control font-style" name="directorate" type="text"
                                                id="directorate" required />
                                        </div>

                                        <div class="form-group col-md-12  mb-1">
                                            <label for="department"
                                                class="col-form-label text-dark">{{ __("Department") }}</label>
                                            <select class="form-control" name="department" id="department">
                                                <option value="">{{ __("--Select Department--") }}
                                                </option>
                                                @foreach($Departments as $department)
                                                    <option value={{ $department['name'] }}>
                                                        {{ $department['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-5 col-sm-12  mb-1">
                                            <label for="num_of_staff"
                                                class="col-form-label text-dark">{{ __("Number of Employees") }}</label>
                                            <input class="form-control font-style" name="num_of_staff" type="number"
                                                id="num_of_staff" required min="0" step="1" />
                                        </div>

                                        <div class="form-group col-md-5 col-sm-12  mb-1">
                                            <label for="num_of_days"
                                                class="col-form-label text-dark">{{ __("Number of Days") }}</label>
                                            <input class="form-control font-style" name="num_of_days" type="number"
                                                id="num_of_days" required min="0" step="1" />
                                        </div>

                                        <div class="form-group col-md-8 col-sm-12  mb-1">
                                            <label for="fees"
                                                class="col-form-label text-dark">{{ __("Mission Fees") }}</label>
                                            <div class="row">
                                                <div class="col-8">
                                                    <input class="form-control hidestep text-end font-style" name="fees" type="number"
                                                        id="fees" required min="0"/>
                                                </div>
                                                <div class="col-4">( OMR )</div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="remarks"
                                                class="col-form-label text-dark">{{ __("Remarks") }}</label>
                                            <textarea class="form-control font-style" name="remarks" id="remarks"
                                                placeholder="enter remarks" rows=3></textarea>
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

// fix columns.. lke sticky But NOT Working.. 
    $(document).ready(function(){
        var datatable = new DataTable('#missionTable',{
            columnDefs: [{ width: 200, targets: 0 }],
            scrollCollapse: true,
            scrollX: true,
            scrollY: 600,
            fixedColumns: true,
            fixedColumns: {
                start:1,
                end:1
            }
        });
    });

    $("#createmission").submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        // console.log(formData);
        $.ajax({
            url: "{{ URL('mission/add') }}",
                method: 'POST', // Use PUT method for updating
                data: formData, // Form data
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
        });

        // showloading();

    });
</script>

<!-- modal create mission END -->

<!-- The slider modal -->
<div class="modal fade slider-modal" id="content" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sliderModalLabel">Slider Modal</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="range" min="0" max="100" value="50" class="custom-range" id="sliderInput">
        <p>Selected Value: <span id="sliderValue">50</span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Update the slider value when it's changed
  var slider = document.getElementById("sliderInput");
  var output = document.getElementById("sliderValue");
  output.innerHTML = slider.value; // Display the default slider value

  slider.oninput = function() {
    output.innerHTML = this.value;
  }
</script>
@endsection