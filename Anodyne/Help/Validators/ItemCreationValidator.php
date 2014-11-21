<?php namespace Xtras\Validators;

class ItemCreationValidator extends FormValidator {

	protected $rules = [
		'type_id'		=> 'required|integer',
		'product_id'	=> 'required|integer',
		'name'			=> 'required',
		'version'		=> 'required',
	];

	protected $messages = [
		'type_id.required' => "Please select a type",
		'type_id.integer' => "Please select a valid type",
		'product_id.required' => "Please select a product",
		'product_id.integer' => "Please select a valid product",
		'name.required' => "Please enter a name for your Xtra",
		'version.required' => "Please enter a version",
	];

}