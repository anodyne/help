<?php namespace Help\Services;

use InvalidArgumentException;

class Sanitizer {

	public function clean(array $input, array $rules)
	{
		$cleanArr = [];

		foreach ($input as $field => $value)
		{
			if (array_key_exists($field, $rules))
			{
				$cleanArr[$field] = $this->{$rules[$field]}($value, $field);
			}
		}

		return $cleanArr;
	}

	public function date($input, $field)
	{
		if (substr_count($input, '/') == 2)
		{
			// Get variables for each part of the date
			list($month, $day, $year) = explode('/', $input);

			if (checkdate($month, $day, sprintf('%04u', $year)))
			{
				return $input;
			}

			throw new InvalidArgumentException("Invalid date [{$input}] provided for [{$field}].");
		}

		throw new InvalidArgumentException("Invalid date format provided for [{$field}]. Dates must be formatted as MM/DD/YYYY.");
	}

	public function email($input, $field = false)
	{
		return $this->sanitize(strip_tags($input), FILTER_SANITIZE_EMAIL);
	}

	public function float($input, $field = false)
	{
		return (float) $this->sanitize($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND | FILTER_FLAG_ALLOW_SCIENTIFIC);
	}

	public function integer($input, $field = false)
	{
		return (int) $this->sanitize($input, FILTER_SANITIZE_NUMBER_INT);
	}

	public function string($input, $field = false)
	{
		return $this->sanitize(strip_tags($input), FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
	}

	public function url($input, $field = false)
	{
		return $this->sanitize(strip_tags($input), FILTER_SANITIZE_URL);
	}

	protected function sanitize($input, $filter, $options = '')
	{
		if (is_array($input))
		{
			$arr = [];

			foreach ($input as $key => $value)
			{
				$arr[$key] = filter_var(trim($value), $filter, $options);
			}
		}

		return filter_var(trim($input), $filter, $options);
	}

}
