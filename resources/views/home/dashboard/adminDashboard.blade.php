@extends('share.dashboardLayout')
@section("taskTitle", "My Dashboard")
@section("taskDashboardActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                {{-- code start --}}

                @if(isset($user_role) && ($user_role == 1 || $user_role == 2))
                        <canvas id="myChart" class="" style="width:100%; max-height: 270px;"></canvas>
                        <hr />
                        <div class="row">
                            <div class="col-md-4 p-2">
                                <a class="text-decoration-none" href="#">
                                    <div class="card p-3 shadow bg-purple text-center border-0">
                                    <div class="card-body">
                                        <i class="fa fa-bookmark-o fa-2x" aria-hidden="true"> {{ isset($totalUser) ? $totalUser : '0' }}  </i>
                                        <hr />
                                        <p class="card-title lead">Total User</p>
                                    </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 p-2">
                                <a class="text-decoration-none" href="#">
                                    <div class="card p-3 shadow bg-purple text-center border-0">
                                    <div class="card-body">
                                        <i class="fa fa-bookmark-o fa-2x" aria-hidden="true"> {{ isset($totalDealerRequestPending) ? $totalDealerRequestPending : '0' }} </i>
                                        <hr />
                                        <p class="card-title lead">Total Upload</p>
                                    </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 p-1 pt-2">
                                <a class="text-decoration-none" href="#">
                                    <div class="card p-1 shadow bg-purple text-center border-0">
                                    <div class="card-body">
                                        <img class="rounded-circle" style="width:50px;height:50px" alt="User Avatar" src="{{isset($userAvatar) ? $userAvatar : ''}}" data-holder-rendered="true">
                                        <hr />
                                        <p class="card-title lead">Photo</p>
                                    </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <hr />

                        <hr />

                        {{-- New Seller Request --}}
                        <div class="table-responsive pb-3">
                            <div class="text-center text-success text-uppercase bg-gray p-2">
                                <strong>Pending New User Registrations</strong>
                            </div>
                            <table class="table table-hover table-responsive table-condensed">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone No.</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($getNewUser) && $getNewUser)
                                        @foreach ($getNewUser as $key=>$user)
                                            <tr>
                                                <td>{{ ($key + 1) }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ ($user->status ? 'Active' : 'Pending') }}</td>
                                                <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                @else
                    <div class="row">
                        <div class="col-md-4 p-2">
                            <a class="text-decoration-none" href="#">
                                <div class="card p-3 shadow bg-purple text-center border-0">
                                <div class="card-body">
                                    <i class="fa fa-bookmark-o fa-2x" aria-hidden="true"> {{ Auth::check() && Auth::user()->status == 1 ? 'Active' : 'Disabled' }}</i>
                                    <hr />
                                    <p class="card-title lead">Status</p>
                                </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 p-2">
                            <a class="text-decoration-none" href="#">
                                <div class="card p-3 shadow bg-purple text-center border-0">
                                <div class="card-body">
                                    <i class="fa fa-bookmark-o fa-2x" aria-hidden="true"> {{ Auth::check() && Auth::user()->suspend == 0 ? 'No' : 'Yes' }} </i>
                                    <hr />
                                    <p class="card-title lead">Suspended</p>
                                </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 p-1 pt-2">
                            <a class="text-decoration-none" href="#">
                                <div class="card p-1 shadow bg-purple text-center border-0">
                                <div class="card-body">
                                    <img class="rounded-circle" style="width:50px;height:50px" alt="User Avatar" src="{{isset($userAvatar) ? $userAvatar : ''}}" data-holder-rendered="true">
                                    <hr />
                                    <p class="card-title lead">Photo</p>
                                </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 p-2">
                            <a class="text-decoration-none" href="#">
                                <div class="card p-3 shadow bg-purple text-center border-0">
                                <div class="card-body">
                                    <i class="fa fa-envelope fa-2x" aria-hidden="true"> 10 </i>
                                    <hr />
                                    <p class="card-title lead">Message</p>
                                </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 p-2">
                            <a class="text-decoration-none" href="#">
                                <div class="card p-3 shadow bg-purple text-center border-0">
                                <div class="card-body">
                                    <i class="fa fa-bell fa-2x" aria-hidden="true"> 19</i>
                                    <hr />
                                    <p class="card-title lead">Notification</p>
                                </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 p-2">
                            <a class="text-decoration-none" href="#" data-toggle="modal" data-target="#modelHELP">
                                <div class="card p-3 shadow bg-purple text-center border-0">
                                <div class="card-body">
                                    <i class="fa fa-question fa-2x" aria-hidden="true"> {{ isset($isDealerRequestApproved) ? ($isDealerRequestApproved ? 'Approved' : 'Pending') : 'Pending' }}</i>
                                    <hr />
                                    <p class="card-title lead"> Dealership Request </p>
                                </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive pb-3 pt-4">
                        <div class="text-center text-success text-uppercase bg-gray p-2">
                            <strong>Notifications</strong>
                        </div>
                        <table class="table table-hover table-responsive table-condensed">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Message</th>
                                    <th>Created Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($notifications) && $notifications)
                                    @foreach ($notifications as $key=>$message)
                                        <tr>
                                            <td>{{ ($key + 1) }}</td>
                                            <td>{{ $message->message }}</td>
                                            <td>{{ date('d-m-Y', strtotime($message->created_at)) }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endif
                {{-- code ends here --}}
            </div>
        </div>
    </div>
</div>

@endsection
