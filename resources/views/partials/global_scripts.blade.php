@if (app('env') == 'production')
	<!--[if lt IE 9]>
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<![endif]-->
	<!--[if gte IE 9]><!-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<!--<![endif]-->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
	<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
@else
	<script src="//localhost/global/jquery/jquery-2.1.1.min.js"></script>
	<script src="//localhost/global/bootstrap/3.3/js/bootstrap.min.js"></script>
	<script src="//localhost/global/jquery.validate/1.13/jquery.validate.min.js"></script>
	<script src="//localhost/global/jquery.validate/1.13/additional-methods.min.js"></script>
@endif