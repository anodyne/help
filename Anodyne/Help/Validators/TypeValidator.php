<?php namespace Xtras\Validators;

class TypeValidator extends FormValidator {

	protected $rules = [
		'name' => 'required',
	];

	protected $messages = [
		'name.required' => "Please enter an item type name",
	];

}