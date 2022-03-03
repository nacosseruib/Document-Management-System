<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <title>@yield('pageTitle', 'Welcome To EsgCars')</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="document management system">
        <meta name="keywords" content="doc, document, system doc system, management system,doc management system">
        <meta name="author" content="Samson Ajax">

        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="{{asset('assets/images/logo/logo.png')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/meanmenu.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/animate.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/shortcode/shortcodes.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/nivo-slider.css')}}" />

		<link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/drawer/css/styles.css')}}" rel="stylesheet" />
        <style>
            .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
            }
            .btn-google {
            color: white !important;
            background-color: rgb(165, 42, 42);
            }
            .btn-facebook {
            color: white !important;
            background-color: #3b5998;
            }
            .page-active-dasboard{
                background: #F4A137 !important;
                font-size: 14px !important;
                font-weight: 500 !important;
            }
            .text-yellow{
                color: green !important;
            }
            .bg-yellow{
                background: green !important;
            }
            .bg-grey, .bg-gray{
                background: #f9f9f9 !important;
            }
            .text-brown{
                color: green !important;
            }
            .bg-brown{
                background: green !important;
            }
            .bg-blue{
                background: grey !important;
            }
            .text-blue{
                color: #0F0A5E!important;
            }
        </style>

            <style>
                /* Global */
            * {
            box-sizing: border-box;
            }

            /* main, section {
            width: 100%;
            }

            section {
            padding: 3%;
            } */

            /* Headbutting/padding issue: this code doesn't work  */
            /* section::before {
            display: block;
            content: " ";
            margin-top: -5.5rem;
            height: 5.5rem;
            visibility: hidden;
            pointer-events: none;
            } */

            /* This doesn't help either but I added in because it makes the CTA section look better on my phone! */
            /* main {
            margin-top: 5.5rem;
            } */

            /* img {
            vertical-align: middle;
            }

            hr {
            border-color: #4E5254;
            width: 10rem;
            }

            h1, h2 {
            text-transform: uppercase;
            }

            h1, h2, h3 {
            text-align: center;
            }

            h1 { font-size: 2.8rem; }
            h2 { font-size: 2.5rem; }
            h3 { font-size: 2.2rem; }
            a { font-size: 1.5rem; }
            p, li { font-size: 1.9rem; }
            cite { font-size: 1.7rem; }

            li, cite { font-weight: 500; }

            /* Header */
            .fas {
            color: #4E5254;
            padding-right: 1rem;
            }

            .fa-times {
            padding-top: 1rem;
            } */

            #header-img {
            padding: 0.5rem;
            }

            .logo-text {
            font-size: 1.5rem;
            vertical-align: middle;
            color: #4E5254;
            text-transform: uppercase;
            }

            #header {
            position: fixed;
            height: 5.5rem;
            top: 0;
            left: 0;
            right: 0;
            background-color: #EAE2DF;
            }

            .logo-toggle-flex {
            display: flex;
            justify-content: space-between;
            }

            .nav-bar-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            position: absolute;
            right: -300px;
            top: 0;
            height: 100%;
            overflow-y: scroll;
            overflow-x: visible;
            transition: left 0.3s ease,
                    box-shadow 0.3s ease;
            z-index: 999;
            }

            .menu-toggle {
            align-self: center;
            }

            .nav-bar-wrapper ul {
            margin: 0;
            padding: 1.5rem 0 0;
            min-height: 100%;
            width: 20rem;
            background: #E79744;
            }

            .menu-wrapper li {
            border-bottom: 1px solid rgba(255,255,255,.5);
            padding: 0.5rem;
            }

            .menu-wrapper a {
            color: white;
            border: none;
            }

            .menu-close {
            position: absolute;
            right: 0;
            top: 0;
            }

            .nav-bar-wrapper:target {
            right: 0;
            }

            .nav-bar-wrapper:target .menu-close {
            z-index: 1001;
            }

            .nav-bar-wrapper:target ul {
            position: relative;
            z-index: 1000;
            }

            .nav-bar-wrapper:target + .backdrop {
            position: absolute;
            display: block;
            content: "";
            right: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 998;
            background: rgba(0,0,0,.5);
            cursor: default;
            }

            @supports (position: fixed) {
            .nav-bar-wrapper,
            .nav-bar-wrapper:target + .backdrop {
            position: fixed;
            }
            }

            /* CTA */
            .cta-img {
            background: url(https://res.cloudinary.com/sharonnt/image/upload/v1535301352/hero-1920.jpg) 0 0 / cover no-repeat;
            display: flex;
            flex-direction: column;
            height: 100vh;
            justify-content: center;
            width: 100%;
            }

            .cta-banner {
            align-self: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 90%;
            }

            .cta-wrapper {
            align-items: center;
            align-self: center;
            display: flex;
            flex-direction: column;
            }

            .cta-wrapper h1,
            .cta-wrapper h2 {
            padding: 1%;
            width: 100%;
            }

            .cta-wrapper h1 {
            color: #E79744;
            margin-bottom: 5%;
            }

            .cta-wrapper h2 {
            color: #F2F2F2;
            font-size: 1.8rem;
            margin-bottom: 5%;
            text-transform: none;
            }

            .cta-wrapper a {
            align-self: center;
            background-color: #E79744;
            border-radius: 3rem;
            color: #F2F2F2;
            font-size: 1.8rem;
            padding: 2rem 1.5rem;
            text-align: center;
            width: 20rem;
            }

            /* Products */
            .products {
            background-color: #808080;
            }

            .products h2 {
            color: #F2F2F2;
            margin: 10%;
            }

            .products-wrap {
            display: flex;
            flex-direction: column;
            margin: 3% auto;
            width: 80%;
            }

            .product-item {
            align-items: center;
            display: flex;
            flex-direction: column;
            padding: 2%;
            }

            .product-item img {
            margin: 1%;
            }

            .product-description {
            align-self: stretch;
            margin: 1%;
            padding: 1%;
            text-align: center;
            }

            .product-item a {
            border: 1px solid #F2F2F2;
            border-radius: 3rem;
            color: #F2F2F2;
            margin: 2% auto 15%;
            padding: 1.3rem 0.7rem;
            text-align: center;
            width: 11rem;
            }

            /* Clients-video */
            .project-bridge h2 {
            margin: 10%;
            }

            .clients-video {
            align-items: center;
            background-color: white;
            display: flex;
            flex-direction: column;
            }

            .client-logo-wrapper {
            align-items: flex-start;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            }

            .client-logo-wrapper img {
            margin: 2%;
            }

            .video-wrapper {
            display: flex;
            justify-content: center;
            }

            iframe {
            margin-bottom: 10%;
            max-width: 560px;
            width: 100%;
            }

            .customers {
            margin-bottom: 10%;
            }

            .quote-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            }

            blockquote {
            margin: 3rem 3rem 2rem;
            padding: 0;
            }

            blockquote p {
            font-style: italic;
            margin-bottom: 1rem;
            }

            blockquote p:first-child:before {
            color: rgba(0,0,0,.3);
            content: '\201C';
            font-size: 112px;
            line-height: 0;
            vertical-align: bottom;
            }

            cite {
            align-self: flex-end;
            margin: 0 30px 10% 0;
            text-align: right;
            }

            /* About */
            .about {
            background-color: #4E5254;
            display: flex;
            flex-direction: column;
            text-align: center;
            }

            .about-text {
            align-self: center;
            display: flex;
            flex-direction: column;
            width: 90%;
            }

            .about-text h2 {
            color: #E79744;
            margin: 10%;
            text-align: center;
            }

            .about-wrapper {
            align-self: center;
            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            width: 100%;
            }

            .about-wrapper > img {
            align-self: center;
            margin-bottom: 2rem;
            max-width: 92rem;
            width: 100%;
            }

            .p-text {
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            margin-bottom: 10%;
            }

            .p-text p {
            align-self: center;
            color: #F2F2F2;
            padding-bottom: 2%;
            text-align: left;
            width: 100%;
            }

            .acc-logo {
            align-items: flex-start;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-bottom: 10%;
            }

            .acc-logo img {
            margin: 2%;
            max-width: 35%;
            }

            .acc-logo img:last-child {
            max-width: 75%;
            }

            /* Contact */
            .contact {
            background-color: #807060;
            }

            .contact-wrapper {
            display: flex;
            flex-direction: column;
            margin: 10% auto;
            width: 90%;
            }

            .contact-wrapper h2 {
            color: #F2F2F2;
            }

            .form-wrapper p {
            margin: 3% 3% 3% 0;
            }

            .form-wrapper h2,
            .contact-details h2 {
            text-align: left;
            }

            #form {
            align-items: center;
            display: flex;
            flex-direction: column;
            }

            input {
            border: 0;
            border-radius: 2px;
            padding: 1.5rem;
            width: 100%;
            }

            textarea {
            border: none;
            border-radius: 2px;
            padding: 1.5rem;
            width: 100%;
            }

            .visuallyhidden {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
            }

            .enquiry {
            background-color: #807060;
            border: 1px solid #F2F2F2;
            border-radius: 3rem;
            color: #F2F2F2;
            font-weight: 500;
            font-size: 1.5rem;
            margin: 3%;
            padding: 1.3rem 0.7rem;
            text-align: center;
            width: 11rem;
            }

            .privacy {
            margin: 8% 0;
            }

            .privacy p {
            font-size: 1.5rem;
            font-weight: 500;
            }

            .contact-details {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 430px;
            }

            .contact-details h3 {
            font-size: 1.9rem;
            font-weight: 700;
            text-align: left;
            }

            .contact-details p {
            font-size: 1.7rem;
            font-weight: 500;
            text-align: left;
            }

            #footer {
            background-color: #4E5254;
            color: #F2F2F2;
            font-size: 1.2rem;
            padding: 1.5rem;
            text-align: center;
            }

            @media (min-width: 460px) {
            .product-item {
            flex: 1 0 50%;
            }
            .product-description {
            align-self: stretch;
            flex: 1;
            }
            .products-wrap {
            flex-flow: row wrap;
            width: 100%;
            justify-content: center;
            }
            }

            @media (min-width: 550px) {
            .cta-wrapper h2 {
            font-size: 2rem;
            }
            .customers h3 {
            margin-bottom: 2%;
            }
            .client-logo-wrapper {
            flex-wrap: nowrap;
            }
            .client-logo-wrapper img {
            margin: 1%;
            width: 120px;
            }
            .quote-wrapper {
            max-width: 570px;
            }
            .p-text {
            margin-bottom: 5%;
            }
            .privacy {
            margin: 4% 0 8%;
            }
            .contact-details p {
            font-size: 1.9rem;
            }
            }

            @media (min-width: 768px) {
            .contact-wrapper {
            flex-flow: row wrap;
            justify-content: space-between;
            }
            .contact-wrapper div:nth-child(2) {
            order: 3;
            }
            .contact-wrapper > div {
            width: 45%;
            }
            .client-logo-wrapper img {
            width: 150px;
            }
            }

            @media (min-width: 820px) {
            .products-wrap {
            width: 90%;
            }
            .product-item {
            padding: 2.5%;
            }
            .product-item img {
            width: 120px;
            }
            .project-bridge {
            display: flex;
            flex-direction: column;
            }
            .clients-video {
            display: flex;
            flex-flow: row wrap;
            justify-content: space-evenly;
            }
            .clients-video :nth-child(2) {
            order: 3;
            }
            .client-logo-wrapper {
            margin-bottom: 5%;
            }
            }

            @media (min-width: 920px) {
            /*  remove toggle and display menu  */
            .menu-toggle,
            .menu-close {
            display: none;
            }
            .nav-bar-wrapper {
            display: inline-flex;
            position: relative;
            right: auto;
            top: auto;
            height: auto;
            overflow: initial;
            }
            .menu-wrapper {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            }
            .nav-bar-wrapper ul {
            display: flex;
            padding: 0;
            box-shadow: none;
            height: auto;
            width: auto;
            background: none;
            }
            #header {
            display: flex;
            }
            .logo-toggle-flex {
            margin-right: auto;
            }
            .menu-wrapper li {
            align-self: center;
            border: none;
            }
            .menu-wrapper a {
            color: #4E5254;
            font-weight: 700;
            }
            /*  section styles  */
            .cta-wrapper {
            width: 80%;
            }
            .cta-wrapper h1 {
            font-size: 3rem;
            }
            .cta-wrapper h2 {
            font-size: 2.3rem;
            }
            .products h2 {
            margin: 5%;
            }
            .customers {
            margin-bottom: 5%;
            }
            .about-wrapper {
            flex-flow: row wrap;
            justify-content: space-around;
            }
            .about-wrapper > img {
            width: 50%;
            align-self: flex-start;
            }
            .p-text {
            width: 45%;
            }
            .acc-logo img {
            max-width: 150px;
            }
            }

            @media (min-width: 1020px) {
            .products h2,
            .about-text h2 {
            margin: 5%;
            }
            .products-wrap {
            margin-bottom: 5%;
            }
            .product-item {
            flex: 0 auto;
            padding: 2%;
            }
            .product-item img {
            width: 140px;
            }
            .product-item a {
            margin-bottom: 0;
            }
            }
            </style>
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
        @yield('style')

    </head>
    <body>
        {{-- Social Login and sign up Popup --}}
        @includeIf('share.socialLoginPopupModal', ['showPopup'=>1])
        @includeIf('share.socialRegisterPopupModal', ['showPopup'=>1])
        @includeIf('share.loginRegisterTypePopupModal', ['showPopup'=>1])

        <header id="header" class="" style="z-index: 100000000000000000000000000000;">
            <div class="logo-toggle-flex ">
                <div class="logo" style="margin-left: 80px;">
                    <div class="row">
						<div align="Center" class="col-md-4">
                            <a href="{{ Route::has('index') ? Route('index') : 'javascript:;' }}">
                                <img id="header-img" src="{{asset('assets/images/logo/logo.png')}}" alt="Logo" style="width:100px;"/>
                            </a>
                        </div>
                        <div align="center" class="col-md-8 fw-bolder fs-4">
                            <b>DOCUMENT MANAGEMENT SYSTEM</b>
                        </div>
                    </div>
                </div>
                <div class="m-4">
                    <a href="#nav-bar" id="menu-toggle" class="text-black menu-toggle">
                        <span class="fa fa-gear fa-2x"></span>
                    </a>
                </div>
            </div>
            <nav class="nav-bar-wrapper" id="nav-bar">
              <a href="#main-menu-toggle"
                 id="main-menu-close"
                 class="menu-close"><span class="fas fa-times fa-lg"></span>
              </a>
              <ul class="menu-wrapper" id="menu-wrapper">
                <li><a href="{{ Route::has('index') ? Route('index') : 'javascript:;' }}" class="nav-link">Home</a></li>
                <li><a href="{{Route::has('viewVisitorPage') ? Route('viewVisitorPage', ['pageRoute'=>'about-us']) : 'javascript:;' }}" class="nav-link">About</a></li>
                @if(Auth::check())
                    <li><a href="{{ Route::has('dashboard') ? Route('dashboard') : 'javascript:;' }}" class="nav-link">Dasboard</a></li>
                    <li><a href="{{ Route::has('logout') ? Route('logout') : 'javascript:;' }}" class="nav-link">Logout</a></li>
                @else
                    <li><a href="javascript:;" class="nav-link" data-bs-toggle="modal" data-bs-target="#chooseLoginRegisterTypeMethod">Login</a></li>
                    <li><a href="javascript:;" class="nav-link" data-bs-toggle="modal" data-bs-target="#chooseLoginRegisterTypeMethod">Register</a></li>
                @endif
                <li><a href="{{Route::has('contactUs') ? Route('contactUs') : 'javascript:;' }}" class="nav-link">Contact us</a></li>
              </ul>
            </nav>
            <a href="#main-menu-toggle"
               class="backdrop"></a>
        </header>


            @yield('pageContent')

		<footer>
			<div class="footer-top-area border-1 pb-30 bg-blue">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-6">
							<div class="footer-widget">
								<div class="footer-title">
									<h4>ABOUT US</h4>
								</div>
								<div class="list-unstyled">
									<ul>
                                        <li><a href="{{Route::has('index') ? Route('index') : 'javascript:;' }}">Home</a></li>
										<li><a href="{{Route::has('viewVisitorPage') ? Route('viewVisitorPage', ['pageRoute'=>'about-us']) : 'javascript:;' }}">About</a></li>
										<li><a href="{{Route::has('viewVisitorPage') ? Route('viewVisitorPage', ['pageRoute'=>'terms-and-conditions']) : 'javascript:;' }}">Terms and Conditions</a></li>

									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-6">
							<div class="footer-widget">
								<div class="footer-title">
									<h4>SUPPORT </h4>
								</div>
								<div class="list-unstyled">
									<ul>
										<li><a href="#">support@docsystem.com</a></li>
										<li><a href="{{Route::has('contactUs') ? Route('contactUs') : 'javascript:;' }}">Contact Us</a></li>
										<li><a href="{{Route::has('viewVisitorPage') ? Route('viewVisitorPage', ['pageRoute'=>'privacy-policy']) : 'javascript:;' }}">Privacy Policy</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-6">
							<div class="footer-widget">
								<div class="footer-title">
									<h4>CONNECT WITH US</h4>
								</div>
								<div class="list-unstyled">
									<ul>
										<li><a href="#">Twitter</a></li>
										<li><a href="#">Instagram</a></li>
										<li><a href="#">Youtube</a></li>
									</ul>
								</div>
							</div>
						</div>
						{{-- <div class="col-md-3 col-6">
							<div class="footer-widget">
								<div class="row">
                                    <div class="col-md-12 pb-2">
                                        <a href="javascript:;"><img src="{{asset('assets/images/app-store-apple.png')}}" alt="" width="150"/></a>
                                    </div>
                                    <div class="col-md-12">
                                        <a href="javascript:;"><img src="{{asset('assets/images/google-play-download.png')}}" alt="" width="150"/></a>
                                    </div>
								</div>
							</div>
						</div> --}}
					</div>
				</div>
			</div>
		</footer>


        <div class="copyright-area text-center bg-color-3">
            <div class="container">
                <div class="copyright-border ptb-10">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="copyright text-center text-md-center">
                                <p class="copyright">
                                    &copy; {{date('Y')}} <strong> docsystem. </strong>
                                    <strong>All rights resevered.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
        <script src="{{asset('assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('assets/js/ajax-mail.js')}}"></script>
        <script src="{{asset('assets/js/jquery.nivo.slider.pack.js')}}"></script>
        <script src="{{asset('assets/js/isotope.pkgd.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.meanmenu.js')}}"></script>
        <script src="{{asset('assets/js/jquery.scrollup.min.js')}}"></script>
        <script src="{{asset('assets/js/main.js')}}"></script>
        <script src="{{asset('assets/drawer/js/scripts.js')}}"></script>
        @includeIf('share.timerScriptForPageMaintenance')
        @includeIf('share.formatAmountEnter')
        {{-- ADD PRODUCT TO CART --}}
            @includeIf('share.jqueryFunctionAddFavourite', ['loadScript' => (isset($loadScript) ? $loadScript: 1)])
        {{--  END --}}

        @yield('script')

    </body>
</html>
