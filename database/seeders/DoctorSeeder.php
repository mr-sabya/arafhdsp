<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        // ১. আগে কিছু ডিপার্টমেন্ট তৈরি বা নিশ্চিত করা (যদি আগে থেকে না থাকে)
        $medicine = Department::firstOrCreate(
            ['name_en' => 'Medicine'],
            ['name_bn' => 'মেডিসিন', 'icon' => 'fas fa-pills', 'status' => 1]
        );

        $cardiology = Department::firstOrCreate(
            ['name_en' => 'Cardiology'],
            ['name_bn' => 'কার্ডিওলজি', 'icon' => 'fas fa-heartbeat', 'status' => 1]
        );

        $gynae = Department::firstOrCreate(
            ['name_en' => 'Gynecology'],
            ['name_bn' => 'গাইনি ও প্রসূতি', 'icon' => 'fas fa-female', 'status' => 1]
        );

        $ortho = Department::firstOrCreate(
            ['name_en' => 'Orthopedics'],
            ['name_bn' => 'হাড় ও জয়েন্ট', 'icon' => 'fas fa-bone', 'status' => 1]
        );

        // ২. ডাক্তারদের ডাটা ইনসার্ট করা
        $doctors = [
            [
                'department_id' => $medicine->id,
                'name_en' => 'Dr. Rafiqul Islam',
                'name_bn' => 'ডাঃ রফিকুল ইসলাম',
                'degree_en' => 'MBBS, FCPS (Medicine)',
                'degree_bn' => 'এমবিবিএস, এফসিপিএস (মেডিসিন)',
                'designation_en' => 'Medicine Specialist',
                'designation_bn' => 'মেডিসিন বিশেষজ্ঞ',
                'base_fee' => 1000,
                'discount_percentage' => 30,
                'appointment_number' => '01711000000',
                'bio_bn' => 'দীর্ঘ ১০ বছরের অভিজ্ঞতা সম্পন্ন মেডিসিন বিশেষজ্ঞ।',
                'bio_en' => 'Medicine specialist with over 10 years of experience.',
                'sort_order' => 1,
            ],
            [
                'department_id' => $gynae->id,
                'name_en' => 'Dr. Nusrat Jahan',
                'name_bn' => 'ডাঃ নুসরাত জাহান',
                'degree_en' => 'MBBS, DGO (Gynae)',
                'degree_bn' => 'এমবিবিএস, ডিজিও (গাইনি)',
                'designation_en' => 'Gynae & Obstetrics',
                'designation_bn' => 'গাইনি ও প্রসূতি বিশেষজ্ঞ',
                'base_fee' => 800,
                'discount_percentage' => 20,
                'appointment_number' => '01811000000',
                'bio_bn' => 'নারী ও প্রসূতি রোগীদের চিকিৎসায় বিশেষ পারদর্শী।',
                'bio_en' => 'Expert in treating female and obstetric patients.',
                'sort_order' => 2,
            ],
            [
                'department_id' => $ortho->id,
                'name_en' => 'Dr. Abrar Ahmed',
                'name_bn' => 'ডাঃ আবরার আহমেদ',
                'degree_en' => 'MBBS, MS (Ortho)',
                'degree_bn' => 'এমবিবিএস, এমএস (অর্থো)',
                'designation_en' => 'Orthopedic Surgeon',
                'designation_bn' => 'হাড় ও জয়েন্ট বিশেষজ্ঞ',
                'base_fee' => 1200,
                'discount_percentage' => 20,
                'appointment_number' => '01911000000',
                'bio_bn' => 'জটিল হাড়ের অপারেশন ও জয়েন্ট পেইন চিকিৎসায় অভিজ্ঞ।',
                'bio_en' => 'Experienced in complex bone surgeries and joint pain treatments.',
                'sort_order' => 3,
            ],
            [
                'department_id' => $medicine->id,
                'name_en' => 'Dr. Anisur Rahman',
                'name_bn' => 'ডাঃ আনিসুর রহমান',
                'degree_en' => 'MBBS, FCPS (Surgery)',
                'degree_bn' => 'এমবিবিএস, এফসিপিএস (সার্জারি)',
                'designation_en' => 'General Surgeon',
                'designation_bn' => 'জেনারেল সার্জারি বিশেষজ্ঞ',
                'base_fee' => 1000,
                'discount_percentage' => 30,
                'appointment_number' => '01511000000',
                'bio_bn' => 'দক্ষ সার্জন এবং জেনারেল মেডিসিন বিশেষজ্ঞ।',
                'bio_en' => 'Skilled surgeon and general medicine specialist.',
                'sort_order' => 4,
            ]
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
