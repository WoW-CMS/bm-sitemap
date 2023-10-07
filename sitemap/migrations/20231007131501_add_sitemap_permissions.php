<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_sitemap_permissions extends CI_Migration
{
    public function up()
    {
        $this->permission_model->insert_batch([
            ['key' => 'add.sitemap', 'module' => 'sitemap', 'description' => 'Can add new sitemap'],
            ['key' => 'edit.sitemap', 'module' => 'sitemap', 'description' => 'Can edit sitemap'],
            ['key' => 'delete.sitemap', 'module' => 'sitemap', 'description' => 'Can delete sitemap']
        ]);

        $permissions = $this->permission_model->find_all(['module' => 'sitemap']);
        $permsLinked = [];

        foreach ($permissions as $permission) {
            if (in_array($permission->key, ['add.sitemap', 'edit.sitemap', 'delete.sitemap'], true)) {
                $permsLinked[] = ['role_id' => '5', 'permission_id' => $permission->id];
            }
        }

        $this->role_permission_model->insert_batch($permsLinked);
    }

    public function down()
    {
        $permissions    = $this->permission_model->find_all(['module' => 'sitemap'], 'array');
        $permissionsIds = array_column($permissions, 'id');

        if ($permissionsIds !== []) {
            $this->permission_model->delete_in('id', $permissionsIds);
        }
    }
}