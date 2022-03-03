@extends('layouts.guest')
@section("pageTitle", "Product Cart")
@section("currentPageProductCart", "active")
@section('closeAllCategoty', null)
@section('pageContent')

   <!-- product-details-start -->
		<div class="product-details-area pt-20">
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<div class="product-zoom dotted-style-1">
							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane fade show active" id="product1">
									<div class="pro-large-img">
										<img src="assets/images/product/1.webp" alt="" />
										<a class="popup-link" href="assets/images/product/1.webp">View larger <i class="fa fa-search-plus" aria-hidden="true"></i></a>
									</div>
								</div>
								<div class="tab-pane fade" id="product2">
									<div class="pro-large-img">
										<img src="assets/images/product/2.webp" alt="" />
										<a class="popup-link" href="assets/images/product/2.webp">View larger <i class="fa fa-search-plus" aria-hidden="true"></i></a>
									</div>
								</div>
								<div class="tab-pane fade" id="product3">
									<div class="pro-large-img">
										<img src="assets/images/product/3.webp" alt="" />
										<a class="popup-link" href="assets/images/product/3.webp">View larger <i class="fa fa-search-plus" aria-hidden="true"></i></a>
									</div>
								</div>
								<div class="tab-pane fade" id="product4">
									<div class="pro-large-img">
										<img src="assets/images/product/4.webp" alt="" />
										<a class="popup-link" href="assets/images/product/4.webp">View larger <i class="fa fa-search-plus" aria-hidden="true"></i></a>
									</div>
								</div>
								<div class="tab-pane fade" id="product5">
									<div class="pro-large-img">
										<img src="assets/images/product/5.webp" alt="" />
										<a class="popup-link" href="assets/images/product/5.webp">View larger <i class="fa fa-search-plus" aria-hidden="true"></i></a>
									</div>
								</div>
								<div class="tab-pane fade" id="product6">
									<div class="pro-large-img">
										<img src="assets/images/product/6.webp" alt="" />
										<a class="popup-link" href="assets/images/product/6.webp">View larger <i class="fa fa-search-plus" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
							<!-- Nav tabs -->
							<ul class="nav details-tab owl-carousel">
								<li><a class="active" href="#product1" data-bs-toggle="tab"><img src="assets/images/product/1.webp" alt="" /></a></li>
								<li><a href="#product2" data-bs-toggle="tab"><img src="assets/images/product/2.webp" alt="" /></a></li>
								<li><a href="#product3" data-bs-toggle="tab"><img src="assets/images/product/3.webp" alt="" /></a></li>
								<li><a href="#product4" data-bs-toggle="tab"><img src="assets/images/product/4.webp" alt="" /></a></li>
								<li><a href="#product5" data-bs-toggle="tab"><img src="assets/images/product/5.webp" alt="" /></a></li>
								<li><a href="#product6" data-bs-toggle="tab"><img src="assets/images/product/6.webp" alt="" /></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-7 bg-white p-2">
						<div class="product-details">
							<h2 class="pro-d-title">MacBook Pro</h2>
							<div class="pro-ref">
								<p>
									<label>Reference: </label>
									<span> Reference: demo_1 </span>
								</p>
								<p>
									<label>Condition: </label>
									<span>New product</span>
								</p>
							</div>
							<div class="price-box">
								<span class="price product-price">$262.00</span>
								<span class="old-price product-price">$262.00</span>
							</div>
							<div class="short-desc">
								<p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
							</div>
							<div class="box-quantity">
								<form action="#">
									<label>Quantity</label>
									<input type="number" value="1" />
									<button>add to cart</button>
								</form>
							</div>
							<div class="usefull_link_block">
								<ul>
									<li><a href="#"><i class="fa fa-envelope-o"></i>Send to a friend</a></li>
									<li><a href="#"><i class="fa fa-print"></i>Print</a></li>
									<li><a href="#"><i class="fa fa-heart-o"></i> Add to wishlist</a></li>
								</ul>
							</div>
							<div class="select-size">
								<form action="#">
									<label>Size</label>
									<select name="#">
										<option value="">5</option>
										<option value="">6</option>
										<option value="">7</option>
										<option value="">8</option>
										<option value="">9</option>
									</select>
								</form>
							</div>
							<div class="color-list">
								<a href="#"></a>
								<a href="#"></a>
							</div>
							<div class="share-icon">
								<a class="twitter" href="#"><i class="fa fa-facebook"></i>  facebook</a>
								<a class="facebook" href="#"><i class="fa fa-twitter"></i>  twitter</a>
								<a class="google" href="#"><i class="fa fa-google-plus"></i>  linkedin</a>
								<a class="pinterest" href="#"><i class="fa fa-pinterest"></i>  facebook</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- product-details-end -->

		<!-- pro-info-area start -->
		<div class="pro-info-area">
			<div class="container">
				<div class="pro-info-box">
					<!-- Nav tabs -->
					<ul class="nav pro-info-tab">
						<li><a class="active" href="#home3" data-bs-toggle="tab">More info</a></li>
						<li><a href="#profile3" data-bs-toggle="tab">Data sheet</a></li>
						<li><a href="#messages3" data-bs-toggle="tab">Reviews</a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane fade show active" id="home3">
							<div class="pro-desc">
								<p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
							</div>
						</div>
						<div class="tab-pane fade" id="profile3">
							<div class="pro-desc">
								<table class="table-data-sheet">
									<tbody>
										<tr class="odd">
											<td>Compositions</td>
											<td>Cotton</td>
										</tr>
										<tr class="even">
											<td>Styles</td>
											<td>Casual</td>
										</tr>
										<tr class="odd">
											<td>Properties</td>
											<td>Short Sleeve</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane fade" id="messages3">
							<div class="pro-desc">
								<a href="#">Be the first to write your review!</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- pro-info-area end -->

		<!-- .slider-product-area-3-start -->
		<div class="slider-product-area-4 pt-30 pb-50">
			<div class="container">
				<div class="section-title mb-40 text-center section-title-pro">
					<h3>Category</h3>
				</div>

				<div class="slider-product dotted-style-1 pt-20">
					<div class="slider-product-active-3 owl-carousel">
						<div class="single-product single-product-sidebar white-bg">
							<div class="product-img product-img-left">
								<a href="#"><img src="assets/images/product/5.webp" alt="" /></a>
							</div>
							<div class="product-content product-content-right">
								<div class="pro-title">
									<h4><a href="product-details.html">Lounge Chair</a></h4>
								</div>
								<div class="pro-rating ">
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star-o"></i></a>
								</div>
								<div class="price-box">
									<span class="price product-price">$444.00</span>
								</div>
								<div class="product-icon">
									<div class="product-icon-left f-left">
										<a href="#"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
									</div>
								</div>
							</div>
						</div>
						<div class="single-product single-product-sidebar white-bg">
							<div class="product-img product-img-left">
								<a href="#"><img src="assets/images/product/6.webp" alt="" /></a>
							</div>
							<div class="product-content product-content-right">
								<div class="pro-title">
									<h4><a href="product-details.html">Lounge Chair</a></h4>
								</div>
								<div class="pro-rating ">
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star-o"></i></a>
								</div>
								<div class="price-box">
									<span class="price product-price">$444.00</span>
								</div>
								<div class="product-icon">
									<div class="product-icon-left f-left">
										<a href="#"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
									</div>
								</div>
							</div>
						</div>
						<div class="single-product single-product-sidebar white-bg">
							<div class="product-img product-img-left">
								<a href="#"><img src="assets/images/product/9.webp" alt="" /></a>
							</div>
							<div class="product-content product-content-right">
								<div class="pro-title">
									<h4><a href="product-details.html">imac</a></h4>
								</div>
								<div class="pro-rating ">
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star-o"></i></a>
								</div>
								<div class="price-box">
									<span class="price product-price">$300.00</span>
								</div>
								<div class="product-icon">
									<div class="product-icon-left f-left">
										<a href="#"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
									</div>
								</div>
							</div>
						</div>
						<div class="single-product single-product-sidebar white-bg">
							<div class="product-img product-img-left">
								<a href="#"><img src="assets/images/product/11.webp" alt="" /></a>
							</div>
							<div class="product-content product-content-right">
								<div class="pro-title">
									<h4><a href="product-details.html">imac</a></h4>
								</div>
								<div class="pro-rating ">
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star"></i></a>
									<a href="#"><i class="fa fa-star-o"></i></a>
								</div>
								<div class="price-box">
									<span class="price product-price">$331.00</span>
								</div>
								<div class="product-icon">
									<div class="product-icon-left f-left">
										<a href="#"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
									</div>
								</div>
							</div>
						</div>
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
