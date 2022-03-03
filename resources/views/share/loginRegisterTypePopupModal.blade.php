@if($showPopup == 1)
    <!-- Register Modal -->
    <div class="modal fade" id="chooseLoginRegisterTypeMethod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 10000000000;">
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
                            <div class="card-body p-2 p-sm-3 m-1">
                                <div align="center" class="logo pb-1">
                                    <div align="right" style="margin: -15px; padding-right: 5px;">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <a href="{{ Route::has('index') ? Route('index') : 'javascript:;' }}">
                                        <img src="{{asset('assets/images/logo/logo.png')}}"  width="150"/>
                                    </a>
                                </div>

                                <div class="d-grid m-2">
                                    <a href="javascript:;" class="btn btn-primary btn-login text-uppercase fw-bold pb-5 rounded" data-bs-toggle="modal" data-bs-target="#chooseLoginMethod">
                                        <i class="fa fa-envelope fa-2x"></i> Sign in with email
                                    </a>
                                </div>
                                <div class="d-grid m-2">
                                    <a href="javascript:;" class="btn btn-secondary btn-login text-uppercase fw-bold pb-5 rounded" data-bs-toggle="modal" data-bs-target="#chooseRegisterMethod">
                                        <i class="fa fa-user fa-2x"></i> Don't have an account? Register
                                    </a>
                                </div>
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
