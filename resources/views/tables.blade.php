@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0 font-weight-bolder  alert alert-dark mx-10 role=alert text-white text-center text-primary">{{ __('Student Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/user-profile" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Name" id="user-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Phone') }}</label>
                                <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="tel" placeholder="12345" id="number" name="phone" value="{{ auth()->user()->phone }}">
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.address" class="form-control-label">{{ __('Address') }}</label>
                                <div class="@error('user.address') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Address" id="name" name="address" value="{{ auth()->user()->address }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.course" class="form-control-label">{{ __('Course') }}</label>
                                <div class="@error('user.course') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Course" id="name" name="course" value="{{ auth()->user()->course }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.course" class="form-control-label">{{ __('LRN') }}</label>
                                <div class="@error('user.course') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="LRN" id="name" name="course" value="{{ auth()->user()->course }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </form> 

            </div>
            <div class="row mt-5" >
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                             <h6 class="font-weight-bolder alert alert-dark mx-10 role=alert text-white text-center text-primary">Student Requirements for Freshmen</h6>
                        </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center justify-content-center mb-0">
                                        <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Documents</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Completion</th>
                                            <th></th>
                                    </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Grade 10 Report Card</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                <div class="checklist">
                                                        <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Grade 11 Report Card</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="checklist">
                                                        <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                            <td class="align-middle">
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Grade 12 Report Card</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                <div class="checklist">
                                                        <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                                                    </div>
                                            </td>
                                            <td class="align-middle">
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Good Moral</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                <div class="checklist">
                                                        <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                                                    </div>
                                            </td>
                                            <td class="align-middle">
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">X-ray & Medical Certificate</h6>
                                                </div>
                                            </td>
                                                
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                <div class="checklist">
                                                        <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                                                    </div>
                                            </td>
                                            <td class="align-middle">
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Original PSA Birthcertificate</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                <div class="checklist">
                                                        <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                                                    </div>
                                            </td>
                                            <td class="align-middle">
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Form 137-A Copy for PUP Bansud</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                <div class="checklist">
                                                        <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                                                    </div>
                                            </td>
                                            <td class="align-middle">
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">SARF</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                <div class="checklist">
                                                        <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                                                    </div>
                                            </td>
                                            <td class="align-middle">
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Affidavit of Non-Enrollment</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                <div class="checklist">
                                                        <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                                                    </div>
                                            </td>
                                            <td class="align-middle">
                                            </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
        <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary float-end btn-md mt-4 mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                     Received By
                    </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Name" id="user-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Forward To</button>
            </div>
            </div>
        </div>
        </div>
        </div>
@endsection