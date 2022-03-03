@extends('share.dashboardLayout')
@section("taskTitle", "Update Advert")
@section("taskUploadProductActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}
                <form class="formFormatAmount" method="POST" action="{{ route('saveUploadProduct') }}" enctype="multipart/form-data">
                @csrf

                    @includeIf('share.uploadNewAdvertForm.aboutAd')
                    <hr />
                    @includeIf('share.uploadNewAdvertForm.detailsAd')
                    <hr />
                    @includeIf('share.uploadNewAdvertForm.pricingAd')
                    <hr />

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <select id="productStatus" class="form-control @error('productStatus') is-invalid @enderror" name="productStatus" required>
                                    <option value=""> --------------Select------------- </option>
                                    <option value="1" {{ isset($editRecord) && $editRecord && $editRecord->is_online == "1" ? 'selected' : old('productStatus') }}>Online</option>
                                    <option value="0" {{ isset($editRecord) && $editRecord && $editRecord->is_online == "0" ? 'selected' : old('productStatus') }}>Offline</option>
                                </select>
                                <label for="productStatus">Advert Status<span class="text-danger">*</span></label>
                                @error('productStatus')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <select id="sold" class="form-control @error('sold') is-invalid @enderror" name="sold" required>
                                    <option value=""> --------------Select------------- </option>
                                    <option value="1" {{ isset($editRecord) && $editRecord && $editRecord->sold == "1" ? 'selected' : old('sold') }}>Yes</option>
                                    <option value="0" {{ isset($editRecord) && $editRecord && $editRecord->sold == "0" ? 'selected' : old('sold') }}>No</option>
                                </select>
                                <label for="sold">Sold Out?<span class="text-danger">*</span></label>
                                @error('sold')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <div>Advert Details</div>
                                    <textarea name="productDetails" class="form-control p-2" id="txtEditor" style="display:none;">{{ ((isset($editRecord) && $editRecord) ? $editRecord->product_details : old('productDetails')) }}</textarea>
                                    @error('productDetails')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Photo --}}
                        @if(isset($productImage) && (count($productImage) <= 4))
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-12 mt-2 p-2">
                                    <label for="email">Add Photo: (Max: 5 IMGS | Type: png,jpg,jpe,jpeg,gif)<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="file" name="productImage" class="form-control form-control-sm"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($productImage) && $productImage)
                            @foreach($productImage as $imgKey=>$image)
                                <div class="col-md-3">
                                    <div class="m-1 p-2 bg-secondary">
                                        <a href="javascript:;" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal{{$imgKey}}"> <span class="fa fa-trash"></span> </a>
                                        <img class="img-responsive lazyload" src="{{ (isset($path) && $path) ? $path . $image->file_name : ''}}" alt=" "/>
                                    </div>
                                </div>
                                @includeIf('share.deleteConfirmationPopupModal',['deleteKey'=>'deleteConfirmModal'.$imgKey, 'deleteMessage'=>'Are you sure you want to delete this image?', 'deleteRoute'=>'deleteImageProduct', 'parameter'=>$image->product_imageID])
                            @endforeach
                        @endif
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-12">
                            <div align="center" class="form-floating mt-3">
                                @if(isset($editRecord) && $editRecord)
                                    <input type="hidden" name="editProductID" value="{{$editRecord->productID}}" />
                                    <a href="{{Route::has('cancelProductUpdate') ? Route('cancelProductUpdate') : 'javascript:;'}}" class="btn btn-secondary btn-sm text-white rounded fw-800 fs-18"><strong>Cancel Update</strong> </a>
                                    <button type="submit" class="btn btn-success btn-sm text-white rounded fw-800 fs-18"><strong>Update Advert</strong> </button>
                                @else
                                    <button type="submit" class="btn btn-success btn-sm text-white rounded fw-800 fs-18"><strong>Upload Advert</strong> </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr />

                </form>
                {{-- code ends here --}}

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{asset('assets/js/lga.min.js')}}"></script>
    <script src="{{asset('assets/js/selectCategoryBonuses.js')}}"></script>
    <script>

    </script>
@endsection
