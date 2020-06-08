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
				$master = ['user','division'];
				$reservation = ['reservation'];
				$setting = ['general'];
			?>
			@if(@\Auth::user()->role == \App\Util\Constant::USER_ROLE_ADMIN)
			<li class="nav-item {{ in_array(@$sidebar,$master) ? 'active' : ''}}">
				<a href="javascript" class="nav-link nav-toggle"> <i
							class="fa fa-database"></i> <span class="title">Master Data</span>
					<span class="arrow {{ in_array(@$sidebar,$master) ? '' : 'hidden'}}"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{@$sidebar === 'user'? 'active' : ''}}">
						<a
							href="{{route('users')}}" class="nav-link nav-toggle"> <i
								class="fa fa-users"></i> <span class="title">Account</span> <span
								class="arrow {{@$sidebar === 'user'? '' : 'hidden'}}"></span>
						</a>
					</li>
{{--					<li class="nav-item {{@$sidebar === 'division'? 'active' : ''}}"><a--}}
{{--							href="{{route('admin.divisions')}}" class="nav-link nav-toggle"> <i--}}
{{--								class="fa fa-tags"></i> <span class="title">Division</span> <span--}}
{{--								class="arrow {{@$sidebar === 'division'? '' : 'hidden'}}"></span>--}}
{{--					</a></li>--}}
				</ul>
			</li>

			<li class="nav-item {{@$sidebar === 'reservation'? 'active' : ''}} "><a
					href="{{route('admin.reservations')}}" class="nav-link nav-toggle"> <i
						class="fa fa-database"></i> <span class="title">Reservasi</span> <span
						class="arrow {{@$sidebar === 'reservation'? '' : 'hidden'}}"></span>
			</a></li>

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
