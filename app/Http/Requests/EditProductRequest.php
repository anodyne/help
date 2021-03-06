<?php namespace Help\Http\Requests;

use Help\Http\Requests\Request;

class EditProductRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required',
			'slug' => 'required',
		];
	}

	public function messages()
	{
		return [
			'name.required' => "Please enter a name for the product",
			'slug.required' => "Please enter a slug for the product",
		];
	}

}
