<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create(['name_en' => 'Medicine', 'name_bn' => 'মেডিসিন', 'icon' => 'fas fa-pills']);
        Department::create(['name_en' => 'Cardiology', 'name_bn' => 'কার্ডিওলজি', 'icon' => 'fas fa-heartbeat']);
        Department::create(['name_en' => 'Pediatrics', 'name_bn' => 'শিশু বিশেষজ্ঞ', 'icon' => 'fas fa-baby']);
    }
}
