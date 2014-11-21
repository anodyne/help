<?php namespace Help\Data\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission {

	protected $connection = 'users';

	protected $table = 'permissions';

	protected $fillable = ['name', 'display_name'];

}