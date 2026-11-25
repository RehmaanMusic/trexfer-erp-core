<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TrexferDemoSeeder extends Seeder
{
    public function run($company_id = 2)
    {
        $this->seedStaff($company_id);
        $this->seedClients($company_id);
        $this->seedVendors($company_id);
        $this->seedProducts($company_id);
        $this->seedLeads($company_id);
        $this->seedProjects($company_id);
        $this->seedExpenses($company_id);
        $this->seedAnnouncements($company_id);
    }

    private function seedStaff($company_id)
    {
        $staff = [
            ['name' => 'Ahmed Raza',        'email' => 'ahmed.raza@testcompany.com',     'phone' => '0300-1234567'],
            ['name' => 'Fatima Malik',       'email' => 'fatima.malik@testcompany.com',   'phone' => '0301-2345678'],
            ['name' => 'Muhammad Usman',     'email' => 'm.usman@testcompany.com',        'phone' => '0302-3456789'],
            ['name' => 'Ayesha Khan',        'email' => 'ayesha.khan@testcompany.com',    'phone' => '0303-4567890'],
            ['name' => 'Bilal Hussain',      'email' => 'bilal.hussain@testcompany.com',  'phone' => '0304-5678901'],
            ['name' => 'Sana Tariq',         'email' => 'sana.tariq@testcompany.com',     'phone' => '0305-6789012'],
            ['name' => 'Imran Qureshi',      'email' => 'imran.qureshi@testcompany.com',  'phone' => '0306-7890123'],
            ['name' => 'Zara Ahmed',         'email' => 'zara.ahmed@testcompany.com',     'phone' => '0307-8901234'],
            ['name' => 'Hassan Sheikh',      'email' => 'hassan.sheikh@testcompany.com',  'phone' => '0308-9012345'],
            ['name' => 'Nadia Iqbal',        'email' => 'nadia.iqbal@testcompany.com',    'phone' => '0309-0123456'],
        ];

        $dept_id = DB::table('departments')->where('created_by', $company_id)->value('id');
        $desig_id = DB::table('designations')->where('created_by', $company_id)->value('id');

        foreach ($staff as $s) {
            if (User::where('email', $s['email'])->exists()) continue;
            $user = User::create([
                'name'       => $s['name'],
                'email'      => $s['email'],
                'password'   => Hash::make('Test@1234'),
                'type'       => 'staff',
                'created_by' => $company_id,
                'phone'      => $s['phone'],
            ]);
            $user->assignRole('staff');

            // Add employee record if employees table exists
            if (DB::getSchemaBuilder()->hasTable('employees')) {
                DB::table('employees')->insertOrIgnore([
                    'user_id'        => $user->id,
                    'department_id'  => $dept_id,
                    'designation_id' => $desig_id,
                    'employee_id'    => 'EMP-' . str_pad($user->id, 4, '0', STR_PAD_LEFT),
                    'joining_date'   => now()->subMonths(rand(1, 24))->format('Y-m-d'),
                    'created_by'     => $company_id,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            }
        }
    }

    private function seedClients($company_id)
    {
        $clients = [
            ['name' => 'Packages Limited',         'email' => 'contact@packages.com.pk',      'phone' => '042-35761800'],
            ['name' => 'Engro Corporation',         'email' => 'info@engro.com',               'phone' => '021-35296000'],
            ['name' => 'Habib Metropolitan Bank',   'email' => 'info@habibmetro.com',          'phone' => '021-111-014-014'],
            ['name' => 'Fauji Fertilizer Company',  'email' => 'contact@ffc.com.pk',           'phone' => '051-2873915'],
            ['name' => 'Lucky Cement',              'email' => 'info@luckycement.com',         'phone' => '021-111-786-555'],
            ['name' => 'Systems Limited',           'email' => 'info@systemsltd.com',          'phone' => '042-35761290'],
            ['name' => 'Arif Habib Group',          'email' => 'info@arifhabib.com.pk',        'phone' => '021-32460717'],
            ['name' => 'Nishat Group',              'email' => 'contact@nishat.net',            'phone' => '042-35760805'],
            ['name' => 'TRG Pakistan',              'email' => 'info@trg.com.pk',              'phone' => '021-111-874-874'],
            ['name' => 'NetSol Technologies',       'email' => 'info@netsol.com',              'phone' => '042-35761870'],
            ['name' => 'Ali Bhai Trading Co',       'email' => 'alibhai@trading.pk',           'phone' => '0321-1234567'],
            ['name' => 'Karachi Textile Mills',     'email' => 'orders@ktm.com.pk',            'phone' => '021-32456789'],
            ['name' => 'Lahore Auto Parts',         'email' => 'info@lahoreauto.pk',           'phone' => '042-37654321'],
            ['name' => 'Islamabad IT Solutions',    'email' => 'contact@isb-it.pk',            'phone' => '051-2876543'],
            ['name' => 'Multan Agri Exports',       'email' => 'sales@multanagri.pk',          'phone' => '061-4512345'],
        ];

        foreach ($clients as $c) {
            if (User::where('email', $c['email'])->exists()) continue;
            $user = User::create([
                'name'       => $c['name'],
                'email'      => $c['email'],
                'password'   => Hash::make('Test@1234'),
                'type'       => 'client',
                'created_by' => $company_id,
                'phone'      => $c['phone'],
            ]);
            $user->assignRole('client');
        }
    }

    private function seedVendors($company_id)
    {
        $vendors = [
            ['name' => 'Shaheen Office Supplies',   'email' => 'shaheen@officesupplies.pk',   'phone' => '042-35761001'],
            ['name' => 'Al-Khidmat Traders',        'email' => 'info@alkhidmat.pk',           'phone' => '021-32345678'],
            ['name' => 'PakTech Solutions',         'email' => 'sales@paktech.pk',            'phone' => '051-2812345'],
            ['name' => 'Ravi Enterprises',          'email' => 'ravi@enterprises.com.pk',     'phone' => '042-37123456'],
            ['name' => 'Chenab Stationery',         'email' => 'orders@chenab.pk',            'phone' => '041-8712345'],
            ['name' => 'Indus Logistics',           'email' => 'dispatch@induslogistics.pk',  'phone' => '021-35123456'],
            ['name' => 'Khyber Hardware',           'email' => 'info@khyberhardware.pk',      'phone' => '091-5612345'],
            ['name' => 'Punjab Printers',           'email' => 'print@punjabprinters.pk',     'phone' => '042-37891234'],
        ];

        foreach ($vendors as $v) {
            if (User::where('email', $v['email'])->exists()) continue;
            $user = User::create([
                'name'       => $v['name'],
                'email'      => $v['email'],
                'password'   => Hash::make('Test@1234'),
                'type'       => 'vendor',
                'created_by' => $company_id,
                'phone'      => $v['phone'],
            ]);
            $user->assignRole('vendor');
        }
    }

    private function seedProducts($company_id)
    {
        if (!DB::getSchemaBuilder()->hasTable('products')) return;

        $products = [
            ['name' => 'Office Chair (Executive)',     'price' => 15000,  'unit' => 'piece',  'category' => 'Furniture'],
            ['name' => 'Office Desk (L-Shape)',        'price' => 25000,  'unit' => 'piece',  'category' => 'Furniture'],
            ['name' => 'HP Laptop 15"',                'price' => 95000,  'unit' => 'piece',  'category' => 'Electronics'],
            ['name' => 'Canon Printer (Laser)',        'price' => 35000,  'unit' => 'piece',  'category' => 'Electronics'],
            ['name' => 'A4 Paper Ream (500 sheets)',   'price' => 1200,   'unit' => 'ream',   'category' => 'Stationery'],
            ['name' => 'Whiteboard Marker Set',        'price' => 350,    'unit' => 'set',    'category' => 'Stationery'],
            ['name' => 'Web Development (Basic)',      'price' => 50000,  'unit' => 'project','category' => 'Services'],
            ['name' => 'SEO Package (Monthly)',        'price' => 25000,  'unit' => 'month',  'category' => 'Services'],
            ['name' => 'Accounting Software License', 'price' => 15000,  'unit' => 'year',   'category' => 'Software'],
            ['name' => 'HR Management System',        'price' => 30000,  'unit' => 'year',   'category' => 'Software'],
            ['name' => 'Air Conditioner 1.5 Ton',     'price' => 85000,  'unit' => 'piece',  'category' => 'Electronics'],
            ['name' => 'UPS 1000VA',                  'price' => 18000,  'unit' => 'piece',  'category' => 'Electronics'],
            ['name' => 'Networking Setup (Office)',    'price' => 40000,  'unit' => 'project','category' => 'Services'],
            ['name' => 'Generator 5KVA',              'price' => 150000, 'unit' => 'piece',  'category' => 'Electronics'],
            ['name' => 'CCTV Camera System (8ch)',     'price' => 45000,  'unit' => 'set',    'category' => 'Electronics'],
        ];

        foreach ($products as $p) {
            DB::table('products')->insertOrIgnore([
                'name'       => $p['name'],
                'price'      => $p['price'],
                'unit'       => $p['unit'],
                'created_by' => $company_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedLeads($company_id)
    {
        if (!DB::getSchemaBuilder()->hasTable('leads')) return;

        $stage_id = DB::table('lead_stages')->where('created_by', $company_id)->value('id');

        $leads = [
            ['name' => 'Faisal Textile Mills',    'email' => 'faisal@textilemills.pk',   'phone' => '0300-1111111', 'amount' => 500000],
            ['name' => 'Sunrise Pharma',          'email' => 'info@sunrisepharma.pk',    'phone' => '0301-2222222', 'amount' => 250000],
            ['name' => 'Green Valley Foods',      'email' => 'contact@greenvalley.pk',   'phone' => '0302-3333333', 'amount' => 180000],
            ['name' => 'Metro Cash & Carry',      'email' => 'b2b@metro.com.pk',         'phone' => '0303-4444444', 'amount' => 750000],
            ['name' => 'Ghani Glass Industries',  'email' => 'sales@ghaniglass.pk',      'phone' => '0304-5555555', 'amount' => 320000],
            ['name' => 'Sapphire Retail',         'email' => 'it@sapphire.pk',           'phone' => '0305-6666666', 'amount' => 420000],
            ['name' => 'DWP Group',               'email' => 'contact@dwpgroup.pk',      'phone' => '0306-7777777', 'amount' => 650000],
            ['name' => 'Meezan Bank IT Dept',     'email' => 'it@meezanbank.com',        'phone' => '0307-8888888', 'amount' => 900000],
        ];

        foreach ($leads as $l) {
            DB::table('leads')->insertOrIgnore([
                'name'      => $l['name'],
                'email'     => $l['email'],
                'phone'     => $l['phone'],
                'amount'    => $l['amount'],
                'stage_id'  => $stage_id,
                'created_by'=> $company_id,
                'created_at'=> now()->subDays(rand(1, 60)),
                'updated_at'=> now(),
            ]);
        }
    }

    private function seedProjects($company_id)
    {
        if (!DB::getSchemaBuilder()->hasTable('projects')) return;

        $projects = [
            ['name' => 'ERP Implementation - Faisal Textile',  'status' => 'in_progress', 'budget' => 500000],
            ['name' => 'Website Redesign - Sunrise Pharma',    'status' => 'in_progress', 'budget' => 150000],
            ['name' => 'Network Setup - Metro Karachi',        'status' => 'completed',   'budget' => 280000],
            ['name' => 'HR System - Green Valley Foods',       'status' => 'pending',     'budget' => 180000],
            ['name' => 'POS System - Sapphire Retail',         'status' => 'in_progress', 'budget' => 320000],
            ['name' => 'Mobile App - DWP Group',               'status' => 'pending',     'budget' => 450000],
        ];

        foreach ($projects as $p) {
            DB::table('projects')->insertOrIgnore([
                'name'        => $p['name'],
                'status'      => $p['status'],
                'budget'      => $p['budget'],
                'start_date'  => now()->subMonths(rand(1, 6))->format('Y-m-d'),
                'end_date'    => now()->addMonths(rand(1, 6))->format('Y-m-d'),
                'created_by'  => $company_id,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }

    private function seedExpenses($company_id)
    {
        if (!DB::getSchemaBuilder()->hasTable('expenses')) return;

        $cat_id = DB::table('expense_categories')->where('created_by', $company_id)->value('id');

        $expenses = [
            ['name' => 'Office Rent - November 2026',      'amount' => 85000],
            ['name' => 'WAPDA Bill - November 2026',       'amount' => 12500],
            ['name' => 'SNGPL Gas Bill - November 2026',   'amount' => 3200],
            ['name' => 'Internet (PTCL 100Mbps)',          'amount' => 8500],
            ['name' => 'Staff Salaries - November 2026',   'amount' => 450000],
            ['name' => 'Office Supplies Purchase',         'amount' => 15000],
            ['name' => 'Travel & Conveyance',              'amount' => 22000],
            ['name' => 'Marketing - Facebook Ads',         'amount' => 35000],
            ['name' => 'Repair - AC Maintenance',          'amount' => 8000],
            ['name' => 'Withholding Tax Payment',          'amount' => 45000],
        ];

        foreach ($expenses as $e) {
            DB::table('expenses')->insertOrIgnore([
                'name'        => $e['name'],
                'amount'      => $e['amount'],
                'category_id' => $cat_id,
                'date'        => now()->subDays(rand(1, 30))->format('Y-m-d'),
                'created_by'  => $company_id,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }

    private function seedAnnouncements($company_id)
    {
        if (!DB::getSchemaBuilder()->hasTable('announcements')) return;

        $announcements = [
            ['title' => 'Eid ul Adha Holiday - Office Closed 3 Days',         'description' => 'The office will remain closed on 16, 17 and 18 June 2026 on account of Eid ul Adha. Eid Mubarak to all staff!'],
            ['title' => 'New Health Insurance Policy Effective December 2026', 'description' => 'We are pleased to announce a new health insurance policy for all permanent employees. HR will share details this week.'],
            ['title' => 'Office Timing Change - Winter Schedule',              'description' => 'Winter office timings are 9:00 AM to 5:30 PM effective 1st December 2026.'],
            ['title' => 'Company Picnic - 15th December 2026',                'description' => 'Annual company picnic at Jallo Park, Lahore. Families are welcome. Buses from office at 9 AM.'],
        ];

        foreach ($announcements as $a) {
            DB::table('announcements')->insertOrIgnore([
                'title'       => $a['title'],
                'description' => $a['description'],
                'created_by'  => $company_id,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
