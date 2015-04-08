<?php namespace Help\Http\Requests;

use Help\Http\Requests\Request;

class CreateArticleRequest extends Request {

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
			'product_id' => 'required|exists:products,id',
			'title' => 'required',
			'slug' => 'required',
			'summary' => 'required',
			'content' => 'required',
		];
	}

	public function messages()
	{
		return [
			'product_id.required' => "Please select a product for this article",
			'product_id.exists' => "Please select a valid product",
			'title.required' => "Please enter a title for this article",
			'slug.required' => "Please enter a slug for this article",
			'summary.required' => "Please enter a summary for this article",
			'content.required' => "Please enter the content for this article",
		];
	}

}
