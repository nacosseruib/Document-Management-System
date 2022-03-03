@extends('layouts.guest')
@section("pageTitle")
    @yield('taskTitle', 'Current Task')
@endsection
@section("currentPageIndex", "active")
@section('closeAllCategoty', null)
@section('pageContent')

<div class="brand-area dotted-style-2 bg-grey pr-10" style="margin-top: 100px;">
    <div class="container border border-gray white-bg ptb-7 shadow-sm bg-body">

        <div class="row">
            <div class="col-md-12">

                <div class="d-flex" id="wrapper">
                    <!-- Sidebar-->
                    <div class="border-end bg-white" id="sidebar-wrapper">
                        <div class="sidebar-heading border-bottom bg-light">
                            <div class="row">
                                <div class="col-md-12" align="center">
                                    {{-- Title --}}
                                    <div>
                                        <h6  class="text-brown"></span><strong>
                                            {{ (isset($dashboardName) ? strtoupper($dashboardName) : 'DASHBOARD') }} </strong></h6>
                                        <hr />
                                    </div>
                                    {{-- Profile Image --}}
                                    <img class="rounded-circle" style="width:90px;height:90px" alt="Avatar" src="{{isset($userAvatar) ? $userAvatar : ''}}" data-holder-rendered="true">
                                    <br />
                                    @if(Auth::check())
                                       <div class="text-brown" style="font-size: 12px;"> {{ Auth::user()->first_name .' '. Auth::user()->last_name}}</div>
                                    @else
                                        User's Name
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="list-group list-group-flush">

                            @if(Auth::check())
                                @php
                                    //dd(Session::get('userMenuModule'));
                                @endphp

                                @if(Session::get('userMenuModule'))
                                    @foreach(Session::get('userMenuModule') as $key=>$module)
                                        <div class="pt-2">
                                            <div class="bg-grey text-uppercase p-1">
                                                <span class="{{ $module->module_icon }}"></span> {{ $module->module_name }}
                                            </div>
                                        </div>
                                        @foreach(Session::get('userMenu')[$key.$module->moduleID] as $subModule)
                                            <a href="{{Route::has($subModule->submodule_url) ? Route($subModule->submodule_url) : 'javascript:;' }}" class="text-brown list-group-item list-group-item-action list-group-item-light p-2 @yield((isset($subModule) && $subModule ? $subModule->submodule_active_page : ''))">
                                                <i class="{{ $subModule->submodule_icon }}"></i> {{ (isset($subModule) && $subModule ? $subModule->submodule_name : '') }}
                                            </a>
                                        @endforeach
                                    @endforeach
                                @endif
                                @if(Auth::user()->user_role == 1)
                                    <div class="pt-3">
                                        <span class="text-uppercase">Super Admin Menu</span>
                                        <hr />
                                    </div>
                                    <a href="{{Route::has('createRole') ? Route('createRole') : 'javascript:;' }}" class="text-brown list-group-item list-group-item-action list-group-item-light p-2 @yield('taskRoleActive')">
                                        <span class="fa fa-gear"></span> Create Role
                                    </a>
                                    <a href="{{Route::has('createModule') ? Route('createModule') : 'javascript:;' }}" class="text-brown list-group-item list-group-item-action list-group-item-light p-2 @yield('taskCreateModuleActive')">
                                        <span class="fa fa-gear"></span> Create Module
                                    </a>
                                    <a href="{{Route::has('createSubModule') ? Route('createSubModule') : 'javascript:;' }}" class="text-brown list-group-item list-group-item-action list-group-item-light p-2 @yield('tasksubModulePageActive')">
                                        <span class="fa fa-gear"></span> Create SubModule
                                    </a>
                                    <a href="{{Route::has('createSubmoduleAssignment') ? Route('createSubmoduleAssignment') : 'javascript:;' }}" class="text-brown list-group-item list-group-item-action list-group-item-light p-2 @yield('taskAssignRoleActive')">
                                        <span class="fa fa-gear"></span> Assign Role To Permission
                                    </a>
                                @endif
                            @endif

                            <a href="{{ Route::has('logout') ? Route('logout') : 'javascript:;' }}" class="text-brown list-group-item list-group-item-action list-group-item-light p-2" title="Logout from your account">
                                <span class="fa fa-sign-in"></span> Logout
                            </a>

                            <div class="list-group-item list-group-item-action list-group-item-light p-2 text-center text-success" href="#!">Last Logged in<br /> {{(Auth::check() ? date('d-m-Y h:i:sa', strtotime(Auth::user()->last_login)) : '')}}</div>

                        </div>
                    </div>
                    <!-- Page content wrapper-->
                    <div id="page-content-wrapper" class="pr-20">
                        <!-- Top navigation-->
                        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                            <div class="container-fluid">
                                <button class="btn btn-default" id="sidebarToggle" title="Toggle Menu"><span class="fa fa-bars fa-2x"></span></button>
                                {{-- <div class="pr-50"><h6> <span class="fa fa-user"></span><strong>  </strong></h6></div> --}}
                            </div>
                        </nav>
                        <!-- Page Title and content-->
                        <div class="container-fluid">
                            <h5 class="text-brown mt-4 text-uppercase"><b>@yield('taskTitle', 'Current Task')</b></h5>
                            <hr >
                            @if(isset($viewPageDetails) && $viewPageDetails)
                                @yield('yieldPageContent')
                            @else
                                <div class="row">
                                    <div class="col-md-12 p-2">
                                        <div class="text-decoration-none">
                                            <div class="card p-3 shadow bg-warning text-center border-0">
                                                <div class="card-body">
                                                    <i class="fa fa-clock-o fa-2x text-white" aria-hidden="true"> Check Back After: <span id="timer"></span> </i>
                                                    <hr />
                                                    <p class="card-title lead text-danger fs-17 fw-bolder">
                                                        Down for maintenance. We apologise for any inconveniences.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <br /><br />
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


@endsection

@section('style')

    <style>
        :root {
        --primary: #94618e;
        }

        .justify {
        text-align: justify;
        }

        .text-purple {
        color: var(--primary);
        }

        .bg-purple {
        background-color: var(--primary);
        color: white;
        }
    </style>
    <!--Text Editor-->
    <!-- suneditor -->
    <link href="{{asset('assets/texteditor/css/suneditor.min.css')}}" rel="stylesheet">
    <!-- codeMirror -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.css">
    <!-- KaTeX -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css">
@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        // #code for dashboard Chart
        var xValues = ["Users", "Sellers", "Buyers", "Suspended", "Products", "Orders", "Dearlership", "Messages", "Contact", "Trafic"];
        var yValues = [55, 49, 44, 24, 15, 5, 9, 4, 24, 7];
        var barColors = ["green", "blue","orange","red","purple", "green", "yellow", "green", "grey", "black"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                  backgroundColor: barColors,
                  data: yValues
                }]
            },
            options: {
                legend: {display: false},
                title: {
                  display: true,
                  text: "System Statistics"
                }
            }
        });
        //ends here
    </script>

    {{-- Reload Page content/upload --}}
    <script>
		$(document).ready(function(){
            $("#getPageName").change(function() {
                $('#pageName').val($('#getPageName').val());
                $('#getPageContentForm').submit();
            });
        });
	</script>

    <!--Text Editor-->
    <script src="{{asset('assets/texteditor/common.js')}}"></script>
    <!-- suneditor -->
    <script src="{{asset('assets/texteditor/suneditor.min.js')}}"></script>
    <!-- codeMirror -->
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/htmlmixed/htmlmixed.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/xml/xml.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/css/css.js"></script>
    <!-- KaTeX -->
    <script src="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js"></script>
    <script>
        var txtEditor = SUNEDITOR.create((document.getElementById('txtEditor')), {
            display: 'block',
            width: '100%',
            height: '400', //auto
            popupDisplay: 'full',
            charCounter: true,
            charCounterLabel: 'Characters :',
            imageGalleryUrl: 'https://etyswjpn79.execute-api.ap-northeast-1.amazonaws.com/suneditor-demo',
            buttonList: [
                // default
                ['undo', 'redo'],
                ['font', 'fontSize', 'formatBlock'],
                ['paragraphStyle', 'blockquote'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                ['fontColor', 'hiliteColor', 'textStyle'],
                ['removeFormat'],
                ['outdent', 'indent'],
                ['align', 'horizontalRule', 'list', 'lineHeight'],
                ['table', 'link', 'image', 'video', 'audio', 'math'],
                ['imageGallery'],
                ['fullScreen', 'showBlocks', 'codeView'],
                ['preview', 'print'],
                ['save', 'template'],
                // (min-width: 1546)
                ['%1546', [
                    ['undo', 'redo'],
                    ['font', 'fontSize', 'formatBlock'],
                    ['paragraphStyle', 'blockquote'],
                    ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                    ['fontColor', 'hiliteColor', 'textStyle'],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    ['table', 'link', 'image', 'video', 'audio', 'math'],
                    ['imageGallery'],
                    ['fullScreen', 'showBlocks', 'codeView'],
                    ['-right', ':i-More Misc-default.more_vertical', 'preview', 'print', 'save', 'template']
                ]],
                // (min-width: 1455)
                ['%1455', [
                    ['undo', 'redo'],
                    ['font', 'fontSize', 'formatBlock'],
                    ['paragraphStyle', 'blockquote'],
                    ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                    ['fontColor', 'hiliteColor', 'textStyle'],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    ['table', 'link', 'image', 'video', 'audio', 'math'],
                    ['imageGallery'],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save', 'template']
                ]],
                // (min-width: 1326)
                ['%1326', [
                    ['undo', 'redo'],
                    ['font', 'fontSize', 'formatBlock'],
                    ['paragraphStyle', 'blockquote'],
                    ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                    ['fontColor', 'hiliteColor', 'textStyle'],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save', 'template'],
                    ['-right', ':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery']
                ]],
                // (min-width: 1123)
                ['%1123', [
                    ['undo', 'redo'],
                    [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
                    ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                    ['fontColor', 'hiliteColor', 'textStyle'],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save', 'template'],
                    ['-right', ':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery']
                ]],
                // (min-width: 817)
                ['%817', [
                    ['undo', 'redo'],
                    [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
                    ['bold', 'underline', 'italic', 'strike'],
                    [':t-More Text-default.more_text', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'textStyle'],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save', 'template'],
                    ['-right', ':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery']
                ]],
                // (min-width: 673)
                ['%673', [
                    ['undo', 'redo'],
                    [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
                    [':t-More Text-default.more_text', 'bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'textStyle'],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    [':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery'],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save', 'template']
                ]],
                // (min-width: 525)
                ['%525', [
                    ['undo', 'redo'],
                    [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
                    [':t-More Text-default.more_text', 'bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'textStyle'],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    [':e-More Line-default.more_horizontal', 'align', 'horizontalRule', 'list', 'lineHeight'],
                    [':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery'],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save', 'template']
                ]],
                // (min-width: 420)
                ['%420', [
                    ['undo', 'redo'],
                    [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
                    [':t-More Text-default.more_text', 'bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'textStyle', 'removeFormat'],
                    [':e-More Line-default.more_horizontal', 'outdent', 'indent', 'align', 'horizontalRule', 'list', 'lineHeight'],
                    [':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery'],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save', 'template']
                ]]
            ],
            placeholder: 'Start typing something...',
            templates: [
                {
                    name: 'Template-1',
                    html: '<p>HTML source1</p>'
                },
                {
                    name: 'Template-2',
                    html: '<p>HTML source2</p>'
                }
            ],
            codeMirror: CodeMirror,
            katex: katex
        });
        $(window).click(function() {
            document.getElementById('txtEditor').value = txtEditor.getContents();
        });

        SUNEDITOR.create('editor_inline1', {
            mode: 'inline',
            display: 'block',
            width: '100%',
            height: '162',
            popupDisplay: 'full',
            buttonList: [
                ['bold', 'underline', 'align', 'horizontalRule', 'list', 'table', 'codeView']
            ],
            placeholder: 'Start typing something...'
        });
        SUNEDITOR.create('editor_inline2', {
            mode: 'inline',
            display: 'block',
            width: '100%',
            height: '204',
            popupDisplay: 'full',
            buttonList: [
                ['font', 'fontSize', 'formatBlock'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                ['codeView']
            ],
            placeholder: 'Start typing something...'
        });
        SUNEDITOR.create('editor_inline3', {
            mode: 'inline',
            display: 'block',
            width: '100%',
            height: 'auto',
            popupDisplay: 'full',
            buttonList: [
                ['link', 'image', 'video']
            ],
            placeholder: 'Start typing something...'
        });

        SUNEDITOR.create('editor_balloon', {
            mode: 'balloon',
            display: 'block',
            width: '100%',
            height: 'auto',
            popupDisplay: 'full',
            buttonList: [
                ['fontSize', 'fontColor', 'bold', 'underline', 'align', 'horizontalRule', 'table', 'codeView']
            ],
            placeholder: 'Start typing something...'
        });

        SUNEDITOR.create('editor_balloon_always', {
            mode: 'balloon-always',
            display: 'block',
            width: '100%',
            height: 'auto',
            popupDisplay: 'full',
            buttonList: [
                ['bold', 'italic', 'link', 'undo', 'redo']
            ],
            placeholder: 'Start typing something...'
        });


        function openTab(evt, tabName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
@endsection
