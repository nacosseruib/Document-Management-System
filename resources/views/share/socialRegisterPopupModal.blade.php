@if($showPopup == 1)
    <!-- Register Modal -->
    <div class="modal fade" id="chooseRegisterMethod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 10000000000;">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <div class="modal-body">
                    {{-- body --}}
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
                                <h5 class="card-title text-center mb-3 fw-bolder fs-5">Register as a new memebr</h5>
                               <form action="{{ route('register') }}" method="POST">  {{-- wire:submit.prevent="submit" --}}
                                @csrf
                                    <div class="form-floating mb-3">
                                        <input type="email" wire:model="email" value="{{old('email')}}" name="email" id="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus>
                                        <label for="email">Email address <span class="text-danger">*</span></label>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" wire:model="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required autocomplete="current-password" placeholder="Password">
                                        <label for="Password">Password <span class="text-danger">*</span></label>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" wire:model="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" required placeholder="Confirm Password">
                                        <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" placeholder="First Name" name="firstName" value="{{old('firstName')}}" class="form-control @error('firstName') is-invalid @enderror" wire:model="firstName" id="firstName" required>
                                        <label for="firstName">First Name <span class="text-danger">*</span></label>
                                        @error('firstName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" placeholder="lastName" name="lastName" value="{{old('lastName')}}" class="form-control @error('lastName') is-invalid @enderror" wire:model="lastName" id="lastName" required>
                                        <label for="lastName">Last Name <span class="text-danger">*</span></label>
                                        @error('lastName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="phoneNumber" value="{{old('phoneNumber')}}" placeholder="Phone Number (Digit only) - Option" class="form-control @error('phoneNumber') is-invalid @enderror" wire:model="phoneNumber" id="phoneNumber">
                                        <label for="phoneNumber">Phone Number</label>
                                        @error('phoneNumber')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" name="termsAndCondition" type="checkbox" checked wire:model="termsAndCondition" id="termsAndCondition">
                                        <a href="{{Route::has('viewVisitorPage') ? Route('viewVisitorPage', ['pageRoute'=>'terms-and-conditions']) : 'javascript:;' }}" class="form-check-label" for="termsAndCondition">
                                            I agree with our terms & Conditions
                                        </a>
                                        |
                                        <a href="javascript:;" title="Login to your account" data-bs-toggle="modal" data-bs-target="#chooseLoginMethod">
                                            <span class="tex_top_email"><i class="fa fa-sign-in"> Have an account, Login </i></span> &nbsp;
                                        </a>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-login text-uppercase fw-bold pb-5 rounded" type="submit">
                                            Register
                                        </button>
                                    </div>
                                </form>
                                <hr class="my-4">
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    {{-- end body --}}
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> --}}
            </div>
        </div>
    </div>
<!--end Register Modal-->
@endif
