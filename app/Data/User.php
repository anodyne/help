<?php namespace Help\Data;

use Date,
	Model,
	Config,
	SoftDeletingTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laracasts\Presenter\PresentableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;
	use EntrustUserTrait, PresentableTrait;

	protected $connection = 'users';

	protected $table = 'users';

	protected $fillable = ['remember_token'];

	protected $hidden = ['password', 'remember_token'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $presenter = 'Help\Data\Presenters\UserPresenter';

	public static $sanitizeRules = [
		'remember_token' => 'string',
	];

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	*/

	public function articles()
	{
		return $this->hasMany('Article');
	}

	/*
	|--------------------------------------------------------------------------
	| Model Scopes
	|--------------------------------------------------------------------------
	*/

	public function scopeUsername($query, $username)
	{
		$query->where('username', $username);
	}

	/*
	|--------------------------------------------------------------------------
	| Model Methods
	|--------------------------------------------------------------------------
	*/

	/**
	 * How many days since the user registered for their Anodyne ID?
	 *
	 * @return	int
	 */
	public function daysSinceRegistration()
	{
		return (int) Date::now()->diffInDays($this->created_at);
	}

}
