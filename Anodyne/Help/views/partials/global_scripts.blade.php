@if (App::environment() == 'production')
	<!--[if lt IE 9]>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<![endif]-->
	<!--[if gte IE 9]><!-->
		<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<!--<![endif]-->

	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
	<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
@else
	<!--[if lt IE 9]>
		<script src="//localhost/global/jquery/jquery-1.11.1.min.js"></script>
	<![endif]-->
	<!--[if gte IE 9]><!-->
		<script src="//localhost/global/jquery/jquery-2.1.1.min.js"></script>
	<!--<![endif]-->

	<script src="//localhost/global/bootstrap/3.3/js/bootstrap.min.js"></script>
	<script src="//localhost/global/jquery.validate/1.13/jquery.validate.min.js"></script>
	<script src="//localhost/global/jquery.validate/1.13/additional-methods.min.js"></script>
@endif