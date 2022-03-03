@extends('share.dashboardLayout')
@section("taskTitle", "List of Enquiries")
@section("taskContactUsActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}
                <div class="table-responsive">
                    <table class="table table-hover table-responsive table-condensed">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>EMAIL</th>
                                <th>MESSAGE</th>
                                <th>DATE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($getData) && $getData)
                                @foreach ($getData as $key=>$eachValue)
                                    <tr>
                                        <td>{{ ($getData->currentpage()-1) * $getData->perpage() + (1+$key) }}</td>
                                        <td>{{ $eachValue->first_name }}</td>
                                        <td>{{ $eachValue->last_name }}</td>
                                        <td>{{ $eachValue->email }}</td>
                                        <td>{{ substr($eachValue->message, 0, 20) }}...</td>
                                        <td>{{ date('d-m-Y', strtotime($eachValue->created_at)) }}</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-success" title="View Details" data-bs-toggle="modal" data-bs-target="#viewModal{{$key}}"><span class="fa fa-eye"></span></a>
                                            <a href="javascript:;" class="btn btn-danger" title="Delete Record" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal{{$key}}"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>
                                    @includeIf('share.deleteConfirmationPopupModal',['deleteKey'=>'deleteConfirmModal'.$key, 'deleteMessage'=>'Are you sure you want to delete the record?', 'deleteRoute'=>'deleteContactUs', 'parameter'=>$eachValue->contactusID])
                                    @includeIf('share.viewDetailsPopupModal',['viewModalKey'=>'viewModal'.$key, 'modalTitle'=>$eachValue->first_name, 'messageDetails'=> 'Email: '. $eachValue->email .'<br /><br /> Message: <hr />' .$eachValue->message])
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div align="right" class="col-md-12 m-1 p-1">
                            <hr />
                            @if(isset($getData))
                                Showing {{($getData->currentpage()-1)*$getData->perpage()+1}}
                                to {{$getData->currentpage()*$getData->perpage()}}
                                of  {{$getData->total()}} entries
                                <div class="hidden-print pull-left">{{ $getData->links() }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- code ends here --}}

            </div>
        </div>
    </div>
</div>

@endsection
