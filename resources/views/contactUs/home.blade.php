@extends('layouts.guest')
@section("pageTitle", "Contact Us")
@section("currentPageContactUs", "active")
@section('closeAllCategoty', null)
@section('pageContent')

    <!-- page details-->
    <div class="container">
        @if(isset($viewPageDetails) && $viewPageDetails)
            <div class="pt-0 bg-white rounded">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 bg-blue">
                            <div style="padding: 30px;">
                                <div class="text-left fw-bold text-white text-uppercase">
                                    <h2><strong>@yield('pageTitle')</strong></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 bg-white">
                            <div style="padding: 2px;">
                                {{-- body --}}
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div align="center" class="contact-info m-0 p-3">
                                                <span class="fa fa-envelope fa-5x"></span>
                                                <h6 class="text-brown pt-3">
                                                    You can email your questions, suggestions, and comments at <span class="text-info">support@docsystem.com</span>
                                                </h6>
                                                <div class="pt-3">
                                                    <img src="{{asset('assets/images/contact-us.png')}}" alt=" "/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <form method="POST" action="{{ route('contactUs') }}" enctype="multipart/form-data">
                                            @csrf
                                                <div class="text-yellow text-uppercase m-1 p-2">
                                                    <h6 class="text-yellow fw-bolder">Send us your message</h6>
                                                    <hr />
                                                </div>
                                                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                                                <div class="contact-form">
                                                    <div class="form-group m-2">
                                                        <label class="control-label col-sm-2" for="firstName">First Name:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="firstName" required placeholder="Enter First Name" name="firstName">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-2">
                                                        <label class="control-label col-sm-2" for="lastName">Last Name:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name" name="lastName">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-2">
                                                        <label class="control-label col-sm-2" for="email">Email:</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control" id="email" required placeholder="Enter email" name="email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-2">
                                                        <label class="control-label col-sm-2" for="message">Message:</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" required rows="5" name="message" id="message"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div align="right" class="col-sm-offset-2 col-sm-10">
                                                            <button type="reset" class="btn btn-warning btn-lg p-2 pb-4 m-3" style="font-size: 14px;">Reset</button>
                                                            <button type="submit" class="btn btn-success btn-lg p-2 pb-4 m-3" style="font-size: 14px;">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <hr />
                                </div>

                                {{-- /body --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <div class="product-details-area pt-20 pb-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 p-2">
                            <div class="text-decoration-none">
                                <div class="card p-3 shadow bg-warning text-center border-0">
                                    <div class="card-body">
                                        <i class="fa fa-clock-o fa-2x text-white" aria-hidden="true"> Check Back After: <span id="timer"></span> </i>
                                        <hr />
                                        <p class="card-title lead text-danger fs-17 fw-bolder">
                                            Down for maintenance. We apologise for any inconveniences.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        @endif
    </div>



@endsection

@section('style')
    <style>

    </style>
@endsection

@section('script')
    <script>

    </script>
@endsection
