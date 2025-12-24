<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\DiagnosticCenter;
use App\Models\Upazila;
use Illuminate\Database\Seeder;

class DiagnosticCenterSeeder extends Seeder
{
    public function run(): void
    {
        // ১. লোকেশন ডাটা নিশ্চিত করা (Dhaka Division & Districts)
        $division = Division::firstOrCreate(['name' => 'Dhaka'], ['bn_name' => 'ঢাকা']);
        $district = District::firstOrCreate(
            ['division_id' => $division->id, 'name' => 'Dhaka'],
            ['bn_name' => 'ঢাকা']
        );

        $upazilaDhanmondi = Upazila::firstOrCreate(['district_id' => $district->id, 'name' => 'Dhanmondi'], ['bn_name' => 'ধানমন্ডি']);
        $upazilaUttara = Upazila::firstOrCreate(['district_id' => $district->id, 'name' => 'Uttara'], ['bn_name' => 'উত্তরা']);

        $area32 = Area::firstOrCreate(['upazila_id' => $upazilaDhanmondi->id, 'name' => 'Dhanmondi 32'], ['bn_name' => 'ধানমন্ডি ৩২']);
        $areaSector7 = Area::firstOrCreate(['upazila_id' => $upazilaUttara->id, 'name' => 'Sector 7'], ['bn_name' => 'সেক্টর ৭']);
        // ২. ডায়াগনস্টিক সেন্টারের ডাটা
        $centers = [
            [
                'name_en' => 'Trust Pathological Center',
                'name_bn' => 'ট্রাস্ট প্যাথলজিক্যাল সেন্টার',
                'division_id' => $division->id,
                'district_id' => $district->id,
                'upazila_id' => $upazilaDhanmondi->id,
                'area_id' => $area32->id,
                'address_en' => 'Road 32, Dhanmondi, Dhaka',
                'address_bn' => 'রোড ৩২, ধানমন্ডি, ঢাকা',
                'phone' => '01711000111',
                'discount_badge_en' => 'Up to 50% Off',
                'discount_badge_bn' => '৫০% পর্যন্ত ছাড়',
                'test_list' => ['CBC', 'RBS', 'CRP & CRS Test', 'Lipid Profile', 'Liver Function'],
                'sort_order' => 1,
            ],
            [
                'name_en' => 'City Diagnostic Complex',
                'name_bn' => 'সিটি ডায়াগনস্টিক কমপ্লেক্স',
                'division_id' => $division->id,
                'district_id' => $district->id,
                'upazila_id' => $upazilaUttara->id,
                'area_id' => $areaSector7->id,
                'address_en' => 'Sector 7, Uttara, Dhaka',
                'address_bn' => 'সেক্টর ৭, উত্তরা, ঢাকা',
                'phone' => '01811000222',
                'discount_badge_en' => '30% Off',
                'discount_badge_bn' => '৩০% ছাড়',
                'test_list' => ['Thyroid Profile', 'Testosterone Test', 'Insulin Level', 'Vitamin D3'],
                'sort_order' => 2,
            ],
            [
                'name_en' => 'Modern Digital Lab',
                'name_bn' => 'মডার্ন ডিজিটাল ল্যাব',
                'division_id' => $division->id,
                'district_id' => $district->id,
                'upazila_id' => $upazilaDhanmondi->id,
                'area_id' => null,
                'address_en' => 'Mirpur Road, Dhanmondi, Dhaka',
                'address_bn' => 'মিরপুর রোড, ধানমন্ডি, ঢাকা',
                'phone' => '01911000333',
                'discount_badge_en' => '20% - 30% Off',
                'discount_badge_bn' => '২০% – ৩০% ছাড়',
                'test_list' => ['Serum Creatinine', 'SGPT / SGOT', 'Bilirubin Test', 'Electrolytes'],
                'sort_order' => 3,
            ],
            [
                'name_en' => 'Imaging Care & X-Ray',
                'name_bn' => 'ইমেজিং কেয়ার এন্ড এক্স-রে',
                'division_id' => $division->id,
                'district_id' => $district->id,
                'upazila_id' => $upazilaUttara->id,
                'area_id' => $areaSector7->id,
                'address_en' => 'Uttara, Dhaka',
                'address_bn' => 'উত্তরা, ঢাকা',
                'phone' => '01511000444',
                'discount_badge_en' => '20% Off',
                'discount_badge_bn' => '২০% ছাড়',
                'test_list' => ['Digital X-Ray', 'Ultrasonography (USG)', 'ECG (Heart)', 'CT Scan Support'],
                'sort_order' => 4,
            ],
            [
                'name_en' => 'National Health Checkup',
                'name_bn' => 'ন্যাশনাল হেলথ চেকআপ',
                'division_id' => $division->id,
                'district_id' => $district->id,
                'upazila_id' => $upazilaDhanmondi->id,
                'area_id' => $area32->id,
                'address_en' => 'Dhanmondi, Dhaka',
                'address_bn' => 'ধানমন্ডি, ঢাকা',
                'phone' => '01611000555',
                'discount_badge_en' => 'Special Package',
                'discount_badge_bn' => 'স্পেশাল প্যাকেজ',
                'test_list' => ['Full Body Checkup', 'Diabetes Checkup', 'Heart & Lung', 'Kidney Profile'],
                'sort_order' => 5,
            ]
        ];

        foreach ($centers as $center) {
            DiagnosticCenter::create($center);
        }
    }
}
