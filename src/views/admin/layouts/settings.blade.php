<!doctype html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>@yield('title') | {{ $settings->appName }}</title>
	@yield('scripts')
</head>
<body>
	<header id='header'>
		@yield('header')
	</header><!--#header ends-->
	<div id='content'>
		
		<nav>
			@yield('nav')
		</nav>

		@yield('content')

	</div><!--#content ends-->
	<footer id='footer'>
		<p>Copyright &copy; {{ date('Y') }} {{ $settings->appName }}</p>
	</footer><!--#footer ends-->
</body>
</html>