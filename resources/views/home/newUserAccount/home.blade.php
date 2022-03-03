@extends('share.dashboardLayout')
@section("taskTitle", "New Account")
@section("taskNewAccountActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-8">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}

                    <form action="{{ route('saveNewAccount') }}" method="POST">
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
                        <div class="form-floating mb-3">
                            <select name="userRole" required class="form-control-lg bg-white @error('userRole') is-invalid @enderror" wire:model="userRole" id="userRole">
                                <option value="" selected>- Select -</option>
                                <option value="2">Admin</option>
                                <option value="3">Buyer</option>
                                <option value="4">Seller</option>
                            </select>
                            {{-- <label for="userRole">User's Role</label> --}}
                            @error('userRole')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <hr />
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div align="center" class="form-floating mt-3">
                                    <button type="reset" class="bg-warning text-white p-2 fs-14" style="border-radius: 60px;"><strong> &nbsp; Reset &nbsp; </strong> </button>
                                    <button type="submit" class="bg-blue text-white p-2 fs-14" style="border-radius: 60px;"><strong> &nbsp; Create &nbsp; </strong> </button>
                                </div>
                            </div>
                        </div>
                    </form>

                {{-- code ends here --}}
            </div>
        </div>
    </div>
</div>

@endsection
