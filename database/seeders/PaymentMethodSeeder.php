<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Schema;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to safely truncate
        Schema::disableForeignKeyConstraints();
        PaymentMethod::truncate();
        Schema::enableForeignKeyConstraints();

        $methods = [
            [
                'name' => 'Bkash Personal',
                'slug' => 'bkash-personal',
                'type' => 'manual',
                'account_number' => '01700000000',
                'qr_code' => 'payments/bkash_qr.png', // Ensure this image exists in storage/app/public/
                'instruction' => 'বিকাশ অ্যাপ বা *২৪৭# ডায়াল করে আমাদের পার্সোনাল নাম্বারে "Send Money" করুন। সফলভাবে টাকা পাঠানোর পর ট্রানজেকশন আইডিটি (TxID) নিচের বক্সে দিন।',
                'driver' => null,
                'config' => null,
                'status' => 1,
                'sort_order' => 1,
            ],
            [
                'name' => 'Nagad Personal',
                'slug' => 'nagad-personal',
                'type' => 'manual',
                'account_number' => '01800000000',
                'qr_code' => 'payments/nagad_qr.png',
                'instruction' => 'নগদ অ্যাপ বা *১৬৭# ডায়াল করে আমাদের পার্সোনাল নাম্বারে "Send Money" করুন। সফলভাবে টাকা পাঠানোর পর ট্রানজেকশন আইডিটি নিচের বক্সে দিন।',
                'driver' => null,
                'config' => null,
                'status' => 1,
                'sort_order' => 2,
            ],
            [
                'name' => 'Rocket Personal',
                'slug' => 'rocket-personal',
                'type' => 'manual',
                'account_number' => '01900000000-1',
                'qr_code' => null,
                'instruction' => 'রকেট অ্যাপ বা *৩২২# ডায়াল করে আমাদের পার্সোনাল নাম্বারে "Send Money" করুন। সফলভাবে টাকা পাঠানোর পর ট্রানজেকশন আইডিটি নিচের বক্সে দিন।',
                'driver' => null,
                'config' => null,
                'status' => 1,
                'sort_order' => 3,
            ],
            [
                'name' => 'Online Payment (PayCheckout)',
                'slug' => 'paycheckout',
                'type' => 'gateway',
                'account_number' => null,
                'qr_code' => null,
                'instruction' => 'বিকাশ, নগদ, রকেট বা কার্ডের মাধ্যমে অটোমেটিক পেমেন্ট করতে এটি বাছাই করুন।',
                'driver' => 'paycheckout',
                'config' => [
                    'api_key' => 'PC_LIVE_XXXXX',
                    'api_secret' => 'PC_SEC_YYYYY',
                    'mode' => 'sandbox', // Use 'live' for production
                ],
                'status' => 1,
                'sort_order' => 4,
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}
