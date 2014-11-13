<?php namespace Xtras\Validators;

class ItemMessageValidator extends FormValidator {

	protected $rules = [
		'type'		=> 'required|in:info,warning,danger',
		'content'	=> 'required',
	];

	protected $messages = [
		'type.required' => "Please select a type for your message",
		'type.in' => "Please select a valid message type",
		'content.required' => "Please enter your message",
	];

}