<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class KhulnaLocationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Disable Foreign Key Constraints to allow Truncate
        Schema::disableForeignKeyConstraints();
        Area::truncate();
        Upazila::truncate();
        District::truncate();
        Division::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Create Khulna Division
        $khulnaDivision = Division::create(['name' => 'Khulna', 'bn_name' => 'খুলনা']);

        // 3. Define Districts Data
        $districts = [
            'Bagerhat' => ['bn' => 'বাগেরহাট', 'upazilas' => [
                'Bagerhat Sadar' => 'বাগেরহাট সদর',
                'Chitalmari' => 'চিতলমারী',
                'Fakirhat' => 'ফকিরহাট',
                'Kachua' => 'কচুয়া',
                'Mollahat' => 'মোল্লাহাট',
                'Mongla' => 'মোংলা',
                'Morrelganj' => 'মোড়েলগঞ্জ',
                'Rampal' => 'রামপাল',
                'Sarankhola' => 'শরণখোলা'
            ]],
            'Chuadanga' => ['bn' => 'চুয়াডাঙ্গা', 'upazilas' => [
                'Chuadanga Sadar' => 'চুয়াডাঙ্গা সদর',
                'Alamdanga' => 'আলমডাঙ্গা',
                'Damurhuda' => 'দামুড়হুদা',
                'Jibannagar' => 'জীবননগর'
            ]],
            'Jashore' => ['bn' => 'যশোর', 'upazilas' => [
                'Jashore Sadar' => 'যশোর সদর',
                'Abhaynagar' => 'অভয়নগর',
                'Bagherpara' => 'বাঘেরপাড়া',
                'Chaugachha' => 'চৌগাছা',
                'Jhikargachha' => 'ঝিকরগাছা',
                'Keshabpur' => 'কেশবপুর',
                'Manirampur' => 'মণিরামপুর',
                'Sharsha' => 'শার্শা'
            ]],
            'Jhenaidah' => ['bn' => 'ঝিনাইদহ', 'upazilas' => [
                'Jhenaidah Sadar' => 'ঝিনাইদহ সদর',
                'Maheshpur' => 'মহেশপুর',
                'Kaliganj' => 'কালীগঞ্জ',
                'Kotchandpur' => 'কোটচাঁদপুর',
                'Shailkupa' => 'শৈলকুপা',
                'Harinakunda' => 'হরিণাকুণ্ডু'
            ]],
            'Khulna' => ['bn' => 'খুলনা', 'upazilas' => [
                'Batiaghata' => 'বটিয়াঘাটা',
                'Dacope' => 'দাকোপ',
                'Dighalia' => 'দিঘলিয়া',
                'Dumuria' => 'ডুমুরিয়া',
                'Koyra' => 'কয়রা',
                'Paikgachha' => 'পাইকগাছা',
                'Phultala' => 'ফুলতলা',
                'Rupsa' => 'রূপসা',
                'Terokhada' => 'তেরখাদা'
            ]],
            'Kushtia' => ['bn' => 'কুষ্টিয়া', 'upazilas' => [
                'Bheramara' => 'ভেড়ামারা',
                'Daulatpur' => 'দৌলতপুর',
                'Khoksa' => 'খোকসা',
                'Kumarkhali' => 'কুমারখালী',
                'Kushtia Sadar' => 'কুষ্টিয়া সদর',
                'Mirpur' => 'মিরপুর'
            ]],
            'Magura' => ['bn' => 'মাগুরা', 'upazilas' => [
                'Magura Sadar' => 'মাগুরা সদর',
                'Mohammadpur' => 'মহম্মদপুর',
                'Shalikha' => 'শালিখা',
                'Sreepur' => 'শ্রীপুর'
            ]],
            'Meherpur' => ['bn' => 'মেহেরপুর', 'upazilas' => [
                'Meherpur Sadar' => 'মেহেরপুর সদর',
                'Gangni' => 'গাংনী',
                'Mujibnagar' => 'মুজিবনগর'
            ]],
            'Narail' => ['bn' => 'নড়াইল', 'upazilas' => [
                'Narail Sadar' => 'নড়াইল সদর',
                'Kalia' => 'কালিয়া',
                'Lohagara' => 'লোহাগড়া'
            ]],
            'Satkhira' => ['bn' => 'সাতক্ষীরা', 'upazilas' => [
                'Satkhira Sadar' => 'সাতক্ষীরা সদর',
                'Assasuni' => 'আশাশুনি',
                'Debhata' => 'দেবহাটা',
                'Kalaroa' => 'কলারোয়া',
                'Kaliganj' => 'কালিগঞ্জ',
                'Shyamnagar' => 'শ্যামনগর',
                'Tala' => 'তালা'
            ]],
        ];

        // 4. Define Area (Union) Data for Khulna District (Sample)
        $unionsData = [
            'Batiaghata' => [
                ['name' => 'Amirpur', 'bn' => 'আমিরপুর', 'zip' => '9210'],
                ['name' => 'Batiaghata', 'bn' => 'বটিয়াঘাটা', 'zip' => '9210'],
                ['name' => 'Surkhali', 'bn' => 'সুরখালী', 'zip' => '9210'],
                ['name' => 'Jalma', 'bn' => 'জলমা', 'zip' => '9210'],
            ],
            'Rupsa' => [
                ['name' => 'Aichgati', 'bn' => 'আইচগাতি', 'zip' => '9240'],
                ['name' => 'Sreefaltala', 'bn' => 'শ্রীফলতলা', 'zip' => '9240'],
                ['name' => 'Naihati', 'bn' => 'নৈহাটী', 'zip' => '9240'],
            ],
            'Dumuria' => [
                ['name' => 'Dumuria', 'bn' => 'ডুমুরিয়া', 'zip' => '9250'],
                ['name' => 'Sahos', 'bn' => 'সাহস', 'zip' => '9250'],
                ['name' => 'Gutudia', 'bn' => 'গুটুদিয়া', 'zip' => '9250'],
            ],
            'Phultala' => [
                ['name' => 'Phultala', 'bn' => 'ফুলতলা', 'zip' => '9210'],
                ['name' => 'Damodar', 'bn' => 'দামোদর', 'zip' => '9210'],
            ]
        ];

        // 5. Execution Loop
        foreach ($districts as $distName => $distInfo) {
            $district = District::create([
                'division_id' => $khulnaDivision->id,
                'name' => $distName,
                'bn_name' => $distInfo['bn']
            ]);

            foreach ($distInfo['upazilas'] as $upaName => $upaBn) {
                $upazila = Upazila::create([
                    'district_id' => $district->id,
                    'name' => $upaName,
                    'bn_name' => $upaBn
                ]);

                // Create Unions if data exists for this upazila
                if (isset($unionsData[$upaName])) {
                    foreach ($unionsData[$upaName] as $union) {
                        Area::create([
                            'upazila_id' => $upazila->id,
                            'name' => $union['name'],
                            'bn_name' => $union['bn'],
                            'post_code' => $union['zip']
                        ]);
                    }
                }
            }
        }
    }
}
