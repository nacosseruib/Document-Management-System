@extends('layouts.guest')
@section("pageTitle")
    {{isset($pageDetails) && $pageDetails ? $pageDetails->title : '' }}
@stop
@section("currentPageProductDetails", "active")
@section('closeAllCategoty', null)
@section('pageContent')

    <!-- page details-->
    <div class="container">
        @if(isset($viewPageDetails) && $viewPageDetails)
            <div class="product-details-area pt-0 bg-white shadow-md bg-body rounded">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 bg-blue">
                            <div style="padding: 30px;">
                                <div class="text-left fw-bold text-white text-uppercase">
                                    <h2><strong>{{isset($pageDetails) && $pageDetails ? $pageDetails->title : '' }}</strong></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 bg-white">
                            <div style="padding:  20px 100px;">
                                <div class="text-justify">
                                    {!! isset($pageDetails) && $pageDetails ? $pageDetails->content : '' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
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
