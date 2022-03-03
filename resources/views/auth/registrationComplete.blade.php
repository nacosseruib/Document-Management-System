@extends('layouts.guest')
@section("pageTitle", "Registration Completed")
@section("currentPageMyAccount", "active")
@section('closeAllCategoty', null)
@section('pageContent')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body bg-grey">
                    <div class="p-4">
                        @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                        <br />
                        @if(session('status'))
                            <div class="text-center text-success p-3">
                                <span class="fa fa-envelope fa-3x"></span>
                                <br /> <br />
                                <h6 class="text-center text-success text-uppercase">
                                    <b>You need to confirm you email address!</b>
                                </h6>
                                <div class="text-center p-2">
                                    We have sent a confirmation email to your inbox. <br /> Click on the link sent to your email inbox to confirm your email address.
                                    <br /><br />
                                    Thank you.
                                </div>
                            </div>
                        @else
                            <div class="text-center text-danger p-3">
                                <span class="fa fa-envelope fa-3x"></span>
                                <br /><br />
                                <h6 class="text-center text-danger text-uppercase">
                                    <b>Your registration is not successful!</b>
                                </h6>
                                <div class="text-center fs-6 p-2">
                                    <div class="p-2">Please try again</div>
                                    Thank you.
                                </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

