<?php namespace Help\Foundation\Data\Models\Eloquent;

use Config;
use Zizaco\Entrust\EntrustRole;

class RoleModel extends EntrustRole {

    protected $connection = 'anodyneUsers';

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