<?php

class RoleSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$permissions = [
			['name' => 'help.article.create', 'display_name' => 'Create Help Article'],
			['name' => 'help.article.edit', 'display_name' => 'Edit Help Articles'],
			['name' => 'help.article.delete', 'display_name' => 'Delete Help Article'],
			['name' => 'help.admin', 'display_name' => 'Help Center Admin'],
		];

		$permissionIds = [];

		foreach ($permissions as $p)
		{
			$item = PermissionModel::create($p);

			$permissionIds[] = $item->id;
		}

		// Get the admin role and attach the new permissions
		$admin = RoleModel::first();
		$admin->perms()->attach($permissionIds);
	}

}