<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
	</ul>

	<ul class="navbar-nav ml-auto">
		<li id="inbox-notif-wrapper" class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
				<i class="far fa-comments"></i>
				<span class="badge badge-danger navbar-badge">3</span>
			</a>
			<div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="left: inherit; right: 0px;">
				<div id="appendInbox"></div>
				<div class="dropdown-divider"></div>
				<a href="{{ route('cms.inbox') }}" class="dropdown-item dropdown-footer">See All Inbox</a>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('cms.user.profile') }}" role="button" alt="profile" title="Profile">
				<i class="fas fa-id-card-alt"></i>
	        </a>
	    </li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('cms.logout') }}" role="button" alt="sign-out" title="sign out">
				<i class="fas fa-sign-out-alt"></i>
	        </a>
	    </li>
	</ul>
</nav>