<?php namespace Xtras\Validators;

class ProductValidator extends FormValidator {

	protected $rules = [
		'name' => 'required',
	];

	protected $messages = [
		'name.required' => "Please enter a product name",
	];

}