<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SeedPakistanDefaults extends Command
{
    protected $signature = 'trexfer:seed-pakistan-defaults';
    protected $description = 'Seed Pakistan default data (departments, designations, leave types etc) for all existing companies';

    public function handle()
    {
        $companies = User::where('type', 'company')->get();

        if ($companies->isEmpty()) {
            $this->warn('No company accounts found.');
            return;
        }

        $this->info("Found {$companies->count()} company account(s). Seeding Pakistan defaults...");

        foreach ($companies as $company) {
            try {
                (new \Database\Seeders\PakistanDefaultsSeeder())->run($company->id);
                $this->info("✓ Seeded defaults for: {$company->name} ({$company->email})");
            } catch (\Throwable $e) {
                $this->error("✗ Failed for {$company->email}: " . $e->getMessage());
            }
        }

        $this->info('Done! Pakistan defaults seeded for all companies.');
    }
}
