<?php

namespace Piboutique\SimpleCMS\Database\Seeds;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RolePermissionSeeder
 * @package Piboutique\SimpleCMS\Database\Seeds
 */
class RolePermissionSeeder extends Seeder
{

    public function run()
    {
        $admin = Role::where('name', 'admin')->first();
        if (!$admin) {
            $admin = Role::create(['name' => 'admin']);
        }

        $editor = Role::where('name', 'editor')->first();
        if (!$editor) {
            $editor = Role::create(['name' => 'editor']);
        }


        $author = Role::where('name', 'author')->first();
        if (!$author) {
            $author = Role::create(['name' => 'author']);
        }

        $contributor = Role::where('name', 'contributor')->first();
        if (!$contributor) {
            $contributor = Role::create(['name' => 'contributor']);
        }


        $subscriber = Role::where('name', 'subscriber')->first();
        if (!$subscriber) {
            $subscriber = Role::create(['name' => 'subscriber']);
        }

        $deletePages = Permission::create(['name' => 'delete_pages']);
        $editPages = Permission::create(['name' => 'edit_pages']);
        $deletePosts = Permission::create(['name' => 'delete_posts']);
        $editPosts = Permission::create(['name' => 'edit_posts']);
        $deleteItems = Permission::create(['name' => 'delete_items']);
        $editItems = Permission::create(['name' => 'edit_items']);
        $editDashboard = Permission::create(['name' => 'edit_dashboard']);
        $editThemeOptions = Permission::create(['name' => 'edit_theme_options']);
        $moderateComments = Permission::create(['name' => 'moderate_comments']);
        $promoteUsers = Permission::create(['name' => 'promote_users']);
        $publishPages = Permission::create(['name' => 'publish_pages']);
        $publishPosts = Permission::create(['name' => 'publish_posts']);
        $publishItems = Permission::create(['name' => 'publish_items']);
        $removeUsers = Permission::create(['name' => 'remove_users']);
        $switchThemes = Permission::create(['name' => 'switch_themes']);
        $addUsers = Permission::create(['name' => 'add_users']);
        $editUsers = Permission::create(['name' => 'edit_users']);
        $createUsers = Permission::create(['name' => 'create_users']);
        $deleteUsers = Permission::create(['name' => 'delete_users']);
        $addImages = Permission::create(['name' => 'add_images']);
        $editImages = Permission::create(['name' => 'edit_images']);
        $createImages = Permission::create(['name' => 'create_images']);
        $deleteImages = Permission::create(['name' => 'delete_images']);

        $admin->givePermissionTo($deletePages);
        $admin->givePermissionTo($editPages);
        $admin->givePermissionTo($deletePosts);
        $admin->givePermissionTo($editPosts);
        $admin->givePermissionTo($deleteItems);
        $admin->givePermissionTo($editItems);
        $admin->givePermissionTo($editDashboard);
        $admin->givePermissionTo($editThemeOptions);
        $admin->givePermissionTo($moderateComments);
        $admin->givePermissionTo($promoteUsers);
        $admin->givePermissionTo($publishPages);
        $admin->givePermissionTo($publishPosts);
        $admin->givePermissionTo($publishItems);
        $admin->givePermissionTo($removeUsers);
        $admin->givePermissionTo($switchThemes);
        $admin->givePermissionTo($addUsers);
        $admin->givePermissionTo($editUsers);
        $admin->givePermissionTo($createUsers);
        $admin->givePermissionTo($deleteUsers);
        $admin->givePermissionTo($addImages);
        $admin->givePermissionTo($editImages);
        $admin->givePermissionTo($createImages);
        $admin->givePermissionTo($deleteImages);

        $editor->givePermissionTo($deletePages);
        $editor->givePermissionTo($deletePosts);
        $editor->givePermissionTo($deleteItems);
        $editor->givePermissionTo($editPages);
        $editor->givePermissionTo($editPosts);
        $editor->givePermissionTo($editItems);
        $editor->givePermissionTo($editImages);
        $editor->givePermissionTo($moderateComments);
        $editor->givePermissionTo($publishPages);
        $editor->givePermissionTo($publishPosts);
        $editor->givePermissionTo($publishItems);
        $editor->givePermissionTo($addImages);
        $editor->givePermissionTo($createImages);
        $editor->givePermissionTo($deleteImages);

        $author->givePermissionTo($addImages);
        $author->givePermissionTo($publishPages);
        $author->givePermissionTo($publishPosts);
        $author->givePermissionTo($publishItems);
        $author->givePermissionTo($editPages);
        $author->givePermissionTo($editPosts);
        $author->givePermissionTo($editItems);
        $author->givePermissionTo($editImages);
        $author->givePermissionTo($deletePages);
        $author->givePermissionTo($deletePosts);
        $author->givePermissionTo($deleteItems);
        $author->givePermissionTo($deleteImages);

        $contributor->givePermissionTo($editPages);
        $contributor->givePermissionTo($editPosts);
        $contributor->givePermissionTo($editItems);
        $contributor->givePermissionTo($editImages);
        $contributor->givePermissionTo($deletePages);
        $contributor->givePermissionTo($deletePosts);
        $contributor->givePermissionTo($deleteItems);
        $contributor->givePermissionTo($deleteImages);
    }
}