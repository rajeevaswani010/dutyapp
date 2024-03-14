@extends('layouts')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <!-- Dashboad cards - start -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card height-200">
                            <!-- Active Missions for today -->

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card height-200">
                            <!-- Active Missions for tomorrow -->

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card height-200">
                            <!-- total missions Active -->

                        </div>
                    </div>
                </div>
                <!-- Dashboad cards - end -->

                <!-- calendar view of missions -->
                <div class="col-lg-12">
                    <div class="card height-600">
                        
                    </div>
                </div>
                <!-- calendar view of missions - end -->
                </div>
            <div class="col-lg-4">
                <div class="col-lg-12">
                    <div class="card height-400">
                        <!-- department wise Active missions  -->

                    </div>    
                </div>
                <div class="col-lg-12">
                    <div class="card height-400">
                        <!-- Quick links  -->

                    </div>    
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<script>

</script>

@endsection    

