@extends('share.dashboardLayout')
@section("taskTitle", "List of User")
@section("taskListUserActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}

                    <div class="table-responsive pb-3">
                        <table class="table table-hover table-responsive table-condensed">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone No.</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Email Confirmed</th>
                                    <th>Suspended</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($getNewUser) && $getNewUser)
                                    @foreach ($getNewUser as $key=>$user)
                                        <tr>
                                            <td>{{ ($getNewUser->currentpage()-1) * $getNewUser->perpage() + (1+$key) }}</td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->phone_number }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role_name }}</td>
                                            <td>{!! ($user->status ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>') !!}</td>
                                            <td>{!! ($user->suspend ? '<span class="text-danger">Yes</span>' : '<span class="text-success">No</span>') !!}</td>
                                            <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                                            <td>
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#updateUserStatus{{$key}}">Update</a>
                                            </td>
                                        </tr>
                                        @includeIf('share.updateUserStatusPopupModal')
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="row">
                            <div align="right" class="col-md-12 pr-5">
                                @if(isset($getNewUser))
                                    Showing {{($getNewUser->currentpage()-1)*$getNewUser->perpage()+1}}
                                    to {{$getNewUser->currentpage()*$getNewUser->perpage()}}
                                    of  {{$getNewUser->total()}} entries
                                    <div class="hidden-print pull-left">{{ $getNewUser->links() }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                {{-- code ends here --}}
            </div>
        </div>
    </div>
</div>

@endsection
