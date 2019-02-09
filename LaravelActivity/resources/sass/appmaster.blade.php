<html lang="en">
<head>
	<title>@yield('title')</title>
	
	<link rel=¨stylesheet¨ type=¨text/css¨ href=¨../sass/app.scss¨>
	
</head>

<script src="../js/app.js"></script>

<body>
	@include('layouts.header')
	<div align="center">
		@yield('content')
	</div>
	@include('layouts.footer')
</body>

</html>