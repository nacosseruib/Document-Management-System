@extends('share.dashboardLayout')
@section("taskTitle", "My File")
@section("taskMyFileActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}
                <form action="{{ route('saveFolder') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <a href="{{Route::has('myFolder') ? Route('myFolder') : 'javascript:;'}}" title="Go Back" class="btn btn-sm btn-secondary">Back</a>
                    </div>
                    <hr />
                    <div class="row gx-1 gy-1">
                            @if(isset($myFiles) && $myFiles)
                                @foreach ($myFiles as $key=>$file)
                                <div class="col-md-3 col-3">
                                    <div class="text-center">
                                        <a href="" title="Click to open">
                                            <span class="fa fa-4x fa-file"></span>
                                            <div>{{$file->file_description}}</div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                    </div>

                {{-- code ends here --}}
            </div>
        </div>
    </div>
</div>

@endsection
