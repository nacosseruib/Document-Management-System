
@extends('share.dashboardLayout')
@section("taskTitle", "Create Role")
@section("taskRoleActive", "page-active-dasboard")
@section('yieldPageContent')

<div class="brand-area dotted-style-2 bg-grey">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @includeIf('share.operationCallBackAlert', ['showAlert'=>1])
                {{-- code start --}}
                    <form  id="submitModuleForm" class="form d-print-none" method="post" action="{{route('saveRole')}}">
                        @csrf
                                    <div class="row form-group">
                                        <div class="col-md-6">
                                            <label> Role Name <span class="text-danger"><b>*</b></span> </label>
                                            <input type="text" class="form-control" autofocus required name="roleName" id="roleName" value="{{ ((isset($editRole)) ? $editRole->role_name : old('roleName')) }}" placeholder="Role Name">
                                            @if ($errors->has('roleName'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('roleName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <label> Role Status <span class="text-danger"><b>*</b></span> </label>
                                            <select class="form-control" required name="roleStatus" id="roleStatus">
                                                <option value="{{ ((isset($editRole)) ? $editRole->role_active : '') }}"> {{ ((isset($editRole)) ? ($editRole->role_active ? 'Enabled' : 'Disabled') : 'Select') }} </option>
                                                <option value="1" {{ (1 == old('roleStatus')) ? 'Selected' : '' }}>Enable</option>
                                                <option value="0" {{ (0 and null <> old('roleStatus')) ? 'Selected' : '' }}>Disable</option>
                                            </select>
                                            @if ($errors->has('roleStatus'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('roleStatus') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <input type="hidden" value="0" name="roleUnit" id="roleUnit" />
                                </div><!--//row-->

                                    <div >
                                            <div class="p-3">
                                                <div align="center" class="buttons-group">
                                                    <input type="hidden" name="editRoleID" value="{{ ((isset($editRole)) ? $editRole->roleID : '') }}" />
                                                    @if(isset($editRole))
                                                    <a href="{{ route('cancelEditRole') }}"  class="btn btn-sm btn-warning">
                                                        <i class="fa fa-edit"></i> Cancel Edit
                                                    </a>
                                                    @endif
                                                    <button  id="checkFields" type="submit" type="hidden" data-toggle="modal" data-backdrop="false" data-target="#confirmNewRole" class="btn btn-sm btn-success">
                                                        <i class="fa fa-check-square-o"></i> Submit
                                                    </button>
                                                </div>
                                            </div>
                                            <hr />
                                    </div>


                        <div class="row">
                                <div align="center" class="col-md-12">
                                    <table class="table table-hover table-stripped">
                                        <thead>
                                            <tr style="background:#d9d9d9">
                                                <th>{{ __('S/N') }}</th>
                                                <th>{{ __('Role Name') }}</th>
                                                <th>{{ __('Unit Type') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Last Updated') }}</th>
                                                <th class="d-print-none" colspan="2"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($allRole as $key=>$list)
                                            <tr>
                                                <th>{{ 1+$key ++ }}</th>
                                                <th class="text-left">{{ __($list->role_name) }}</th>
                                                <th>{{ __($list->is_unit) }}</th>
                                                <th>
                                                    {!! __(($list->role_active) ? '<span class="text-success"><small>Enabled</small></span>' : '<span class="text-warning"><small>Disabled</small></span>' ) !!}
                                                </th>
                                                <th>{{ __($list->updated_at) }}</th>
                                                <th class="d-print-none">
                                                    <a href="{{ url('/edit-role/' . $list->roleID) }}"><i class="fa fa-edit"></i></a>
                                                </th>
                                                <th class="d-print-none">
                                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#deleteRole{{$key}}"><i class="fa fa-trash"></i></a>
                                                </th>
                                            </tr>

                                                <!-- Delete Modal -->
                                                    <div class="modal fade text-left d-print-none" id="deleteRole{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger white">
                                                                <h6 class="modal-title text-white" id="myModalLabel12"><i class="fa fa-trash"></i> {{ __('Delete Role')}}  </h6>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="text-center">  {{ __('Delete Role') }} ! </div>
                                                                    <h5>{{ __('Are you sure you want to delete this record?')}} </h5>
                                                                <p>
                                                                    <div class="text-danger text-center"> {{ __('You will not be able to recover this record again !')}} </div>
                                                                </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn grey btn-outline-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                                    <a href="{{ route('removeRole', [$list->roleID])}}" class="btn btn-outline-danger">{{ __('Delete') }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!--end Modal-->

                                            @empty
                                                <tr><td colspan="6" class="text-danger">{{ __('No record found!') }}</td></tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <!--Confirm operation  Modal -->
                                <div class="modal fade text-left d-print-none" id="confirmNewRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success white">
                                            <h4 class="modal-title" id="myModalLabel12"><i class="fa fa-tree"></i> {{ __('Add/Update Role')}}  </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <h5 class="text-primary"><i class="fa fa-arrow-right"></i> {{ __('You are about adding new Role')}} </h5>
                                            <p class="text-center text-warning">
                                                {{ __('Are you sure you want to continue with this operation ?')}}
                                            </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn grey btn-outline-primary" data-dismiss="modal">Edit/Cancel</button>
                                                <button type="submit" id="submitForm" class="btn btn-outline-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end Modal-->
                            </div><!--end content-wrapper-->
                        </div><!--end main content-->
                    </form>
                {{-- code ends here --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        //check role name
        $("#checkFields").click(function() {
            if(($("#roleName").val()) == ''){
                alert('You have to enter role name !');
                $("#roleName").focus();
                return false;
            }
            //check role status
            if($("#roleStatus").val() == ''){
                alert('You have to select role status !');
                $("#roleStatus").focus();
                return false;
            }
        });

        $("#submitForm").click(function() {
            $('#submitModuleForm').submit();
        });
    });//end document
</script>
@endsection
