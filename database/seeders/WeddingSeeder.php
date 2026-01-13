<?php

namespace Database\Seeders;

use App\Models\Gift;
use App\Models\Guest;
use App\Models\Wedding;
use App\Models\Wish;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WeddingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample wedding
        $wedding = Wedding::create([
            'slug' => 'alwi-anti',
            'groom_short_name' => 'Alwi',
            'groom_name' => 'Alwi Wahyudi',
            'groom_father' => 'Suwardi',
            'groom_mother' => 'Iis Fatimah',
            'bride_short_name' => 'Anti',
            'bride_name' => 'Anti Suryani',
            'bride_father' => 'Idin',
            'bride_mother' => 'Aminah',
            'akad_date' => '2026-01-23',
            'akad_start' => '08:00:00',
            'akad_end' => '11:00:00',
            'akad_location' => 'KUA Long Ikis, Kab. Paser',
            'reception_date' => '2026-01-25',
            'reception_start' => '10:00:00',
            'reception_end' => '22:00:00    ',
            'reception_location' => 'Ds. Tajur Blok E, RT. 04, Kec. Long Ikis, Kab. Paser (Kediaman Mempelai Wanita)',
            'theme' => 'elegant-gold',
        ]);

        // Add gift information
        Gift::create([
            'wedding_id' => $wedding->id,
            'bank_name' => 'Mandiri',
            'account_name' => 'Alwi Wahyudi',
            'account_number' => '1490019611591',
        ]);

        Gift::create([
            'wedding_id' => $wedding->id,
            'bank_name' => 'Bank Mandiri',
            'account_name' => 'Anti Suryani',
            'account_number' => '1490020751238',
        ]);

        $this->command->info('Wedding seeded successfully!');
        $this->command->info('---');
        $this->command->info("Wedding slug: {$wedding->slug}");
        $this->command->info("Invitation link: /inv/{$wedding->slug}");
        $this->command->info('');
        $this->command->info('Sample guest UUID for RSVP:');
        $this->command->info("RSVP link: /inv/{$wedding->slug}");
    }
}
