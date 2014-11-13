<?php namespace Xtras\Validators;

class ItemUpdateValidator extends FormValidator {

	protected $rules = [
		'name'		=> 'required',
		'version'	=> 'required',
	];

	protected $messages = [
		'name.required' => "Please enter a name for your Xtra",
		'version.required' => "Please enter a version",
	];

}