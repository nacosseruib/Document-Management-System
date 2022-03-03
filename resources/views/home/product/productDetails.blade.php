@extends('layouts.guest')
@section("pageTitle", "Product Details")
@section("currentPageProductDetails", "active")
@section('closeAllCategoty', null)
@section('pageContent')

   <!-- product-details-start -->
		<div class="product-details-area pt-20">
			<div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pb-2 fs-7">
                            <b><a href="{{route('index')}}">Home</a> / <a href="#">{{isset($productDetails) && $productDetails ? $productDetails->category_name : ''}}</a> / <a href="#">{{isset($productDetails) && $productDetails ? $productDetails->brand : ''}}</a> / {{isset($productDetails) && $productDetails ? $productDetails->product_name : ''}}</b>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-8">
                        <div class="shadow-sm p-2 mb-5 bg-body rounded">
						<div class="product-zoom dotted-style-1">
							<!-- Tab panes -->
							<div class="tab-content">
                                <div align="right" style="">
                                    <a href="javascript:;" class="text-warning"><i class="fa fa-star-o fa-2x fs-7"></i></a>
                                </div>
                                @if(isset($productImages) && $productImages)
                                    @foreach ($productImages as $imgKey=>$image )
                                        <div class="tab-pane fade {{$imgKey == 0 ? 'show active' : ''}}" id="product{{$imgKey}}">
                                            <div class="pro-large-img m-0 p-0">
                                                <img src="{{isset($largePath) ? $largePath . $image->file_name : '' }}" alt=" " />
                                                <a class="popup-link" href="{{isset($largePath) ? $largePath . $image->file_name : '' }}">Zoom Image <i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
							</div>
							<!-- Nav tabs -->
							<div class="row bg-white m-4 nav details-tab-not-use owl-carousel-not-use ">
                                @if(isset($productImages) && $productImages)
                                    @foreach ($productImages as $imgKey2=>$image )
                                        <div class="col-3">
                                            <div class="p-1 bg-grey">
                                                <a class="{{$imgKey2 == 0 ? 'active' : ''}}" href="#product{{$imgKey2}}" data-bs-toggle="tab">
                                                    <img src="{{isset($path3030) ? $path3030 . $image->file_name : '' }}" alt=" " />
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <hr class="mt-1 mb-0"/>
                            </div>
							<div class="row">
                                <div class="col-8">
                                    <div class="text-left bg-white p-0">
                                        <span class="text-info"><b>{{isset($productDetails) && $productDetails ? ucfirst($productDetails->product_name) : ''}}</b></span>
                                        <div class="text-brown"><b>&#8358;{{isset($productDetails) && $productDetails ? number_format($productDetails->display_price, 2) : ''}}</b></div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div align="left" class="fs-8" title="Total Viewers"> <span class="fa fa-eye text-dark"> {{isset($productDetails) && $productDetails ? $productDetails->total_view : '0'}} </span></div>
                                    <div align="left" class="fs-8" title="Seller Location"> <span class="fa fa-map-marker text-dark"> {{ $productDetails->state .', '. $productDetails->lga}} </span></div>
                                </div>
                                <div align="right" class="col-2">
                                    <div class=""> <a href="#" class="text-white bg-brown p-1 btn btn-sm" style="font-size: 9px;"><span class="fa fa-shopping-cart"> Buy Now </span></a></div>
                                </div>
                            </div>
                            <hr class="mb-1 mt-0"/>
                                <div class="row">
                                    <div class="col-12 pl-2 pr-2">
                                        <div class="col-1 text-center">
                                            <span class="fa fa-automobile fa-2x"></span>
                                            <div style="font-size: 7px;">{{isset($productDetails) && $productDetails ? ucfirst($productDetails->category_name) : ''}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                        </div>
                                        <div class="col-1 text-center">
                                            <span class="fa fa-tachometer fa-2x"></span>
                                            <div style="font-size: 7px;">00001 Km </div>
                                        </div>
                                        <div class="col-1 text-center">
                                            <span class="fa fa-ge fa-2x"></span>
                                            <div style="font-size: 7px;">Automatic</div>
                                        </div>
                                        <div class="col-1 text-center">
                                            <span class="fa fa-tint fa-2x"></span>
                                            <div style="font-size: 7px;">Petrol</div>
                                        </div>
                                        <div class="col-1 text-center">
                                            <span class="fa fa-shield fa-2x"></span>
                                            <div style="font-size: 7px;">Free Comprehesive <br /> Insurance</div>
                                        </div>
                                        <div class="col-1 text-center">
                                            <span class="fa fa-sun-o fa-2x"></span>
                                            <div style="font-size: 7px;">Free Vehicle&nbsp;Tracker</div>
                                        </div>
                                        <div class="col-1 text-center">
                                            <span class="fa fa-medkit fa-2x"></span>
                                            <div style="font-size: 7px;">Free&nbsp;Vehicle Diagnois</div>
                                        </div>
                                        <div class="col-1 text-center">
                                            <span class="fa fa-fire-extinguisher fa-2x"></span>
                                            <div style="font-size: 7px;">Free&nbsp;Fire Extinguisher</div>
                                        </div>
                                        <div class="col-1 text-center">
                                            <span class="fa fa-wpforms fa-2x"></span>
                                            <div style="font-size: 7px;">Free&nbsp;Vehicle Plate&nbsp;Number</div>
                                        </div>
                                        <div class="col-1 text-center">
                                            <span class="fa fa-wrench fa-2x"></span>
                                            <div style="font-size: 7px;">Free&nbsp;Vehicle Sercing</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <hr class="mb-1 mt-0"/> --}}
                                    {!!isset($productDetails) && $productDetails ? $productDetails->product_details : ''!!}
                                <hr class="mb-1 mt-0"/>
                                <div class="d-flex flex-row justify-content-end bd-highlight mb-1">
                                    <div class="pt-2 bd-highlight text-center m-1">
                                        <div class="p-2"> <a href="#" class="text-white bg-success p-2" style="font-size: 14px;"> SHARE </a></div>
                                    </div>
                                    <div class="pt-2 bd-highlight text-center m-1">
                                        <div class="p-2"> <a href="#" class="text-white bg-brown p-2" style="font-size: 14px;"><span class="fa fa-shopping-cart"> Buy Now </span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="col-md-4 bg-white shadow-sm pt-4 pb-3 mb-5 bg-body rounded">
						<div class="row product-details">
                            <div class="col-md-12">
								<div class="text-center text-brown fs-5"><b>VERIFIED DEALER</b></div>
                                <hr class="mt-3 mb-1 bg-brown" />
                            </div>
							<div class="row">
								<div class="col-md-12">
									<div align="center" class="mt-2">
										<img class="rounded-circle z-depth-4 bg-success" alt="Avatar" style="width: 80px; height: 80px;" src="{{ asset('assets/' . (isset($sellerAvater) ? $sellerAvater : ''))}}" data-holder-rendered="true">
										<div class="fw-bolder p-3"><h6><strong>SELLER ID: {{ isset($productDetails) && $productDetails ? $productDetails->seller_id : ''}}</strong></h6></div>
										<div class="box-quantity">
											<a href="#" class="m-1 p-2 bg-success text-white">
												<span class="fa fa-envelope"></span> Message
                                            </a>
											<a href="#" class="m-1 p-2 bg-success text-white">
												<span class="fa fa-phone"></span> Call Seller
                                            </a>
										</div>
									</div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-yellow"><b>BUY ON ESGCARS AND CLAIM</b></div>
                                            <ol>
                                                <li>Free Comprehensive Insurance</li>
                                                <li>Free Vehicle Tracker</li>
                                                <li>Free Fire Extinguisher</li>
                                                <li>Free Vehicle Diagnosis</li>
                                                <li>Free Vehicle Plate Number</li>
                                                <li>Free First Car Servicing</li>
                                            </ol>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="text-yellow"><b>HOW TO BUY</b></div>
                                            <ol>
                                                <li>Choose your choice car</li>
                                                <li>Click on buy now</li>
                                                <li>Fill the invoice form</li>
                                                <li>An invoice will be sent to your email</li>
                                                <li>Take the invoice & any means of ID to the seller</li>
                                                <li>Claim the bonus attached</li>
                                            </ol>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="text-yellow"><b>SAFETY TIPS</b></div>
                                            <ol>
                                                <li>Do not pay in advance even for the delivery</li>
                                                <li>All our verified dealers have offices</li>
                                                <li>Try to meet at a safe, public location</li>
                                                <li>Check the item BEFORE you buy it</li>
                                                <li>Fill ESGCARS "Bonus Claim From" before payment</li>
                                                <li>Pay only after collecting the item</li>
                                            </ol>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- product-details-end -->



		<!-- .slider-product-area-3-start -->
		<div class="slider-product-area-4 pt-1 pb-10 shadow-sm  rounded">
			<div class="container">
				<div class="section-title mb-40 text-left section-title-pro">
					<h5 class="text-brown">Similar Adverts</h5>
                    <hr class="mb-0 mt-1" />
				</div>
				<div class="">
                    <div class="row">
                        @if(isset($similarAdverts) && $similarAdverts)
                            @foreach ($similarAdverts as $similerKey=>$advert)
                                <div class="col-md-3 mb-2">
                                    @includeIf('share.single_product_template', ['showSingleProduct'=>1, 'fileName'=> (isset($similarAdvertsImages) ? '300x300/' .$similarAdvertsImages[$advert->productID] : '' ), 'productName'=>$advert->product_name, 'productPrice'=>$advert->display_price, 'productType'=>$advert->category_name, 'newBadge'=> (date('d-m-Y', strtotime($advert->pcreated)) == date('d-m-Y') ? 1 : 0), 'productID'=>$advert->productID, 'totalView'=>$advert->total_view, 'favouriteIcon'=> 0, ])
                                </div>
                            @endforeach
                        @endif
                    </div>
				</div>
			</div>
		</div>
		<!-- .slider-product-area-3-end -->


@endsection

@section('style')
    <style>

    </style>
@endsection

@section('script')
    <script>

    </script>
@endsection
