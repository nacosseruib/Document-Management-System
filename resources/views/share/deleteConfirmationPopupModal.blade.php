
    <!-- Delete Modal -->
    <div class="modal fade" id="{{isset($deleteKey) && $deleteKey ? $deleteKey : ''}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 10000000000;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Operation! </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- body --}}
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
                                <div class="card border-0 shadow rounded-3 my-0">
                                    <div class="card-body p-2 p-sm-3 m-1">
                                        <div align="center" class="logo pb-1">
                                            <div align="center" class="text-danger"><span class="fa fa-trash fa-2x"></span></div>
                                            <h6 class="card-title text-center text-danger mb-3 fw-bolder fs-5">{{isset($deleteMessage) && $deleteMessage ? $deleteMessage : 'Are you sure you want to delete this record?'}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end body --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if(isset($parameter) && $parameter)
                        <a href="{{isset($deleteRoute) && $deleteRoute ? Route::has($deleteRoute) ? Route($deleteRoute, ['id'=>$parameter]) : 'javascript:;' : 'javascript:;'}}" class="btn btn-danger">Delete</a>
                    @else
                        <a href="{{isset($deleteRoute) && $deleteRoute ? Route::has($deleteRoute) ? Route($deleteRoute) : 'javascript:;' : 'javascript:;'}}" class="btn btn-danger">Delete</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
<!--end Delete Modal-->

