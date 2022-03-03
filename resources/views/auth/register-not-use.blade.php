@extends('layouts.guest')
@section("pageTitle", "Sign upp as a new member")
@section("currentPageMyAccount", "active")
@section('closeAllCategoty', null)
@section('pageContent')

    <div class="row">
        <div class="col-md-5 offset-md-4">
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                            <!-- account area start -->
                            <div class="account-area pt-30 log">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="account-info pb-30">
                                                <form action="#">
                                                    <div class="form-fields">
                                                        <h2>Account Login</h2>
                                                        <div>@includeIf('share.operationCallBackAlert', ['showAlert'=>1])</div>
                                                        <p>
                                                            <label>First Name <span class="required">*</span></label>
                                                            <input type="text" placeholder="First Name" class="@error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="first name">
                                                            @error('firstName')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p>
                                                            <label>Last Name </label>
                                                            <input type="text" placeholder="Last Name" class="@error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" autocomplete="last name">
                                                            @error('lastName')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p>
                                                            <label>Username </label>
                                                            <input type="text" placeholder="Username" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username">
                                                            @error('username')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p>
                                                            <label>Email address <span class="required">*</span></label>
                                                            <input type="email" placeholder="Email Address" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p>
                                                            <label>Password<span class="required">*</span></label>
                                                            <input type="password" name="password" required autocomplete="new-password" placeholder="Password" class="@error('password') is-invalid @enderror">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                        <p>
                                                            <label>Confirm Password<span class="required">*</span></label>
                                                            <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" class="@error('password_confirmation') is-invalid @enderror">
                                                            @error('password_confirmation')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </p>
                                                    </div>
                                                    <div class="form-action">
                                                        <label>
                                                            <a href="{{ Route::has('login') ? Route('login') : 'javascript:;' }}" class="lost_password"> Login Now</a>
                                                        </label>
                                                        <input value="Register" type="submit" class="">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- account area end -->
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

