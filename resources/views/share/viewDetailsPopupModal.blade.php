
    <!-- View Modal -->
    <div class="modal fade" id="{{isset($viewModalKey) && $viewModalKey ? $viewModalKey : 'ViewModalKey'}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 10000000000;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><span class="fa fa-eye"></span> {{ isset($modalTitle) && $modalTitle ? $modalTitle : 'View Details' }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- body --}}
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
                                <div class="card border-0 shadow rounded-3 my-0">
                                    <div class="card-body p-2 p-sm-3 m-1" style="overflow: auto; max-height: 300px;">
                                        <div class="logo pb-1">
                                            <h6 class="card-title text-justify text-dark mb-3 fw-200">{!!isset($messageDetails) && $messageDetails ? $messageDetails : '<span class="text-danger>No information to view !</span>'!!}</h6>
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
                </div>
            </div>
        </div>
    </div>
<!--end view Modal-->

