@extends('layouts.user_type.auth')

@section('content')
<div class="alert alert-warning mx- mb-2" role="alert">
    <span class="text-white">
        <strong>Welcome {{$user->name}} User</strong>
    </span>
</div>
<div class="row mx-2 mb-4">
    <div class="col-lg-12 col-md-12 mb-md-0 mb-1">
        <div class="row">
            <div class="col-lg-4 mb-3">
                <div id="card_completed" class="card cursor-pointer add-shadow bg-warning border border-2 border-primary')">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <a href="{{ route('dashboard-reports', ['status' => 'completed' ]) }}" class="{{ ($_page == 'completed' ? 'active' : '') }}">                   
                                <h4 class="title text-white text-uppercase fw-medium" style="font-style: ; font-family: Cascadia Code, sans-serif;">NUMBER OF STUDENT WITH COMPLETED REQUIREMENTS</h4>
                                <h4 class="mb-0">
                                <hr class="horizontal dark mt-2">
                                    <div>{{$serviceData->completedCount}}</div>
                                </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div id="card_completed" class="card cursor-pointer add-shadow bg-warning border border-2 border-primary')">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                            <a href="{{ route('dashboard-reports', ['status' => 'deficiency' ]) }}" class="{{ ($_page == 'deficiency' ? 'active' : '') }}">              
                                <h4 class="title text-white text-uppercase fw-medium" style="font-style: ; font-family: Cascadia Code, sans-serif;">NUMBER OF STUDENT WITH DEFICIENCY REQUIREMENTS</h4>
                                <h4 class="mb-0">
                                <hr class="horizontal dark mt-2">
                                    <div>{{$serviceData->deficiencyCount}}</div>
                                </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div id="card_completed" class="card cursor-pointer add-shadow bg-warning border border-2 border-primary')">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                            <a href="{{ url('overallstudent') }} {{ ($_page == 'overallstudent' ? 'active' : '') }}"> 
                                <h4 class="title text-white text-uppercase fw-medium" style="font-style: ; font-family: Cascadia Code, sans-serif;">TOTAL NUMBER OF STUDENT</h4>
                                <h4 class="mb-0">
                                <hr class="horizontal dark mt-2">
                                    <div>{{$dashboardData->student_count }}</div>
                                </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mx-2 mb-4">
    
  <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
  <!-- <div class="card">
        <div id="chart"></div>
    </div>   -->
    
    
    <div class="row">
        @if(isset($dashboardData->program_student_counts))
            @foreach($dashboardData->program_student_counts as $program)
            <div class="col-lg-3 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">{{$program->program_name}} Students</p>
                                <h4 class="mb-0">
                                    <div>{{$program->students_count }}</div>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        @endif
    </div>
    


    
  </div>
  
   
<link rel="stylesheet" href=""></link>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css"></link>
<link rel="stylesheet" href="style.css"></link>


<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var options = {
        series: [ {
            name: 'Completed',
            data: [/* Completed requirements count for each category */]
        }, {
            name: 'Deficient',
            data: [/* Deficient requirements count for each category */]
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            stackType: '100%'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
          bar: {
            borderRadius: 10,
            borderRadiusApplication: 'end',
            borderRadiusWhenStacked: 'last',
          },
        },
        xaxis: {
            categories: ['Admission', 'Returnee', 'Transferee', 'Cross-enroll']
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'right',
            offsetX: 0,
            offsetY: 50
        },
    };
  
    // PHP code in Blade template:
    @php
        $completedCounts = $dashboardData->completed_data;
        $deficientCounts = $dashboardData->deficient_data;
    @endphp

    options.series[1].data = @json($deficientCounts);
    options.series[0].data = @json($completedCounts);
    
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();


    $(document).ready(function() {
        
    });


</script>


    
@endsection
@push('dashboard')
@endpush


