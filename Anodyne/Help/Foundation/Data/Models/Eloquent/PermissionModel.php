<?php namespace Help\Foundation\Data\Models\Eloquent;

use Zizaco\Entrust\EntrustPermission;

class PermissionModel extends EntrustPermission {

	protected $connection = 'anodyneUsers';

	protected $table = 'permissions';

	protected $fillable = ['name', 'display_name'];

}