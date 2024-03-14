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
                        <div class="card-body pt-1">
                        @foreach ($Data->users as $user)
                            <div>
                                <p>{{ $user->name }}</p>
                                <p>{{ $user->department }}</p>
                                <p>{{ $user->email }} / {{ $user->phone }}</p>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <!-- assigned user card - ends -->

            </div>
            <!-- column 2 ends -->
        </div>
    </section>

</main><!-- End #main -->




@endsection