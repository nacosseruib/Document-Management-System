
    <!-- View Modal -->
    <form method="POST" action="{{ route('updateUserStatus') }}" enctype="multipart/form-data">
        @csrf
    <div class="modal fade" id="updateUserStatus{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 10000000000;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Update User</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- body --}}
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
                                <div class="card border-0 shadow rounded-3 my-0">
                                    <div class="card-body p-2 p-sm-3 m-1">
                                        <div class="row">
                                            <div class="col-md-12 m-2">
                                                <label class="p-1">First Name</label>
                                                <input type="text" name="firstName" class="form-control" value="{{ $user->first_name }}" required>
                                            </div>
                                            <div class="col-md-12 m-2">
                                                <label class="p-1">Last Name</label>
                                                <input type="text" name="lastName" class="form-control" value="{{ $user->last_name }}">
                                            </div>
                                            <div class="col-md-12 m-2">
                                                <label class="p-1">Email Address</label>
                                                <input type="email" name="emailAddress" class="form-control" value="{{ $user->email }}" required>
                                            </div>
                                            <div class="col-md-12 m-2">
                                                <label class="p-1">Phone Number</label>
                                                <input type="text" name="phoneNumber" class="form-control" value="{{ $user->phone_number }}">
                                            </div>

                                            <div class="col-md-12 m-2">
                                                <label class="p-1">Confirm Email (Status)</label>
                                                <select id="confirmEmail" name="confirmEmail" class="form-control" required>
                                                    <option value=" ">- Select -</option>
                                                    <option value="1" {{$user->status == 1 ? 'selected' : ''}}>Confirmed</option>
                                                    <option value="0" {{$user->status == 0 ? 'selected' : ''}}>Unconfirmed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 m-2">
                                                <label class="p-1">Suspend User</label>
                                                <select id="userSuspension" name="userSuspension" class="form-control" required>
                                                    <option value="">- Select -</option>
                                                    <option value="1" {{$user->suspend == 1 ? 'selected' : ''}}>Suspended</option>
                                                    <option value="0" {{$user->suspend == 0 ? 'selected' : ''}}>Activated</option>
                                                </select>
                                                <input type="hidden" name="userName" value="{{ $user->id }}" >
                                            </div>
                                            <div class="col-md-12 m-2">
                                                <label class="p-1">User Type/Role</label>
                                                <select id="role" name="role" class="form-control" required>
                                                    <option value="">- Select -</option>
                                                    @if(isset($userRole) && $userRole)
                                                        @foreach ($userRole as $key=>$role)
                                                            <option value="{{ $role->roleID }}" {{$user->user_role == $role->roleID ? 'selected' : ''}}>{{ $role->role_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <input type="hidden" name="userName" value="{{ $user->id }}" >
                                            </div>
                                            <div class="col-md-12 m-2">
                                                <label class="p-1">Reset Password</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                            <div class="col-md-12 m-2">
                                                <label class="p-1">Confirm Password</label>
                                                <input type="password" name="password_confirmation" class="form-control">
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
                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--end view Modal-->
</form>

