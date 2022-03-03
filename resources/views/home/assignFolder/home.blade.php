@extends('share.dashboardLayout')
@section("taskTitle", "Assign Folder")
@section("taskAssignFolderActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}
                    <form action="{{ route('saveAssignFolder') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="p-2">Folder' Name:</div>
                                <select name="folderName" class="form-control form-control-sm" required>
                                    <option value="" selected>Select</option>
                                    @if(isset($allFolders) && $allFolders)
                                        @foreach ($allFolders as $keyF=>$folder)
                                            <option value="{{$folder->folderID}}">{{$folder->folder_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('folderName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="p-2">User' Name:</div>
                                <select name="userName" class="form-control form-control-sm" required>
                                    <option value="" selected>Select</option>
                                    @if(isset($allUsers) && $allUsers)
                                        @foreach ($allUsers as $keyU=>$user)
                                            <option value="{{$user->id}}">{{$user->first_name .' '. $user->last_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('userName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div align="center" class="col-md-12">
                                <button type="submit" class="btn-lg btn btn-success p-1 m-3 fs-6">Submit</button>
                            </div>
                        </div>

                    </form>

                <div class="table-responsive pt-3 pb-3">
                    <hr />
                    <div class="text-center text-success text-uppercase bg-gray p-2">
                        <strong>List of All Folder Created</strong>
                    </div>
                    <table class="table table-hover table-responsive table-condensed">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>User's Name</th>
                                <th>Folder's Name</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($assignFolders) && $assignFolders)
                                @foreach ($assignFolders as $key=>$assignF)
                                    <tr>
                                        <td>{{ ($key + 1) }}</td>
                                        <td>{{ $assignF->first_name . ' '. $assignF->last_name }}</td>
                                        <td><span class="fa fa-folder"></span> {{ $assignF->folder_name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($assignF->created_at)) }}</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-danger" title="Delete product" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal{{$key}}"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>
                                    @includeIf('share.deleteConfirmationPopupModal',['deleteKey'=>'deleteConfirmModal'.$key, 'deleteMessage'=>'Your record will be deleted!', 'deleteRoute'=>'deleteAssignFolder', 'parameter'=>$assignF->assign_folderID])
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                {{-- code ends here --}}
            </div>
        </div>
    </div>
</div>

@endsection
