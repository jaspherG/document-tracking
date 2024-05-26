@extends('layouts.user_type.registrar')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
        {{$programData->description}} ({{$programData->program_name}})

        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Students</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Course
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($students) && count($students) > 0)
                                    @foreach($students as $key => $student)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$key+1}}</p>
                                        </td>
                                        <td>
                                            <div>
                                                <img src="{{(!empty($student->image) ? '/images/avatars/'.$student->image : '/images/user.jpg' )}}" class="avatar avatar-sm me-3">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$student->name}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$student->email}}</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$student->course}}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="/student/{{$student->id}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <a href="#" type="button" class="mx-3 delete-student" data-bs-toggle="tooltip" data-bs-original-title="Delete {{ $student->name}}" data-id="{{ $student}}">
                                                <i class="text-danger fas fa-trash text-secondary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <button type="button" id="openDeleteModal" class="btn btn-primary float-end btn-md mt-4 mb-4 visually-hidden" data-bs-toggle="modal" data-bs-target="#deleteModal">
        Received By
    </button>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/user-delete" method="POST">
                @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="m-1">
                                Confirm to delete. <span id="deleteName"></span>
                            </div>
                            <input type="hidden" id="deleteId" name="id" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '.delete-student', function(){ 
            var data = $(this).data('id'); 
            // var data = JSON.parse(jdata);
            var id = data.id; 
            var name = data.name;
            $('#deleteId').val(id); // Set the value of the hidden input field
            $('#deleteName').text(name); // Set the value of the hidden input field
            $('#openDeleteModal').trigger('click'); // Show the modal
        });
    });
 

</script>
 
@endsection