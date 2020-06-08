<!-- begin:: Footer -->
<div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer">
	<div class="kt-footer__top">
		<div class="kt-container">
			<div class="row">
				<div class="col-lg-4">
					<div class="kt-footer__section">
						<h3 class="kt-footer__title">Tentang</h3>
						<div class="kt-footer__content text-justify">
							{{ $CONF->about }}
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="kt-footer__section">
						<h3 class="kt-footer__title">Navigasi</h3>
						<div class="kt-footer__content">
							<div class="kt-footer__nav">
								<div class="kt-footer__nav-section">
									<a href="{{ route('home') }}">Reservasi</a>
								</div>
								<div class="kt-footer__nav-section">
									@if(empty(\Auth::user()->id))
										<a href="{{ route('register') }}">Pendaftaran</a>
										<a href="{{ route('login') }}">Login</a>
									@else
										<a href="{{ route('logout') }}">Keluar</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="kt-footer__section">
						<h3 class="kt-footer__title">Kontak</h3>
						<div class="kt-footer__content">
							<div class="kt-footer__nav">
								<div class="kt-footer__nav-section">
									<a href="#"><i class="fa fa-phone"></i>&nbsp;&nbsp; {{ $CONF->phone }}</a>
									<a href="#"><i class="fa fa-envelope"></i>&nbsp;&nbsp; {{ $CONF->email }}</a>
									<a href="#"><i class="fa fa-location-arrow"></i>&nbsp;&nbsp; {{ $CONF->address }}</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-footer__bottom">
		<div class="kt-container">
			<div class="kt-footer__wrapper">
				<div class="kt-footer__copyright">
					&copy; {{ date('Y') }} <a href="http://koperasi-astra.com" target="_blank">Koperasi Astra</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- end:: Footer -->
