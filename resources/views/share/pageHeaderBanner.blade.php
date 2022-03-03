@if(isset($showHeaderBanner) && $showHeaderBanner == 1)


    <div class="header-bottom-area ptb-10 bg-blue">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 d-none d-md-block d-lg-block d-xl-block">
                    <div class="">
                        <img src="{{asset('assets/images/banner-top/ladies-suprise.png')}}" alt="" class="rounded mx-auto img-fluid" style="maxwidth:100%;height: 180px;" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pt-3 pb-3">
                    @includeIf('share.searchBar', ['showSearchBar'=>1])
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 d-none d-md-block d-lg-block d-xl-block">
                    <div class="pt-2">
                        <img src="{{asset('assets/images/banner-top/ESGcar.png')}}" alt="" class="rounded mx-auto img-fluid img-responsive" style="maxwidth:100%;height: 170px;" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-bottom-area-end -->

    <!-- header End-->



@endif
