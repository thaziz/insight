<!DOCTYPE html>
<html>
@include('layouts._head')

@yield('extra_styles')



<body>
	<div class="loader" style="display: none;"></div>

@include('layouts._sidebar')
	@include('layouts._navbar')

	

	@yield('content')

	@include('layouts._footer')

	@include('layouts._script')

	@yield('extra_scripts')

</body>
</html>
