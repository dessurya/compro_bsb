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
					<a href="{{ route('cms.news-info') }}" class="nav-link {{ Route::is('cms.news-info') ? 'active' : '' }} ">
						<p>News & Info</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('cms.information') }}" class="nav-link {{ Route::is('cms.information') ? 'active' : '' }} ">
						<p>Information</p>
					</a>
				</li>
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