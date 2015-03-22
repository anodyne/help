@extends('layouts.no-structure')

@section('content')
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<h3 class="modal-title">Contact Anodyne</h3>
	</div>
	<div class="modal-body">
		<p class="alert alert-success hide" id="success">Your message has been sent to Anodyne Productions. We value your feedback and will be in touch soon!</p>

		<p class="alert alert-danger hide" id="error">There was a problem sending your message. Please try again.</p>

		<form class="contact" id="contactForm">
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<div class="form-group">
						<label class="control-label">Name</label>
						{!! Form::text('name', null, ['class' => 'form-control']) !!}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<div class="form-group">
						<label class="control-label">Email Address</label>
						{!! Form::text('email', null, ['type' => 'email', 'class' => 'form-control']) !!}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label">Message</label>
						{!! Form::textarea('message', null, ['rows' => 5, 'class' => 'form-control']) !!}
						<p class="help-block">{!! $_icons['markdown'] !!} Parsed as Markdown</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<div class="form-group">
						<label class="control-label">Spam-Be-Gone</label>
						<p class="help-block">In order to prevent spam, please type in the following number to the field below: <strong><?php echo $antispam;?></strong>.</p>
						{!! Form::text('antispam', null, ['class' => 'form-control']) !!}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						{!! Form::button('Send', ['type' => 'submit', 'id' => 'send', 'class' => 'btn btn-lg btn-block btn-primary']) !!}
					</div>
				</div>
			</div>
		</form>
	</div>
@stop

@section('scripts')
	<script>
		$(document).ready(function()
		{
			$('#contactForm').validate({
				debug: true,
				ignore: ".ignore",
				rules: {
					name: "required",
					email: {
						required: true,
						email: true
					},
					message: "required",
					antispam: {
						required: true,
						number: true
					}
				},
				messages: {
					name: "Please enter your name",
					email: {
						required: "Please enter your email address",
						email: "Please enter a valid email address"
					},
					message: "Please enter a message to send",
					antispam: {
						required: "Please enter the number displayed above",
						number: "Some reading classes may be in order. The anti-spam phrase is only numbers."
					}
				},
				errorClass: "help-block validation-error",
				errorElement: "p",
				highlight: function(element, errorClass, validClass)
				{
					$(element).closest('.form-group').addClass('has-error');
				},
				unhighlight: function(element, errorClass, validClass)
				{
					$(element).closest('.form-group').removeClass('has-error');
				},
				submitHandler: function(form)
				{
					$.ajax({
						type: "POST",
						url: "{{ route('contact.do') }}",
						data: $('#contactForm').serialize(),
						success: function(data)
						{
							$('#contactForm').addClass('hide');
							$('#success').removeClass('hide');
						},
						error: function(data)
						{
							$('#error').removeClass('hide');
						}
					});
				}
			});
		});
	</script>
@stop