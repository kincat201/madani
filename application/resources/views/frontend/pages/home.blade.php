@extends('frontend.layouts.template')

@section('pageTitle','Beranda')

@push('customCss')

@endpush

@section('content')

	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1 rs1-slick1">
			<div class="slick1">
				@foreach(json_decode($CONF->slider) as $slider)
				<div class="item-slick1" style="background-image: url({{url('storage/'.$slider->image)}});">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 cl2 respon2">
									{{$slider->title}}
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
									{{$slider->description}}
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="{{$slider->link}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									{{$slider->linkText}}
								</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>

	<!-- Banner -->
	<div class="sec-banner bg0">
		<div class="flex-w flex-c-m">
			@foreach($categories as $category)
			<div class="size-202 m-lr-auto respon4">
				<!-- Block1 -->
				<div class="block1 wrap-pic-w">
					<img src="{{url('storage/'.$category->image)}}" alt="{{$category->name}}">

					<a href="{{url('product?category='.$category->id)}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
						<div class="block1-txt-child1 flex-col-l">
							<span class="block1-name ltext-102 trans-04 p-b-8">
								{{$category->name}}
							</span>

							<span class="block1-info stext-102 trans-04">
								{{$category->description}}
							</span>
						</div>

						<div class="block1-txt-child2 p-b-4 trans-05">
							<div class="block1-link stext-101 cl0 trans-09">
								Lihat
							</div>
						</div>
					</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>


	<!-- Product -->
	<section class="sec-product bg0 p-t-100 p-b-50">
		<div class="container">
			<div class="p-b-32">
				<h3 class="ltext-105 cl5 txt-center respon1">
					Etalase Produk
				</h3>
			</div>

			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item p-b-10">
						<a class="nav-link active" data-toggle="tab" href="#best-seller" role="tab">Terlaris</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#sale" role="tab">Terbaru</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-50">
					<!-- - -->
					<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">
							<div class="slick2">
								@foreach($bests as $best)
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0 label-new label-{{$best->label}}" data-label="Terlaris">
											<img src="{{url('storage/'.$best->product->image)}}" alt="{{$best->product->name}}">

											<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" product-id="{{$best->product->id}}">
												Lihat
											</a>
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
												<a href="{{route('productDetail',['id'=>$best->product->id])}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
													{{ucwords($best->product->name)}}
												</a>

												<span class="stext-105 cl3">
													Rp. {{number_format(@$best->product->prices())}}
												</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
												<a href="{{route('productDetail',['id'=>$best->product->id])}}" class="btn-addwish-b2 dis-block pos-relative" style="color:#999">
													<i class="fa fa-archive" style="margin-left: 2px"></i>&nbsp;{{number_format($best->product->qty)}}
												</a>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="sale" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">
							<div class="slick2">
								@foreach($news as $new)
									<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
										<!-- Block2 -->
										<div class="block2">
											<div class="block2-pic hov-img0 label-new" data-label="Terbaru">
												<img src="{{url('storage/'.$new->image)}}" alt="{{$new->name}}">

												<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" product-id="{{$new->id}}">
													Quick View
												</a>
											</div>

											<div class="block2-txt flex-w flex-t p-t-14">
												<div class="block2-txt-child1 flex-col-l ">
													<a href="{{route('productDetail',['id'=>$new->id])}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
														{{ucwords($new->name)}}
													</a>

													<span class="stext-105 cl3">
													Rp. {{number_format(@$new->prices())}}
												</span>
												</div>

												<div class="block2-txt-child2 flex-r p-t-3">
													<a href="{{route('productDetail',['id'=>$new->id])}}" class="btn-addwish-b2 dis-block pos-relative" style="color:#999">
														<i class="fa fa-archive" style="margin-left: 2px"></i>&nbsp;{{number_format($new->qty)}}
													</a>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	@include('frontend.layouts.preview')

@endsection

@push('customJs')

@endpush
