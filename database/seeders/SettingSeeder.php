<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'who_us',
                'value' => json_encode(['en' => 'We are a company dedicated to excellence.', 'ar' => 'نحن شركة مكرسة للتميز.'])
            ],
            [
                'key' => 'commission_details',
                'value' => json_encode(['en' => 'Commission is applied on all sales.', 'ar' => 'يتم تطبيق العمولة على جميع المبيعات.'])
            ],[
                'key' => 'commission_value',
                'value' => json_encode(['en' => .1, 'ar' => .1])
            ],
            [
                'key' => 'alahly_account_number',
                'value' => json_encode(['en' => '1234567890', 'ar' => '١٢٣٤٥٦٧٨٩٠'])
            ],
            [
                'key' => 'alraghy_account_number',
                'value' => json_encode(['en' => '0987654321', 'ar' => '٠٩٨٧٦٥٤٣٢١'])
            ],
        ];

        Setting::query()->upsert($settings, ['key'],['value']);

    }
}
