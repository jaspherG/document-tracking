@extends('layouts.user_type.auth')

@section('content')
<a class="nav-link {{ ($_page == 'deficiency' ? 'active' : '') }}" href="{{ url('deficiency') }}">
<div class="row  mb-2">
  <div class="col-12 mb-md-0  d-flex align-items-center justify-content-center gap-2 pt-2">
  @if(isset($service) && count($service) > 0)
        @foreach($service as $service)
        <option value="{{ $service->id }}" >{{ucfirst($service->service_name)}}</option> 
        @endforeach
      @endif
  </div>
</div>

<div class="card-body px-0 pt-0 pb-2">
  <div class="p-0">
    <table id="example" class="table align-items-center mb-0 table-hover table table-striped" style="width:100%">
      <thead>
          <tr>
          <table id="example" class="table table-striped" style="width:100%">
            <th>#</th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                Photo
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
              Students Number
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7" >
              Student Name                    
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
              Program
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
              Year Level
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
              Remarks
            </th>
        </tr>
        </thead>
        <tbody id="table_body">
        @if(isset($students) && count($students) > 0)
            @foreach($students as $key => $student)
            <tr>
                <td class="ps-4">
                    <p class="text-xs font-weight-bold mb-0">{{$key+1}}</p>
                </td>
                <td>
                    <div>
                        <a data-fslightbox="student-list" href="{{(!empty($student->image) ? '/images/avatars/'.$student->image : '/images/user.jpg' )}}">
                            <img src="{{(!empty($student->image) ? '/images/avatars/'.$student->image : '/images/user.jpg' )}}" class="avatar avatar-sm me-3">
                        </a>
                    </div>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$student->student_number}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$student->name}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$student->program->program_name ?? ''}}</p>
                </td>
                <td class="text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{$student->class_year}}</span>
                </td>
                <td class="text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{$student->remarks}}</span>
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

@endsection