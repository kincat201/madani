<!-- Header -->
<header class="header-v2">
	<!-- Header desktop -->
	<div class="container-menu-desktop trans-03">
		<div class="wrap-menu-desktop">
			<nav class="limiter-menu-desktop p-l-45">
				
				<!-- Logo desktop -->		
				<a href="{{route('home')}}" class="logo">
					<img src="{{url('storage/'.$CONF->logo)}}" alt="{{$CONF->title}}">
				</a>

				<!-- Menu desktop -->
				<div class="menu-desktop">
					<ul class="main-menu">
						<li class="{{request()->is('/')?'active-menu':''}}">
							<a href="{{route('home')}}">Beranda</a>
						</li>

						@php
							$productLink = ['product','product/*','cart','checkout','confirm']
						@endphp
						<li class="{{in_array(request()->segment(1),$productLink)?'active-menu':''}}">
							<a href="{{route('product')}}">Belanja</a>
						</li>

						<li class="{{request()->is('help')?'active-menu':''}}">
							<a href="{{route('help')}}">Bantuan & FAQ</a>
						</li>

						<li class="{{request()->is('about')?'active-menu':''}}">
							<a href="{{route('about')}}">Tentang</a>
						</li>

						<li class="{{request()->is('contact')?'active-menu':''}}">
							<a href="{{route('contact')}}">Kontak</a>
						</li>
						@php
							$memberLink = ['login','myprofile','password','myorder']
						@endphp
						<li class="{{in_array(request()->segment(1),$memberLink)?'active-menu':''}}">
							@if(@\Auth::user()->role == \App\Util\Constant::USER_ROLE_ADMIN)
							<a href="{{route('admin.dashboard')}}">Dashboard</a>
							@elseif(\Auth::user())
							<a href="javascript:;">Member <i class="fa fa-angle-down"></i></a>
							<ul class="sub-menu">
								<li><a href="{{route('member')}}">Profil</a></li>
								<li><a href="{{route('member.order')}}">Daftar Pesanan</a></li>
								<li><a href="{{route('logout')}}">Keluar</a></li>
							</ul>
							@else
							<a href="{{route('login')}}">Member</a>
							@endif
						</li>
					</ul>
				</div>	

				<!-- Icon header -->
				<div class="wrap-icon-header flex-w flex-r-m h-full">
					<div class="flex-c-m h-full p-r-24">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>
					</div>
						
					<div class="flex-c-m h-full p-l-18 p-r-25 bor5">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" id="cartCount" data-notify="{{count(Session::get('carts'))}}">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
					</div>
						
					<div class="flex-c-m h-full p-lr-19">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
							<i class="zmdi zmdi-menu"></i>
						</div>
					</div>
				</div>
			</nav>
		</div>	
	</div>

	<!-- Header Mobile -->
	<div class="wrap-header-mobile">
		<!-- Logo moblie -->		
		<div class="logo-mobile">
			<a href="{{route('home')}}" class="logo">
				<img src="{{url('storage/'.$CONF->logo)}}" alt="{{$CONF->title}}">
			</a>
		</div>

		<!-- Icon header -->
		<div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
			<div class="flex-c-m h-full p-r-10">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>
			</div>

			<div class="flex-c-m h-full p-lr-10 bor5">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>
			</div>
		</div>

		<!-- Button show menu -->
		<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</div>
	</div>


	<!-- Menu Mobile -->
	<div class="menu-mobile">
		<ul class="main-menu-m">
			<li class="{{request()->is('/')?'active-menu':''}}">
				<a href="{{route('home')}}">Beranda</a>
			</li>

			@php
				$productLink = ['product','product/*','cart','checkout','confirm']
			@endphp
			<li class="{{in_array(request()->segment(1),$productLink)?'active-menu':''}}">
				<a href="{{route('product')}}">Belanja</a>
			</li>

			<li class="{{request()->is('help')?'active-menu':''}}">
				<a href="{{route('help')}}">Bantuan & FAQ</a>
			</li>

			<li class="{{request()->is('about')?'active-menu':''}}">
				<a href="{{route('about')}}">Tentang</a>
			</li>

			<li class="{{request()->is('contact')?'active-menu':''}}">
				<a href="{{route('contact')}}">Kontak</a>
			</li>
		</ul>
	</div>

	<!-- Modal Search -->
	<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
		<div class="container-search-header">
			<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
				<img src="{{url('frontend/images/icons/icon-close2.png')}}" alt="CLOSE">
			</button>

			<form action="{{route('product')}}" method="get" class="wrap-search-header flex-w p-l-15">
				<button type="submit" class="flex-c-m trans-04">
					<i class="zmdi zmdi-search"></i>
				</button>
				<input class="plh3" type="text" name="keyword" placeholder="Cari Produk">
			</form>
		</div>
	</div>
</header>