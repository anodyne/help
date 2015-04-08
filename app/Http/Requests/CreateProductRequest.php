<?php namespace Help\Http\Requests;

use Help\Http\Requests\Request;

class CreateProductRequest extends Request {

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
			'slug' => 'unique:products',
		];
	}

	public function messages()
	{
		return [
			'name.required' => "Please enter a name for the product",
			'slug.unique' => "That slug is already in use, please enter a unique slug",
		];
	}

}
