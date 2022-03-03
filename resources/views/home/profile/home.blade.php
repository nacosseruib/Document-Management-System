@extends('share.dashboardLayout')
@section("taskTitle", "Profile")
@section("taskProfileActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey mb-3">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}
                <div>
                    <b>PROFILE IMAGE</b>
                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#updateProfileImageModal"><span class="fa fa-edit fa-2x"></span></a>
                </div>
                <hr />
                <div class="row">
                    <div align="center" class="col-md-12 p-2">
                        <img class="rounded-circle" style="width:130px;height:130px" alt="User Avatar" src="{{isset($userAvatar) ? $userAvatar : ''}}" data-holder-rendered="true">
                    </div>
                </div>
                {{-- code ends here --}}
            </div>
        </div>
    </div>
</div>

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                {{-- code start --}}
                <div>
                    <b>PROFILE DETAILS</b>
                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#updateProfileDetailsModal"><span class="fa fa-edit fa-2x"></span></a>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12 p-2">
                        <b>Full Name:</b> {{ isset($getUser) && $getUser ? $getUser->first_name . ' '. $getUser->last_name : '' }}
                    </div>
                    <div class="col-md-12 p-2">
                        <b>Email Address:</b> {{ isset($getUser) && $getUser ? $getUser->email : '' }}
                    </div>
                    <div class="col-md-12 p-2">
                        <b>Phone Number:</b> {{ isset($getUser) && $getUser ? $getUser->phone_number : '' }}
                    </div>
                    <div class="col-md-12 p-2">
                        <b>User Type:</b> {{ isset($getUser) && $getUser ? $getUser->phone_number : '' }}
                    </div>
                    {{-- @if(isset($getUser) && $getUser && $getUser->seller_id)
                        <div class="col-md-12 p-2">
                            <b>User's ID:</b> {{ isset($getUser) && $getUser ? $getUser->seller_id : '' }}
                        </div>
                    @endif --}}
                </div>
                {{-- code ends here --}}
            </div>
        </div>
    </div>
</div>

<div class="brand-area dotted-style-2 bg-grey mt-3">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                {{-- code start --}}
                <div>
                    <b>SECURITY</b>
                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#updateSecurityModal"><span class="fa fa-edit fa-2x"></span></a>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12 p-2">
                        <b>Password: <span class="fs-5">***************</span></b>
                    </div>
                </div>
                {{-- code ends here --}}
            </div>
        </div>
    </div>
</div>


<!-- Edit Profile Image Modal -->
<form method="POST" action="{{ route('saveProfileImage') }}" enctype="multipart/form-data">
    @csrf
<div class="modal fade" id="updateProfileImageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 10000000000;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span class="fa fa-upload"></span> Update Profile Image </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- body --}}
                <div class="">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
                            <div class="card border-0 shadow rounded-3 my-0">
                                <div class="card-body p-2 p-sm-3 m-1" style="overflow: auto; max-height: 300px;">
                                    <div class="logo pb-1">
                                        <input type="file" class="form-control" name="profileImage" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end body --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Upload</button>
            </div>
        </div>
    </div>
</div>
</form>
<!--end Modal-->

<!-- Edit Profile Details Modal -->
<form method="POST" action="{{ route('updateProfileDetails') }}" enctype="multipart/form-data">
    @csrf
<div class="modal fade" id="updateProfileDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 10000000000;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span class="fa fa-save"></span> Update Profile Details </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- body --}}
                <div class="">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
                            <div class="card border-0 shadow rounded-3 my-0">
                                <div class="card-body p-2 p-sm-3 m-1" style="overflow: auto; max-height: 400px;">
                                    <div class="row">
                                        <div class="col-md-12 p-1">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="firstName" required value="{{ isset($getUser) && $getUser ? $getUser->first_name : '' }}" />
                                        </div>
                                        <div class="col-md-12 p-1">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="lastName" value="{{ isset($getUser) && $getUser ? $getUser->last_name : '' }}" />
                                        </div>
                                        <div class="col-md-12 p-1">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="phoneNumber" value="{{ isset($getUser) && $getUser ? $getUser->phone_number : '' }}" />
                                        </div>
                                        <div class="col-md-12 p-1">
                                            <label>Email Address</label>
                                            <div class="form-control bg-grey">{{ isset($getUser) && $getUser ? $getUser->email : '' }}</div>
                                            <input type="hidden" class="form-control" name="email" value="{{ isset($getUser) && $getUser ? $getUser->email : '' }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end body --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Save</button>
            </div>
        </div>
    </div>
</div>
</form>
<!--end Modal-->



<!-- Edit Password Modal -->
<form method="POST" action="{{ route('updateProfileSecurity') }}" enctype="multipart/form-data">
    @csrf
<div class="modal fade" id="updateSecurityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 10000000000;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span class="fa fa-save"></span> Update Password </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- body --}}
                <div class="">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
                            <div class="card border-0 shadow rounded-3 my-0">
                                <div class="card-body p-2 p-sm-3 m-1" style="overflow: auto; max-height: 400px;">
                                    <div class="row">
                                        <div class="col-md-12 p-1">
                                            <label>Current Password</label>
                                            <input type="password" class="form-control" name="currentPassword" required placeholder="Current"/>
                                        </div>
                                        <div class="col-md-12 p-1">
                                            <label>New Password</label>
                                            <input type="password" class="form-control" name="password" required placeholder="Password"/>
                                        </div>
                                        <div class="col-md-12 p-1">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation" required placeholder="Confirm"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end body --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Save</button>
            </div>
        </div>
    </div>
</div>
</form>
<!--end Modal-->



@endsection
