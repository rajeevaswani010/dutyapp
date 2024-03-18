@extends('layouts')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>View Mission</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="/mission">Missions</a></li>
                <li class="breadcrumb-item active">{{ 1231231 }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
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


            </div>
        </div>
    </section>

</main><!-- End #main -->




@endsection