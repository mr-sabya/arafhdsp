<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            ['name' => 'A+',  'slug' => 'a-positive', 'bn_name' => 'এ পজিটিভ'],
            ['name' => 'A-',  'slug' => 'a-negative', 'bn_name' => 'এ নেগেটিভ'],
            ['name' => 'B+',  'slug' => 'b-positive', 'bn_name' => 'বি পজিটিভ'],
            ['name' => 'B-',  'slug' => 'b-negative', 'bn_name' => 'বি নেগেটিভ'],
            ['name' => 'O+',  'slug' => 'o-positive', 'bn_name' => 'ও পজিটিভ'],
            ['name' => 'O-',  'slug' => 'o-negative', 'bn_name' => 'ও নেগেটিভ'],
            ['name' => 'AB+', 'slug' => 'ab-positive', 'bn_name' => 'এবি পজিটিভ'],
            ['name' => 'AB-', 'slug' => 'ab-negative', 'bn_name' => 'এবি নেগেটিভ'],
        ];

        foreach ($groups as $group) {
            BloodGroup::updateOrCreate(
                ['slug' => $group['slug']], // Use slug as the unique identifier check
                [
                    'name' => $group['name'],
                    'bn_name' => $group['bn_name'],
                ]
            );
        }
    }
}
