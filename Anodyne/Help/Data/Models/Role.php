<?php namespace Help\Data\Models;

use Config;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    protected $connection = 'users';

	protected $table = 'roles';

	protected $fillable = ['name'];

	public function perms()
    {
        return $this->belongsToMany(
        	Config::get('entrust::permission'),
        	Config::get('entrust::permission_role_table'),
        	'role_id',
        	'permission_id'
        );
    }

}