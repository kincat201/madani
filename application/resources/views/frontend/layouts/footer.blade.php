<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					Kategori Baru
				</h4>

				<ul>
					@foreach($lastCategories as $lastCategory)
					<li class="p-b-10">
						<a href="{{url('product?subCat='.$lastCategory->categoryId)}}" class="stext-107 cl7 hov-cl1 trans-04">
							{{$lastCategory->name.' ('.$lastCategory->totalProduct.')'}}
						</a>
					</li>
					@endforeach
				</ul>
			</div>

			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					Halaman
				</h4>

				<ul>
					<li class="p-b-10">
						<a href="{{route('about')}}" class="stext-107 cl7 hov-cl1 trans-04">
							Tentang
						</a>
					</li>

					<li class="p-b-10">
						<a href="{{route('help')}}" class="stext-107 cl7 hov-cl1 trans-04">
							Bantuan & FAQ 
						</a>
					</li>

					<li class="p-b-10">
						<a href="{{route('contact')}}" class="stext-107 cl7 hov-cl1 trans-04">
							Kontak
						</a>
					</li>

					<li class="p-b-10">
						<a href="{{route('login')}}" class="stext-107 cl7 hov-cl1 trans-04">
							Member
						</a>
					</li>
				</ul>
			</div>

			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					Hubungi Kami
				</h4>

				<p class="stext-107 cl7 size-201">
					Punya Pertanyaan atau Saran? Beri tahu kami di {{ $CONF->address }} atau Hubungi Kami {{$CONF->phone}}
				</p>

				<div class="p-t-27">
					<a href="{{$CONF->facebook}}" target="_blank" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-facebook"></i>
					</a>

					<a href="{{$CONF->instagram}}" target="_blank" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-instagram"></i>
					</a>

					<a href="https://api.whatsapp.com/send?phone={{$CONF->whatsapp}}&amp;text=Halo%20Admin%20Saya%20Ingin%20Bertanya%20terkait%20JSIT%20Commerce" target="_blank" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-whatsapp"></i>
					</a>
				</div>
				<div class="p-t-27">
					<p class="stext-107 cl7 size-201">Lacak Pengiriman (Hanya JNE)</p>
					<div class="row">
						<div class="col-md-9">
							<input class="form-control" name="waybill" placeholder="Nomor Resi" id="waybill">
						</div>
						<div class="col-md-3">
							<button class="btn btn-success btn-md" onclick="WayBill()">Cari</button>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					{{$CONF->title}}
				</h4>

				<p class="stext-107 cl7 size-201">
					{{$CONF->about}} 
				</p>
			</div>
		</div>

		<div class="p-t-40">
			<!-- <div class="flex-c-m flex-w p-b-18">
				<a href="#" class="m-all-1">
					<img src="{{url('frontend/images/icons/icon-pay-01.png')}}" alt="ICON-PAY">
				</a>

				<a href="#" class="m-all-1">
					<img src="{{url('frontend/images/icons/icon-pay-02.png')}}" alt="ICON-PAY">
				</a>

				<a href="#" class="m-all-1">
					<img src="{{url('frontend/images/icons/icon-pay-03.png')}}" alt="ICON-PAY">
				</a>

				<a href="#" class="m-all-1">
					<img src="{{url('frontend/images/icons/icon-pay-04.png')}}" alt="ICON-PAY">
				</a>

				<a href="#" class="m-all-1">
					<img src="{{url('frontend/images/icons/icon-pay-05.png')}}" alt="ICON-PAY">
				</a>
			</div> -->

			<p class="stext-107 cl6 txt-center">
				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | {{$CONF->title}}
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

			</p>
		</div>
	</div>
</footer>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
	<span class="symbol-btn-back-to-top">
		<i class="zmdi zmdi-chevron-up"></i>
	</span>
</div>
