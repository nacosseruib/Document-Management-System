@extends('layouts.guest')
@section("pageTitle", "Login")
@section("currentPageMyAccount", "active")
@section('closeAllCategoty', null)
@section('pageContent')

    <div class="row">
        <div class="col-md-5 offset-md-4">
            <div class="card">
                <div class="card-body m-3">

                    @includeIf('share.loginView')

                </div>
            </div>
        </div>
    </div>

@endsection
