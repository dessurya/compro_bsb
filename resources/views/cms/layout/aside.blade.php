<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="{{ route('cms.dashboard') }}" class="brand-link">
      <img src="{{ asset('vendors/adminlte-dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CMS Area</span>
    </a>

    <div class="sidebar">
    	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    		<div class="image">
    			<img src="{{ asset('vendors/adminlte-dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
    		</div>
    		<div class="info">
    			<a href="{{ route('cms.user.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
    		</div>
    	</div>

    	<nav class="mt-2">
    		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    			<li class="nav-item">
    				<a href="{{ route('cms.dashboard') }}" class="nav-link {{ Route::is('cms.dashboard') ? 'active' : '' }} ">
    					<p>Dashboard</p>
    				</a>
    			</li>
				<li class="nav-item">
    				<a href="{{ route('cms.public-config') }}" class="nav-link {{ Route::is('cms.public-config') ? 'active' : '' }} ">
    					<p>Public Config</p>
    				</a>
    			</li>
				<li class="nav-item">
    				<a href="{{ route('cms.navigation-config') }}" class="nav-link {{ Route::is('cms.navigation-config') ? 'active' : '' }} ">
    					<p>Navigation Config</p>
    				</a>
    			</li>
				<li class="nav-item {{ Route::is('cms.page-config.*') ? 'menu-open' : '' }}">
    				<a href="#" class="nav-link {{ Route::is('cms.page-config.*') ? 'active' : '' }} ">
    					<p>Page Config <i class="fas fa-angle-left right"></i></p>
    				</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('cms.page-config.home') }}" class="nav-link {{ Route::is('cms.page-config.home') ? 'active' : '' }} ">
								<i class="far fa-circle nav-icon"></i><p>Home</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('cms.page-config.about-us') }}" class="nav-link {{ Route::is('cms.page-config.about-us') ? 'active' : '' }} ">
								<i class="far fa-circle nav-icon"></i><p>About Us</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('cms.page-config.our-product') }}" class="nav-link {{ Route::is('cms.page-config.our-product') ? 'active' : '' }} ">
								<i class="far fa-circle nav-icon"></i><p>Our Product</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('cms.page-config.sustainability') }}" class="nav-link {{ Route::is('cms.page-config.sustainability') ? 'active' : '' }} ">
								<i class="far fa-circle nav-icon"></i><p>Sustainability</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('cms.page-config.our-client') }}" class="nav-link {{ Route::is('cms.page-config.our-client') ? 'active' : '' }} ">
								<i class="far fa-circle nav-icon"></i><p>Our Client</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('cms.page-config.news-info') }}" class="nav-link {{ Route::is('cms.page-config.news-info') ? 'active' : '' }} ">
								<i class="far fa-circle nav-icon"></i><p>News Info</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('cms.page-config.investor') }}" class="nav-link {{ Route::is('cms.page-config.investor') ? 'active' : '' }} ">
								<i class="far fa-circle nav-icon"></i><p>investor</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('cms.page-config.career') }}" class="nav-link {{ Route::is('cms.page-config.career') ? 'active' : '' }} ">
								<i class="far fa-circle nav-icon"></i><p>Career</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('cms.page-config.contact-us') }}" class="nav-link {{ Route::is('cms.page-config.contact-us') ? 'active' : '' }} ">
								<i class="far fa-circle nav-icon"></i><p>Contact Us</p>
							</a>
						</li>
					</ul>
    			</li>
				<li class="nav-item">
    				<a href="{{ route('cms.banner') }}" class="nav-link {{ Route::is('cms.banner') ? 'active' : '' }} ">
    					<p>Banner</p>
    				</a>
    			</li>
				<li class="nav-item">
					<a href="{{ route('cms.product') }}" class="nav-link {{ Route::is('cms.product') ? 'active' : '' }} ">
						<p>Product</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('cms.management') }}" class="nav-link {{ Route::is('cms.management') ? 'active' : '' }} ">
						<p>Management</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('cms.sustainability') }}" class="nav-link {{ Route::is('cms.sustainability') ? 'active' : '' }} ">
						<p>Sustainability</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('cms.news-info') }}" class="nav-link {{ Route::is('cms.news-info') ? 'active' : '' }} ">
						<p>News & Info</p>
					</a>
				</li>
				{{--
				<li class="nav-item">
					<a href="{{ route('cms.information') }}" class="nav-link {{ Route::is('cms.information') ? 'active' : '' }} ">
						<p>Information</p>
					</a>
				</li>
				--}}
				<li class="nav-item">
					<a href="{{ route('cms.inbox') }}" class="nav-link {{ Route::is('cms.inbox') ? 'active' : '' }} ">
						<p>Inbox</p>
					</a>
				</li>
				<li class="nav-item">
    				<a href="{{ route('cms.user') }}" class="nav-link {{ Route::is('cms.user') ? 'active' : '' }} ">
    					<p>User Management</p>
    				</a>
    			</li>
				<li class="nav-item">
    				<a href="{{ route('cms.user-history') }}" class="nav-link {{ Route::is('cms.user-history') ? 'active' : '' }} ">
    					<p>User History</p>
    				</a>
    			</li>
    		</ul>
    	</nav>
    </div>
</aside>