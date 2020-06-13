<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu  page-header-fixed "
			data-keep-expanded="false" data-auto-scroll="true"
			data-slide-speed="200" style="padding-top: 38px">
			<li class="nav-item {{@$sidebar === 'dashboard'? 'active' : ''}} "><a
				href="{{route('admin.dashboard')}}" class="nav-link nav-toggle"> <i
					class="fa fa-dashboard"></i> <span class="title">Beranda</span> <span
					class="arrow {{@$sidebar === 'dashboard'? '' : 'hidden'}}"></span>
			</a></li>
			<?php
				$master = ['user','member'];
				$product = ['unit','category','product','machine'];
				$order = ['order','order_new'];
				$setting = ['general'];
			?>
			@if(@\Auth::user()->role == \App\Util\Constant::USER_ROLE_ADMIN)
			<li class="nav-item {{ in_array(@$sidebar,$master) ? 'active' : ''}}">
				<a href="javascript" class="nav-link nav-toggle"> <i
							class="fa fa-database"></i> <span class="title">Pengguna</span>
					<span class="arrow {{ in_array(@$sidebar,$master) ? '' : 'hidden'}}"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{@$sidebar === 'user'? 'active' : ''}}">
						<a
							href="{{route('admin.users')}}" class="nav-link nav-toggle"> <i
								class="fa fa-admin.users"></i> <span class="title">Akun</span> <span
								class="arrow {{@$sidebar === 'user'? '' : 'hidden'}}"></span>
						</a>
					</li>
					<li class="nav-item {{@$sidebar === 'member'? 'active' : ''}}">
						<a
								href="{{route('admin.users')}}" class="nav-link nav-toggle"> <i
									class="fa fa-admin.users"></i> <span class="title">Pelanggan</span> <span
									class="arrow {{@$sidebar === 'member'? '' : 'hidden'}}"></span>
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item {{ in_array(@$sidebar,$product) ? 'active' : ''}}">
				<a href="javascript" class="nav-link nav-toggle"> <i
							class="fa fa-database"></i> <span class="title">Produk</span>
					<span class="arrow {{ in_array(@$sidebar,$product) ? '' : 'hidden'}}"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{@$sidebar === 'product'? 'active' : ''}}">
						<a
								href="{{route('admin.users')}}" class="nav-link nav-toggle"> <i
									class="fa fa-admin.users"></i> <span class="title">Daftar Produk</span> <span
									class="arrow {{@$sidebar === 'product'? '' : 'hidden'}}"></span>
						</a>
					</li>
					<li class="nav-item {{@$sidebar === 'category'? 'active' : ''}}">
						<a
								href="{{route('admin.users')}}" class="nav-link nav-toggle"> <i
									class="fa fa-admin.users"></i> <span class="title">Kategori Produk</span> <span
									class="arrow {{@$sidebar === 'category'? '' : 'hidden'}}"></span>
						</a>
					</li>
					<li class="nav-item {{@$sidebar === 'unit'? 'active' : ''}}">
						<a
								href="{{route('admin.users')}}" class="nav-link nav-toggle"> <i
									class="fa fa-admin.users"></i> <span class="title">Satuan Produk</span> <span
									class="arrow {{@$sidebar === 'unit'? '' : 'hidden'}}"></span>
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item {{ in_array(@$sidebar,$order) ? 'active' : ''}}">
				<a href="javascript" class="nav-link nav-toggle"> <i
							class="fa fa-database"></i> <span class="title">Pesanan</span>
					<span class="arrow {{ in_array(@$sidebar,$order) ? '' : 'hidden'}}"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{@$sidebar === 'order_new'? 'active' : ''}}">
						<a
								href="{{route('admin.users')}}" class="nav-link nav-toggle"> <i
									class="fa fa-admin.users"></i> <span class="title">Pesanan Baru</span> <span
									class="arrow {{@$sidebar === 'order_new'? '' : 'hidden'}}"></span>
						</a>
					</li>
					<li class="nav-item {{@$sidebar === 'order'? 'active' : ''}}">
						<a
								href="{{route('admin.users')}}" class="nav-link nav-toggle"> <i
									class="fa fa-admin.users"></i> <span class="title">Daftar Pesanan</span> <span
									class="arrow {{@$sidebar === 'member'? '' : 'hidden'}}"></span>
						</a>
					</li>
				</ul>
			</li>

			@endif
			@if(@\Auth::user()->role == \App\Util\Constant::USER_ROLE_ADMIN)
			<li class="nav-item {{in_array(@$sidebar,$setting)? 'active' : ''}}">
				<a href="javascript" class="nav-link nav-toggle"> <i
						class="fa fa-gears"></i> <span class="title">Pengaturan</span>
				<span class="arrow {{in_array(@$sidebar,$setting)? '' : 'hidden'}}"></span>
			</a>
				<ul class="sub-menu">
					<li class="nav-item {{@$sidebar === 'general'? 'active' : ''}}"><a
							href="{{route('settings')}}" class="nav-link nav-toggle"> <i
								class="icon-share"></i> <span class="title">Umum</span> <span
								class="arrow {{@$sidebar === 'general'? '' : 'hidden'}}"></span>
					</a></li>
				</ul>
			</li>
			@endif
			<li class="nav-item {{@$sidebar === 'notification'? 'active' : ''}} "><a
					href="{{route('admin.notifications')}}" class="nav-link nav-toggle"> <i
						class="fa fa-envelope"></i> <span class="title">Notifikasi {{ $notification['count'] > 0 ? '('.$notification['count'].')' : '' }}</span> <span
						class="arrow {{@$sidebar === 'notification'? '' : 'hidden'}}"></span>
			</a></li>
		</ul>
	</div>
</div>
