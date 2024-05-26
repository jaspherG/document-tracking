@extends('layouts.user_type.auth')
<style>
.gradient-outline-primary {
  border-width: 2px !important; /* Set the border width as per your preference */
  border-style: solid !important; /* Set the border style to solid */
  border-image: linear-gradient(310deg, #7928ca, #ff0080) 1 !important; /* Apply linear gradient as border image */
  background-color: transparent; /* Set background color as transparent */
}

.add-shadow:hover {
  box-shadow: 2px 5px 8px 5px rgba(0, 0, 0, 0.1); /* Shadow color */
  transform: scale(1.05); /* Scale the element by 5% */
  transition: transform 0.2s ease; /* Add a smooth transition effect */
}



</style>
@section('content')
<div class="row">
  <div class="col-12 mb-md-0  d-flex align-items-center justify-content-center gap-2 pt-2">
      <a href="{{ route('show.requirements', ['id' => 0] ) }}" class="btn btn-sm btn-outline-primary {{ ($_service == 0 ? 'active' : '') }}">All</a>
      <a href="{{ route('show.requirements', ['id' => 1] ) }}" class="btn btn-sm btn-outline-primary {{ ($_service == 1 ? 'active' : '') }}">Admission</a>
      <a href="{{ route('show.requirements', ['id' => 2] ) }}" class="btn btn-sm btn-outline-primary {{ ($_service == 2 ? 'active' : '') }}">Returnee</a>
      <a href="{{ route('show.requirements', ['id' => 3] ) }}" class="btn btn-sm btn-outline-primary {{ ($_service == 3 ? 'active' : '') }}">Transferee</a>
      <a href="{{ route('show.requirements', ['id' => 4] ) }}" class="btn btn-sm btn-outline-primary {{ ($_service == 4 ? 'active' : '') }}">Cross-enroll</a>
  </div>
</div>
<div class="row ">
  <div class="col-lg-6 col-12 mb-md-0 mb-4 d-flex align-items-center justify-content-center p-5">
    <div class="col-lg-6">
      <div id="card_completed" class="card cursor-pointer add-shadow {{ ($_completed == 1 ? 'bg-gradient-primary' : 'border border-2 border-primary') }}">
        <a href="{{ route('show.requirements', ['id' => $_service, 'status' => 'completed'] ) }}" class="text-decoration-none">
          <div class="card-body ">
            <div class="row text-center ">
                <div class="col-12">
                    <h4 class="title text-uppercase {{ ($_completed == 1 ? 'text-white' : '') }}">Completed ({{$serviceData->completedPercentage}}%)</h4>
                </div>
            </div>
            <div class="row text-center mb-4">
                <div class="col-12">
                    <span class="fw-bold fs-4 {{ ($_completed == 1 ? 'text-light' : '') }}">{{$serviceData->completedCount}}</span>
                </div>
            </div>
          </div>
        </a>  
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-12 mb-md-0 mb-4 d-flex align-items-center justify-content-center p-5">
    <div class="col-lg-6 ">
      <div id="card_deficiency" class="card cursor-pointer add-shadow {{ ($_deficiency == 1 ? 'bg-gradient-primary text-light' : 'border border-2 border-primary') }} ">
        <a href="{{ route('show.requirements', ['id' => $_service, 'status' => 'deficiency'] ) }}" class="text-decoration-none">
          <div class="card-body">
            <div class="row text-center ">
                <div class="col-12">
                    <h4 class="title text-uppercase {{ ($_deficiency == 1 ? 'text-white' : '') }}">Deficient ({{$serviceData->deficiencyPercentage}}%)</h4>
                </div>
            </div>
            <div class="row text-center mb-4">
                <div class="col-12">
                    <span class="fw-bold fs-4 {{ ($_deficiency == 1 ? 'text-light' : '') }}">{{$serviceData->deficiencyCount}}</span>
                </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<div class="row my-2">
  <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex flex-row justify-content-between">
              <div>
                  <h5 class="mb-0">
                    @if($_service == 0)
                    All
                    @elseif($_service == 1)
                    Admission
                    @elseif($_service == 2)
                    Returnee
                    @elseif($_service == 3)
                    Transferee
                    @elseif($_service == 4)
                    Coross-Enroll
                    @endif
                  Requirements</h5>
              </div>
              <!-- filtered category -->
              <input type="hidden" class="service_category" value="{{$_service}}">
              <input type="hidden" class="completed_category" value="{{$_completed}}">
              <input type="hidden" class="deficient_category" value="{{$_deficiency}}">
              <div class=" d-flex align-items-center">
                  <div class="input-group">
                      <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                      <input type="text" class="form-control filter-input" placeholder="Type here...">
                  </div>
              </div>
          </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="p-0">
          <table class="table align-items-center mb-0 table-hover ">
            <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Name                    
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Students No.
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Course
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Class Year
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Completion
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody id="table_body">
                @if(count($serviceData->requirements) > 0)
                  @foreach($serviceData->requirements as $requirement) 
                    <tr class="table-row">
                      <td class="ps-4">{{$requirement->user_student->name}}</td>
                      <td class="ps-4">{{$requirement->user_student->student_number}}</td>
                      <td class="ps-4">{{$requirement->course}}</td>
                      <td class="ps-4">{{$requirement->class_year}}</td>
                      <td class="ps-4">
                        <div class="progress-wrapper w-75 ">
                          <div class="progress-info  mb-1">
                            <div class="progress-percentage">
                              <span class="text-xs font-weight-bold">({{$requirement->completedDocumentsCount}} out of {{$requirement->totalDocumentsCount}})</span> | 
                              <span class="text-xs font-weight-bold">{{$requirement->completionPercentageFormatted}}%</span>
                            </div>
                          </div>
                          <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ $requirement->completionPercentageFormatted }}" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                      <td class="text-center"> 
                        <a href="/{{$requirement->service->service_name}}/{{$requirement->id}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Requirement">
                            <i class="fas fa-edit text-secondary"></i>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                @else
                <tr>
                  <td col-span="4">No records found</td>
                </tr>
                @endif
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
      function updateProgressBar(progressbar, percentage) {
          $(progressbar).animate({
              width: percentage + "%"
          }, 500); // Animation duration in milliseconds
      }

      $('.table-row').each(function() {
          var $progressbar = $(this).find('.progress-bar');
          var percentage = parseInt($progressbar.attr("aria-valuenow"));

          if (!isNaN(percentage)) {
              updateProgressBar($progressbar, percentage);
          } else {
              console.log("Invalid percentage value");
          }
      });

      $(document).on('input', '.filter-input', function(){
            var text = $(this).val();
            var service = $('.service_category').val();
            var completed = $('.completed_category').val();
            var deficient = $('.deficient_category').val();
            $.get("{{ route('html-functions', ['id' => 'get-filtered-student-management-list']) }}", {
                filter_service: service,
                filter_completed: completed,
                filter_deficient: deficient,
                filter_text: text,
            }, function(html) {
                $('#table_body').html(html);
            });
        });

     
    });
</script> 
@endsection


