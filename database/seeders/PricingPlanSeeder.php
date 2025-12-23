<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricingPlan;
use Illuminate\Support\Facades\Schema; // Add this

class PricingPlanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Disable Foreign Key Checks
        Schema::disableForeignKeyConstraints();

        // 2. Clear the table
        PricingPlan::truncate();

        $plans = [
            [
                'name' => 'সাধারণ',
                'level_text' => 'লেভেল ১',
                'price' => 100,
                'pricing_type' => 'fixed',
                'discount_percentage' => 0,
                'pricing_rules' => null,
                'is_featured' => false,
                'ribbon_text' => null,
                'sort_order' => 1,
                'status' => 1,
                'features' => [
                    ['text' => 'প্রাথমিক চিকিৎসা সুবিধা', 'available' => true],
                    ['text' => 'ওষুধে ১০% ছাড়', 'available' => true],
                    ['text' => 'হেলথ টিপস ও পরামর্শ', 'available' => true],
                ],
            ],
            [
                'name' => 'ফ্যামিলি / বিশেষ',
                'level_text' => 'লেভেল ২',
                'price' => 100,
                'pricing_type' => 'per_member',
                'discount_percentage' => 0,
                'pricing_rules' => [
                    'fixed_price_for_5' => 400
                ],
                'is_featured' => true,
                'ribbon_text' => 'সেরা পছন্দ',
                'sort_order' => 2,
                'status' => 1,
                'features' => [
                    ['text' => '৫ জনের পরিবার মাত্র ৪০০ টাকা', 'available' => true],
                    ['text' => 'বিশেষজ্ঞ ডাক্তার পরামর্শ', 'available' => true],
                    ['text' => 'টেস্টে ২০% পর্যন্ত ছাড়', 'available' => true],
                    ['text' => 'ওষুধে ২০% ছাড়', 'available' => true],
                ],
            ],
            [
                'name' => 'মেডিকেল',
                'level_text' => 'লেভেল ৩',
                'price' => 300,
                'pricing_type' => 'fixed',
                'discount_percentage' => 30,
                'pricing_rules' => null,
                'is_featured' => false,
                'ribbon_text' => '৩০% ছাড়',
                'sort_order' => 3,
                'status' => 1,
                'features' => [
                    ['text' => '৩০% ডিসকাউন্টে মাত্র ২ডিও টাকা', 'available' => true],
                    ['text' => 'জরুরি চিকিৎসা সেবা', 'available' => true],
                    ['text' => 'ল্যাব টেস্টে ৫০% ছাড়', 'available' => true],
                    ['text' => 'হরমোন ও ভিটামিন টেস্ট', 'available' => true],
                ],
            ],
            [
                'name' => 'সার্জারি সাপোর্ট',
                'level_text' => 'লেভেল ৪',
                'price' => 500,
                'pricing_type' => 'fixed',
                'discount_percentage' => 0,
                'pricing_rules' => null,
                'is_featured' => false,
                'ribbon_text' => null,
                'sort_order' => 4,
                'status' => 1,
                'features' => [
                    ['text' => 'বড় অপারেশন সহায়তা', 'available' => true],
                    ['text' => 'হাসপাতাল কেবিন সুবিধা', 'available' => true],
                    ['text' => 'অগ্রাধিকার ভিত্তিতে সেবা', 'available' => true],
                ],
            ],
        ];

        foreach ($plans as $plan) {
            PricingPlan::create($plan);
        }

        // 3. Re-enable Foreign Key Checks
        Schema::enableForeignKeyConstraints();
    }
}
