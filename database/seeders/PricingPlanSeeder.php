<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricingPlan;

class PricingPlanSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data to avoid duplicates
        PricingPlan::truncate();

        $plans = [
            [
                'name' => 'সাধারণ',
                'level_text' => 'লেভেল ১',
                'price' => 100,
                'is_featured' => false,
                'ribbon_text' => null,
                'sort_order' => 1,
                'features' => [
                    ['text' => 'প্রাথমিক চিকিৎসা সুবিধা', 'available' => true],
                    ['text' => 'ওষুধে ১০% ছাড়', 'available' => true],
                    ['text' => 'হেলথ টিপস ও পরামর্শ', 'available' => true],
                    ['text' => 'বিশেষ ডাক্তার সুবিধা নেই', 'available' => false],
                ],
            ],
            [
                'name' => 'ফ্যামিলি / বিশেষ',
                'level_text' => 'লেভেল ২',
                'price' => 200,
                'is_featured' => true,
                'ribbon_text' => 'সেরা পছন্দ',
                'sort_order' => 2,
                'features' => [
                    ['text' => '২ জন সদস্য / পরিবার', 'available' => true],
                    ['text' => 'বিশেষজ্ঞ ডাক্তার পরামর্শ', 'available' => true],
                    ['text' => 'টেস্টে ২০% পর্যন্ত ছাড়', 'available' => true],
                    ['text' => 'ওষুধে ২০% ছাড়', 'available' => true],
                    ['text' => 'বড় অপারেশন সহায়তা নেই', 'available' => false],
                ],
            ],
            [
                'name' => 'মেডিকেল',
                'level_text' => 'লেভেল ৩',
                'price' => 300,
                'is_featured' => false,
                'ribbon_text' => null,
                'sort_order' => 3,
                'features' => [
                    ['text' => '১০ জনের গ্রুপ সুবিধা', 'available' => true],
                    ['text' => 'জরুরি চিকিৎসা সেবা', 'available' => true],
                    ['text' => 'ল্যাব টেস্টে ৫০% ছাড়', 'available' => true],
                    ['text' => 'হরমোন ও ভিটামিন টেস্ট', 'available' => true],
                    ['text' => 'অগ্রাধিকার ভিত্তিতে সেবা নেই', 'available' => false],
                ],
            ],
            [
                'name' => 'সার্জারি',
                'level_text' => 'সাপোর্ট',
                'price' => 500,
                'is_featured' => false,
                'ribbon_text' => null,
                'sort_order' => 4,
                'features' => [
                    ['text' => 'বড় অপারেশন সহায়তা', 'available' => true],
                    ['text' => 'হাসপাতাল কেবিন সুবিধা', 'available' => true],
                    ['text' => '৩০% স্পেশাল ডিসকাউন্ট', 'available' => true],
                    ['text' => 'অগ্রাধিকার ভিত্তিতে সেবা', 'available' => true],
                ],
            ],
        ];

        foreach ($plans as $plan) {
            PricingPlan::create($plan);
        }
    }
}
