<div class="">
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
        <div class="card border-0 shadow rounded-3 my-0">
        <div class="card-body p-2 p-sm-3">
            <div align="center" class="logo pb-1">
                <div align="right" style="margin: -15px; padding-right: 5px;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <a href="{{ Route::has('index') ? Route('index') : 'javascript:;' }}">
                    <img src="{{asset('assets/images/logo/logo.png')}}"  width="150"/>
                </a>
            </div>
            <h5 class="card-title text-center mb-3 fw-bolder fs-5">Sign In</h5>
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="form-floating mb-3">
                    <input type="text" placeholder="Email or Username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="email" autofocus>
                    <label for="floatingInput">Email address <span class="text-danger">*</span></label>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" required autocomplete="current-password" placeholder="Password">
                    <label for="floatingPassword">Password <span class="text-danger">*</span></label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                    <label class="form-check-label" for="form1Example3">
                    Remember password
                    </label>
                </div> --}}
                <div class="d-grid">
                    <button class="btn btn-primary btn-login text-uppercase fw-bold pb-5 rounded" type="submit">
                       <div> Sign in </div>
                    </button>
                    <div class="p-2">
                        <a class="text-default" href="{{ Route::has('forgetPassword') ? Route('forgetPassword') : 'javascript:;' }}" title="Forget Password">
                            <span class="tex_top_email"><i class="fa fa-lock"> Forgot password? </i></span>
                        </a>
                        |
                        <a href="javascript:;" title="Sign up as a new member" data-bs-toggle="modal" data-bs-target="#chooseRegisterMethod">
                            <span class="tex_top_email"><i class="fa fa-user"> Don't have an account? Register </i></span>
                        </a>
                    </div>
                </div>
            </form>
            <hr class="my-4">

        </div>
        </div>
    </div>
    </div>
</div>
