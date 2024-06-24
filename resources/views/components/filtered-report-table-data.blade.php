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