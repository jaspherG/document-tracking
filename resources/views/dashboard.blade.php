@extends('layouts.user_type.auth')

@section('content')
<div class="alert alert-secondary mx-4 mb-2" role="alert">
    <span class="text-white">
        <strong>Hi {{$user->name}}</strong> Welcome
    </span>
</div>
<div class="row mx-2 my-4">
  <div class="col-lg-8 col-md-12 mb-md-0 mb-4">
  <!-- <div class="card">
        <div id="chart"></div>
    </div>   -->
    <div class="row">
    
    @if(isset($dashboardData->requirementsPerService))
        @foreach($dashboardData->requirementsPerService as $requirement)
            <div class="col-lg-3 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4>{{ ucfirst($requirement->service->service_name) }}</h4>
                                <span>Total: {{ $requirement->total }}</span><br>
                                <span>Deficient: {{ $requirement->deficient_count }}</span><br>
                                <span>Completed: {{ $requirement->completed_count }}</span><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    </div>
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
  <div class="col-lg-4 col-md-12 mb-md-0 mb-4">
   
    <div class="row ">
        <div class="col-lg-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                    <p class="text-muted fw-medium">Requirements</p>
                    <h4 class="mb-0">
                        <div>{{$dashboardData->requirement_count}}</div>
                    </h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary d-flex align-items-center justify-content-center">
                      <span class="avatar-title">
                        <i class="fas fa-list text-white"></i>
                      </span>
                    </div>
                </div>
                </div>
                <!-- end card-body -->
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                    <p class="text-muted fw-medium">Documents</p>
                    <h4 class="mb-0">
                        <div>{{$dashboardData->document_count}}</div>
                    </h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary d-flex align-items-center justify-content-center">
                      <span class="avatar-title">
                      <i class="fas fa-solid fa-file text-white"></i>
                      </span>
                    </div>
                </div>
                </div>
                <!-- end card-body -->
            </div>
        </div>
        
        <div class="col-lg-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                    <p class="text-muted fw-medium">Admission</p>
                    <h4 class="mb-0">
                      <div>{{$dashboardData->admission_count}}</div>
                    </h4>
                    </div>
                    <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary d-flex align-items-center justify-content-center">
                      <span class="avatar-title">
                          <i class="fas fa-users text-white"></i>
                      </span>
                    </div>
                </div>
                </div>
                <!-- end card-body -->
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                    <p class="text-muted fw-medium">Registrar</p>
                    <h4 class="mb-0">
                      <div>{{$dashboardData->registrar_count}}</div>
                    </h4>
                    </div>
                    <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary d-flex align-items-center justify-content-center">
                      <span class="avatar-title">
                          <i class="fas fa-users text-white"></i>
                      </span>
                    </div>
                </div>
                </div>
                <!-- end card-body -->
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                    <p class="text-muted fw-medium">Students</p>
                    <h4 class="mb-0">
                        <div>{{$dashboardData->student_count}}</div>
                    </h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary d-flex align-items-center justify-content-center">
                      <span class="avatar-title">
                          <i class="fas fa-users text-white"></i>
                      </span>
                    </div>
                </div>
                </div>
                <!-- end card-body -->
            </div>
        </div>
    </div>
  </div>
</div>


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


