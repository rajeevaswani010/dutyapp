@extends('layouts')

@section('content')

<style>
    .dashboard-quick-link {
        text-align: center;
        /* align-content: center; */
        border: solid thin lightgrey;
        border-radius: 10px;
        padding: 10px 0px 10px 0px;
        margin: 10px;
        width: 100px;
        cursor: pointer;
    }

    .dashboard-quick-link:hover {
        background: #f0f0f0;
    }

    .dashboard-quick-link img{
        width: 32px;
        height: auto;
        display: block;
        margin: auto;
    }

</style>
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
                <div class="card col-lg-12">
                <div class="card-header" style="align-items:center; padding-top:0; padding-bottom:0;">
                            <h3 class="card-title">Quick Links</h3>                        
                    </div>
                    <div class="card-body pt-4">
                        <div class="row" style="display:flex;">

                            <!-- icon link - mission -n start -->
                            <a href="/mission" class="dashboard-quick-link">
                                <img src="{{ asset('assets/icons/png/goal.png') }}" class="pb-3" alt="">
                                Missions
                            </a>                                
                            <!-- icon link - mission -n end-->
                            <!-- icon link - users -n start -->
                            <a href="/users" class="dashboard-quick-link">
                                <img src="{{ asset('assets/icons/png/users.png') }}" class="pb-3" alt="">
                                Users
                            </a>                                
                            <!-- icon link - users -n end-->

                        </div>
                    </div>
                </div>
                <!-- Dashboad cards - end -->

                <!-- calendar view of missions -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header" style="padding-top:0; padding-bottom:0;">
                            <div class="card-title">
                                <h3>Scheduled Missions</h3>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div id='mission-calendar'>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- calendar view of missions - end -->
                </div>
            <div class="col-lg-4">
                <div class="col-lg-12">
                    <div class="card">
                        <!-- department wise Active missions  START-->
                        <div id="department_missions">

                        </div>
                        <!-- department wise Active missions  END-->
                    </div>    
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header" style="align-items:center;">
                            <h3 class="card-title">Monthly completed missions</h3>
                            <div class="form-group col-md-4 mb-1">
                                <select class="form-control" name="filter-year" id="filter-year" value="">
                                    <option selected>2024</option>
                                    <option>2023</option>
                                    <option>2022</option>
                                    <option>2021</option>
                                    <option>2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <!-- monthly chart of completed missions  START  -->  
                            <div id="missions_finish_monthly">

                            </div>
                            <!-- Yearly chart of completed missions  END-->
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<script>

$(document).ready(function(){

        
        // Department wise approved missions - pie chart - start
        var options = {
          series: [44, 55, 13, 43, 22, 114],
          chart: {
              width: 480,
              type: 'pie',
            },
            labels: ['Department-A', 'Operations', 'Transport', 'ABC', 'MIB', "Avengers"],
            title: {
                text: 'Department wise approved missions',
                align: 'left',
                style: {
                    fontSize: '20px',
                    color: '#333' // Title color
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    },
                    title:"Approved missions per department",
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#department_missions"), options);
        chart.render();

        // Department wise approved missions - pie chart - end




        // Yearly finished missions per month - column chart -  - start   DUMMYY
        var data = {
            "2024":[23, 31, 40, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            "2023":[26, 38, 48, 101, 40, 36, 32, 23, 14, 8, 15, 20],
            "2022":[29, 31, 41, 56, 34, 26, 39, 45, 54, 18, 23, 10],
            "2021":[23, 31, 40, 101, 40, 36, 32, 23, 14, 28, 45, 32],
            "2020":[43, 51, 36, 45, 35, 26, 12, 32, 41, 28, 35, 20]
        };

        var options = {
          series: [{
            name: 'Completed Missions',
            //   data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
            data: data[$('#filter-year').val()]
        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val;
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val;
            }
          }
        
        },
        title: {
          text: $('#filter-year').val(),
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#missions_finish_monthly"), options);
        chart.render();
      
        $('#filter-year').change(function(){
            // alert("value changed to - "+ $(this).val());
            chart.updateOptions({
                series:[{
                    data: data[$(this).val()]
                }],
                title:{
                    text:$(this).val()
                }
            })

        });
        // Yearly finished missions per month - column chart -  - end


        //calendar view - start
        var calendarEl = document.getElementById('mission-calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                end: 'prev,next',// today',
                center: 'title',
                start: '' //'dayGridMonth',//,timeGridWeek,timeGridDay'
            },
            aspectRatio: 2,
            eventClick: function(info){
                if (info.event.url) {
                    window.open(info.event.url,"_SELF");
                    info.jsEvent.preventDefault();
                }
            }
            ,events: 'dashboard/getMissions'	//gets the booking from booking controller
        });

        calendar.render();
    });


</script>

@endsection    

