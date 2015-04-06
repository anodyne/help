{!! Form::model($review, ['route' => ['admin.review.update', $review->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
	<div class="form-group">
		<label class="control-label col-md-3">Resolution</label>
		<div class="col-md-9">
			{!! Form::select('resolution', $statuses, null, ['class' => 'form-control input-lg']) !!}
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">Message to Submitter</label>
		<div class="col-md-9">
			{!! Form::textarea('message', null, ['class' => 'form-control input-lg']) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-9 col-md-offset-3">
			<div class="visible-xs visible-sm">
				<p>{!! Form::button("Update Review Request", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block']) !!}</p>
			</div>
			<div class="visible-md visible-lg">
				{!! Form::button("Update Review Request", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg']) !!}
			</div>
		</div>
	</div>
{!! Form::close() !!}