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
            'slug' => 'john-sarah-2026',
            'groom_name' => 'John Doe',
            'groom_father' => 'Mr. David Doe',
            'groom_mother' => 'Mrs. Margaret Doe',
            'bride_name' => 'Sarah Jane Smith',
            'bride_father' => 'Mr. Robert Smith',
            'bride_mother' => 'Mrs. Elizabeth Smith',
            'akad_date' => now()->addMonth()->setHour(10)->setMinute(0),
            'akad_start' => now()->addMonth()->setHour(10)->setMinute(0),
            'akad_end' => now()->addMonth()->setHour(11)->setMinute(0),
            'akad_location' => 'Masjid Al-Hana, Jalan Imam Bonjol No. 42, Jakarta Pusat',
            'reception_date' => now()->addMonth()->setHour(18)->setMinute(0),
            'reception_start' => now()->addMonth()->setHour(18)->setMinute(0),
            'reception_end' => now()->addMonth()->setHour(22)->setMinute(0),
            'reception_location' => 'Grand Ballroom Hotel, Jalan Merdeka Barat No. 10, Jakarta',
            'theme' => 'elegant-gold',
        ]);

        // Add gift information
        Gift::create([
            'wedding_id' => $wedding->id,
            'bank_name' => 'Bank Central Asia',
            'account_name' => 'John Doe',
            'account_number' => '7265123456',
        ]);

        Gift::create([
            'wedding_id' => $wedding->id,
            'bank_name' => 'Bank Mandiri',
            'account_name' => 'Sarah Jane Smith',
            'account_number' => '1410022334455',
        ]);

        // Create sample guests
        $guestNames = [
            'Ahmad Rahman',
            'Siti Nurhaliza',
            'Budi Santoso',
            'Rina Wijaya',
            'Bambang Irawan',
            'Dewi Lestari',
            'Rudi Hermawan',
            'Anya Kusuma',
            'Yusuf Ibrahim',
            'Mawar Kusuma',
        ];

        foreach ($guestNames as $name) {
            Guest::create([
                'wedding_id' => $wedding->id,
                'uuid' => Str::uuid(),
                'name' => $name,
                'phone' => fake()->phoneNumber(),
                'rsvp_status' => fake()->randomElement(['yes', 'no', 'maybe', null]),
                'total_guest' => fake()->boolean(70) ? fake()->numberBetween(1, 4) : 1,
            ]);
        }

        // Add sample wishes
        $wishMessages = [
            'Congratulations on your wedding! Wishing you a lifetime of happiness together.',
            'May your marriage be filled with love, laughter, and endless joy. Happy wedding day!',
            'Two hearts, one love, one destiny. Best wishes for your beautiful journey together.',
            'Wishing the happy couple a marriage full of love and understanding. Congratulations!',
            'May your love story continue to be as beautiful and inspiring as it is today.',
            'Sending love and best wishes as you start this exciting new chapter together.',
            'What a beautiful day to celebrate your love. Wishing you both all the best!',
        ];

        foreach ($wishMessages as $message) {
            Wish::create([
                'wedding_id' => $wedding->id,
                'guest_name' => fake()->firstName() . ' ' . fake()->lastName(),
                'message' => $message,
            ]);
        }

        $this->command->info('Wedding seeded successfully!');
        $this->command->info('---');
        $this->command->info("Wedding slug: {$wedding->slug}");
        $this->command->info("Invitation link: /inv/{$wedding->slug}");
        $this->command->info('');
        $this->command->info('Sample guest UUID for RSVP:');
        $firstGuest = $wedding->guests()->first();
        $this->command->info("Guest: {$firstGuest->name}");
        $this->command->info("RSVP link: /inv/{$wedding->slug}/{$firstGuest->uuid}");
    }
}
