<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>CMS Area - @yield('title')</title>
		@include('cms.layout.link')
		@stack('link')
	</head>
	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			@include('cms.layout.nav')
			@include('cms.layout.aside')

			<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-12">
							<h1>@yield('title')</h1>
						</div>
					</div>
				</div>
			</section>
				@stack('content')
			</div>

			@include('cms.layout.footer')
			<aside class="control-sidebar control-sidebar-dark"></aside>
		</div>
		<div id="loading-page">
            <div class="dis-table">
                <div class="row">
                    <div class="cel">
                        <img src="{{ asset('asset/picture-default/loading_1.gif') }}">
                    </div>
                </div>
            </div>
        </div>
		@include('cms.layout.script')
		@stack('script')
	</body>
</html>