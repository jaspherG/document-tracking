@if(count($requirements) > 0)
  @foreach($requirements as $key => $requirement) 
    <tr class="table-row">
      <td>{{ $key += 1}}</td>
      <td class="ps-4">{{$requirement->user_student->name}}</td>
      <td class="ps-4">{{$requirement->user_student->student_number}}</td>
      <td class="ps-4">{{$requirement->user_student->course}}</td>
      <td class="ps-4">{{$requirement->user_student->class_year}}</td>
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
      <td class="ps-4">{{$requirement->academic_year}}</td>
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
     
    });
</script>