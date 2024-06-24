@extends('layouts.user_type.auth')

@section('content')
<a class="nav-link {{ ($_page == 'deficiency' ? 'active' : '') }}" href="{{ url('deficiency') }}">
<div class="row  mb-2">
  <div class="col-12 mb-md-0  d-flex align-items-center justify-content-center gap-2 pt-2">
  @if(isset($programs) && count($programs) > 0)
        @foreach($programs as $program)
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
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Photo
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Students Number
                  </th>
                
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >
                    Student Name                    
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Program
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Year Level
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Academic Year
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Status
                  </th>
        </tr>
        </thead>
        <tbody id="table_body">
                              @if(isset($table_data) && count($table_data) > 0)
                                @foreach($table_data as $key => $data)
                                    <tr>
                                        <td>{{$key+=1}}</td>
                                        <td>{{$data->user_student->student_number}}</td>
                                        <td>{{$data->user_student->name}}</td>
                                        <td>{{$data->program->program_name}}</td>
                                        <td>{{$data->requirement->academic_year}}</td>
                                        <td>{{$data->status}}</td>
                                    </tr>
                                @endforeach
                              @else
                                  <tr>
                                      <td colspan="4">No records found</td>
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