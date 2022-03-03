@extends('share.dashboardLayout')
@section("taskTitle", "My Folder")
@section("taskMyFolderActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}
                <form action="{{ route('saveFolder') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row gx-1 gy-1">
                            @if(isset($myFolders) && $myFolders)
                                @foreach ($myFolders as $key=>$folder)
                                <div class="col-md-3 col-3">
                                    <div class="text-center">
                                        <a href="{{Route::has('myFile') ? Route('myFile', ['id'=>$folder->folderID]) : 'javascript:;' }}" title="Click to open {{$folder->folder_name}}">
                                            <span class="fa fa-4x fa-folder"></span>
                                            <div>{{$folder->folder_name}}</div>
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
