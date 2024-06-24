@extends('layouts.user_type.auth')

@section('content')
<a class="nav-link {{ ($_page == 'completed' ? 'active' : '') }}" href="{{ url('completed') }}">
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
                    <div class="table-responsive p-0">`
                        <table class="table align-items-center mb-0 table-hover ">
                            <thead>
                                <tr>
                                  <th>Number</th>
                                  <th>Student Number</th>
                                  <th>Student Name</th>
                                  <th>Program</th>
                                  <th>Remarks</th>
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