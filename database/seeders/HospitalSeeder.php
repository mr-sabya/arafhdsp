<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\Hospital;
use App\Models\Upazila;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    public function run(): void
    {
        // ১. লোকেশন ডাটা সেটআপ (যদি ডাটাবেসে না থাকে তবে তৈরি হবে)
        $division = Division::firstOrCreate(['name' => 'Dhaka'], ['bn_name' => 'ঢাকা']);

        $district = District::firstOrCreate(
            ['division_id' => $division->id, 'name' => 'Dhaka'],
            ['bn_name' => 'ঢাকা']
        );

        $upazilaDhanmondi = Upazila::firstOrCreate(
            ['district_id' => $district->id, 'name' => 'Dhanmondi'],
            ['bn_name' => 'ধানমন্ডি']
        );

        $upazilaUttara = Upazila::firstOrCreate(
            ['district_id' => $district->id, 'name' => 'Uttara'],
            ['bn_name' => 'উত্তরা']
        );

        $areaDhanmondi = Area::firstOrCreate(
            ['upazila_id' => $upazilaDhanmondi->id, 'name' => 'Dhanmondi 32'],
            ['bn_name' => 'ধানমন্ডি ৩২']
        );

        $areaUttara = Area::firstOrCreate(
            ['upazila_id' => $upazilaUttara->id, 'name' => 'Sector 7'],
            ['bn_name' => 'সেক্টর ৭']
        );

        // ২. হাসপাতালের ডাটা অ্যারয়
        $hospitals = [
            [
                'name_en' => 'City General Hospital',
                'name_bn' => 'সিটি জেনারেল হাসপাতাল',
                'address_en' => 'Road 32, Dhanmondi, Dhaka',
                'address_bn' => 'রোড ৩২, ধানমন্ডি, ঢাকা',
                'phone' => '01711223344',
                'division_id' => $division->id,
                'district_id' => $district->id,
                'upazila_id' => $upazilaDhanmondi->id,
                'area_id' => $areaDhanmondi->id,
                'benefits' => [
                    ['text_en' => 'Cabin: 20% Off', 'text_bn' => 'কেবিন: ২০% ছাড়', 'class' => 'bg-info text-dark'],
                    ['text_en' => 'Tests: 30% Off', 'text_bn' => 'টেস্ট: ৩০% ছাড়', 'class' => 'bg-secondary'],
                ],
                'sort_order' => 1,
                'status' => 1,
            ],
            [
                'name_en' => 'Uttara Modern Clinic',
                'name_bn' => 'উত্তরা মডার্ন ক্লিনিক',
                'address_en' => 'Sector 7, Uttara, Dhaka',
                'address_bn' => 'সেক্টর ৭, উত্তরা, ঢাকা',
                'phone' => '01855667788',
                'division_id' => $division->id,
                'district_id' => $district->id,
                'upazila_id' => $upazilaUttara->id,
                'area_id' => $areaUttara->id,
                'benefits' => [
                    ['text_en' => 'Surgery: 10% Off', 'text_bn' => 'সার্জারি: ১০% ছাড়', 'class' => 'bg-info text-dark'],
                    ['text_en' => '24/7 Emergency', 'text_bn' => '২৪/৭ ইমার্জেন্সি', 'class' => 'bg-danger'],
                ],
                'sort_order' => 2,
                'status' => 1,
            ],
            [
                'name_en' => 'Popular Diagnostic Center',
                'name_bn' => 'পপুলার ডায়াগনস্টিক সেন্টার',
                'address_en' => 'Dhanmondi 2, Dhaka',
                'address_bn' => 'ধানমন্ডি ২, ঢাকা',
                'phone' => '09613787801',
                'division_id' => $division->id,
                'district_id' => $district->id,
                'upazila_id' => $upazilaDhanmondi->id,
                'area_id' => null, // এরিয়া না থাকলে নাল হতে পারে
                'benefits' => [
                    ['text_en' => 'Reports: 15% Off', 'text_bn' => 'রিপোর্ট: ১৫% ছাড়', 'class' => 'bg-primary'],
                ],
                'sort_order' => 3,
                'status' => 1,
            ]
        ];

        // ৩. লুপ চালিয়ে ডাটা ইনসার্ট করা
        foreach ($hospitals as $data) {
            Hospital::create($data);
        }
    }
}
