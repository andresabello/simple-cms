<?php

namespace Piboutique\SimpleCMS\Database\Seeds;

use Illuminate\Database\Seeder;
use Piboutique\SimpleCMS\Models\ThemeOptions;

/**
 * Class RolePermissionSeeder
 * @package Piboutique\SimpleCMS\Database\Seeds
 */
class ThemeOptionsSeeder extends Seeder
{

    /**
     *
     */
    public function run()
    {
        ThemeOptions::create([
            'name' => 'Logo',
            'type' => 'image',
            'value' => null
        ]);

        ThemeOptions::create([
            'name' => 'Font Family',
            'type' => 'select',
            'value' => null
        ]);

        ThemeOptions::create([
            'name' => 'Primary Color',
            'type' => 'color',
            'value' => null
        ]);

        ThemeOptions::create([
            'name' => 'Secondary Color',
            'type' => 'color',
            'value' => null
        ]);

        ThemeOptions::create([
            'name' => 'Google Analytics Script',
            'type' => 'textarea',
            'value' => null
        ]);

        ThemeOptions::create([
            'name' => 'Google Analytics HTML',
            'type' => 'textarea',
            'value' => null
        ]);
    }
}