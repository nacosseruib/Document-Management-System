@extends('share.dashboardLayout')
@section("taskTitle", "Message")
@section("taskMessageActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}

                {{-- code ends here --}}

            </div>
        </div>
    </div>
</div>

@endsection
