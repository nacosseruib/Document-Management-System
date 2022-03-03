@extends('share.dashboardLayout')
@section("taskTitle", "Create Folder")
@section("taskCreateFolderActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}
                <form action="{{ route('saveFolder') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row p-2">
                        <div class="col-md-3 p-2">Folder' Name:</div>
                        <div class="col-md-6">
                            <input type="text" value="{{old('folderName')}}" name="folderName" placeholder="Folder Name" class="form-control form-control-sm @error('folderName') is-invalid @enderror" required autocomplete="folderName" autofocus>
                            @error('folderName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div align="center" class="form-floating mt-3">
                                <button type="reset" class="bg-warning text-white p-2 fs-14" style="border-radius: 60px;"><strong> &nbsp; Reset &nbsp; </strong> </button>
                                <button type="submit" class="bg-success text-white p-2 fs-14" style="border-radius: 60px;"><strong> &nbsp; Create &nbsp; </strong> </button>
                            </div>
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
                                <th>Folder's Name</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($allFolders) && $allFolders)
                                @foreach ($allFolders as $key=>$folder)
                                    <tr>
                                        <td>{{ ($key + 1) }}</td>
                                        <td><span class="fa fa-folder"></span> {{ $folder->folder_name }}</td>
                                        <td>{{ $folder->first_name }}</td>
                                        <td>{{ ($folder->folder_status ? 'Active' : 'Deactivated') }}</td>
                                        <td>{{ date('d-m-Y', strtotime($folder->created_at)) }}</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-danger" title="Delete Folder" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal{{$key}}"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>

                                    <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteConfirmModal{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 10000000000;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Delete Folder</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- body --}}
                                                        <div class="">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
                                                                    <div class="card border-0 shadow rounded-3 my-0">
                                                                        <div class="card-body">
                                                                            <div align="center">
                                                                                <div align="center" class="text-danger"><span class="fa fa-trash fa-2x"></span></div>
                                                                                <h6 class="card-title text-center text-danger fw-bolder">
                                                                                    Are you sure you want to delete this folder?
                                                                                </h6>
                                                                                <div class="text-center p-2 fw-bolder">
                                                                                    Note {{ $folder->folder_name }} will be deleted permanently.
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- end body --}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <a href="{{Route::has('deleteFolder') ? Route('deleteFolder', ['id'=>$folder->folderID]) : 'javascript:;'}}" class="btn btn-sm btn-danger">Delete</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!--end Delete Modal-->



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
