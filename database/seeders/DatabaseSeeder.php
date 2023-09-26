<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Debt;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // CategorySeeder::class,
            // // DetailsSeeder::class,
            // GuestsSeeder::class,
            // // ProductSeeder::class,
            // // productsSeeder::class,
            // ProvidesSeeder::class,
            // // // SerinumbersSeeder::class,
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            LicenseSeeder::class,
            ManagerLicenseSeeder::class,
            // DebtSeeder::class,
            // OrdersSeeder::class,
            // ProductOrderSeeder::class,
            // ExportSeeder::class,
            // productExportSeeder::class,
            // HistorySeeder::class
        ]);
    }
}
