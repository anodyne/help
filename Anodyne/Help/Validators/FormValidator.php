<?php namespace Xtras\Validators;

use FormValidationException;
use Illuminate\Validation\Factory as Validator;

abstract class FormValidator {

	protected $rules;
	protected $messages;
	protected $validator;
	protected $validation;

	public function __construct(Validator $validator)
	{
		$this->validator = $validator;
	}

	public function validate(array $data)
	{
		$this->validation = $this->validator->make(
			$data,
			$this->getValidationRules(),
			$this->getValidationMessages()
		);

		if ($this->validation->fails())
		{
			throw new FormValidationException('Form validation failed', $this->getValidationErrors());
		}

		return true;
	}

	protected function getValidationErrors()
	{
		return $this->validation->errors();
	}

	public function getValidationMessages()
	{
		return $this->messages;
	}

	protected function getValidationRules()
	{
		return $this->rules;
	}

}