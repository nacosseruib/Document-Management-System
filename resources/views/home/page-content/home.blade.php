@extends('share.dashboardLayout')
@section("taskTitle", "Page Contents")
@section("taskPageContentActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}
                <form method="POST" action="{{ Route::has('savePageContent') ? Route('savePageContent') : '#' }}">
                    @csrf
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select id="getPageName" class="form-control @error('pageName') is-invalid @enderror" name="pageName" value="{{ old('pageName') }}" required>
                                        <option value=""> --------------Select------------- </option>
                                        @if(isset($pages) && $pages)
                                            @foreach ($pages as $page)
                                                <option value="{{$page->pageID}}" {{isset($pageID) && $pageID == $page->pageID ? 'selected' : old('pageName') }}>{{$page->page_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="pageName">Select Page<span class="text-danger">*</span></label>
                                    @error('pageName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-control @error('pageStatus') is-invalid @enderror" name="pageStatus" value="{{ old('pageStatus') }}" required>
                                        <option value=""> --------------Select------------- </option>
                                        <option value="0" {{isset($pageDetails) && $pageDetails && $pageDetails->page_status == 0 ? 'selected' : old('pageStatus') == 0  ? 'selected' : '' }}>Inactive</option>
                                        <option value="1" {{isset($pageDetails) && $pageDetails && $pageDetails->page_status == 1 ? 'selected' : old('pageStatus') == 1  ? 'selected' : '' }}>Active</option>
                                    </select>
                                    <label for="pageStatus">Page Status <span class="text-danger">*</span></label>
                                    @error('pageStatus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control @error('pageTitle') is-invalid @enderror" name="pageTitle" value="{{ isset($pageDetails) && $pageDetails && $pageDetails->title <> null ? $pageDetails->title : old('pageTitle') }}" required />
                                    <label for="pageTitle">Page Title <span class="text-danger">*</span></label>
                                    @error('pageTitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea name="pageContent" class="form-control p-2" id="txtEditor" style="display:none;">{{ ((isset($pageDetails) && $pageDetails) ? $pageDetails->content : old('pageContent')) }}</textarea>
                            </div>
                            <div class="col-md-12 p-3" align="right">
                                <button type="submit" id="gettext-00" class="btn btn-success p-1">Update Page Content</button>
                            </div>
                    </div>
                </form>

                {{-- code ends here --}}

            </div>
        </div>
    </div>
</div>

    <form id="getPageContentForm" method="post" action="{{ Route::has('getPageContentByID') ? Route('getPageContentByID') : '#' }}" enctype="multipart/form-data" >
    @csrf
        <input type="hidden" name="pageName" id="pageName" />
    </form>

@endsection
