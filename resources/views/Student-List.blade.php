@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Students</h5>
                        </div>
                        <div class=" d-flex align-items-center">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control filter-input" placeholder="Type here...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class=" p-0">
                        <table class="table align-items-center mb-0 table-hover ">
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
                            <tbody id="table_body">
                                @if(count($students) > 0)
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
                                            <p class="text-xs font-weight-bold mb-0">{{$student->name}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$student->email}}</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$student->course}}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="/student/{{$student->id}}" class="mx-1" data-bs-toggle="tooltip" data-bs-original-title="Edit {{ $student->name}}">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <a href="#" type="button" class="mx-1 add-requirement" data-bs-toggle="tooltip" data-bs-original-title="Add Requirement to {{ $student->name}}"  data-id="{{ $student->id}}">
                                                <i class="fas fa-edit text-secondary"></i>
                                            </a>
                                            <a href="#" type="button" class="delete-student" data-bs-toggle="tooltip" data-bs-original-title="Delete {{ $student->name}}" data-id="{{ $student}}">
                                                <i class="text-danger fas fa-trash text-secondary"></i>
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
    
    <!-- Modal -->
    <button type="button" id="openDeleteModal" class="btn btn-primary float-end btn-md mt-4 mb-4 visually-hidden" data-bs-toggle="modal" data-bs-target="#deleteModal">
        open deleteModal
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
    <!-- Modal -->
    <button type="button" id="openRequirement" class="btn btn-primary float-end btn-md mt-4 mb-4 visually-hidden" data-bs-toggle="modal" data-bs-target="#addRequirement">
        open addRequirement
    </button>
    <div class="modal fade" id="addRequirement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose Service</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <table class="table table-hover d-flex justify-content-center w-100">
                            <tr>
                                <td>
                                    <a class="service-requirement" href="javascript:void(0)" name="admission" data-id="">
                                        <h6 class="mb-0"><i class="fas fa-receipt mx-2 text-dark"></i>Admission</h6>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a class="service-requirement" href="javascript:void(0)" name="returnee" data-id="">
                                        <h6 class="mb-0"><i class="fas fa-receipt mx-2 text-dark"></i>Returnee</h6>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a class="service-requirement" href="javascript:void(0)" name="transferee" data-id="">
                                        <h6 class="mb-0"><i class="fas fa-receipt mx-2 text-dark"></i>Transferee</h6>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a class="service-requirement" href="javascript:void(0)" name="cross-enroll" data-id="">
                                        <h6 class="mb-0"><i class="fas fa-receipt mx-2 text-dark"></i>Cross-enroll</h6>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
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

        $(document).on('click', '.add-requirement', function(){  
            var id = $(this).data('id'); 
            var $requirementModal = $('#addRequirement');
            $($requirementModal).find('.service-requirement').attr('data-id', id);
            $('#openRequirement').trigger('click');
        });

        $(document).on('click', '.service-requirement', function(){ 
            var id = $(this).data('id'); 
            var name = $(this).attr('name');
            window.location.href = `/${name}?student_id=${id}`;
        });

        $(document).on('input', '.filter-input', function(){
            var text = $(this).val();
            $.get("{{ route('html-functions', ['id' => 'get-filtered-student-list']) }}", {
                filter_text: text
            }, function(html) {
                $('#table_body').html(html);
            });
        });
        
    });
 

</script>
 
@endsection