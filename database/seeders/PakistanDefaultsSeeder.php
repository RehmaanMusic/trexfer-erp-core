<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PakistanDefaultsSeeder extends Seeder
{
    public function run($company_id = null)
    {
        if (!$company_id) {
            $user = \App\Models\User::where('type', 'company')->first();
            if (!$user) return;
            $company_id = $user->id;
        }

        // ── 1. Document Types ──────────────────────────────────────────
        $docTypes = [
            'CNIC', 'Passport', 'Driving License', 'NTN Certificate',
            'STRN Certificate', 'Birth Certificate', 'Domicile Certificate',
            'Educational Certificate', 'Experience Letter', 'Offer Letter',
            'Appointment Letter', 'Resignation Letter', 'Relieving Letter',
        ];
        foreach ($docTypes as $type) {
            DB::table('document_types')->insertOrIgnore([
                'name' => $type,
                'created_by' => $company_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ── 2. Departments ─────────────────────────────────────────────
        $departments = [
            'Administration', 'Finance & Accounts', 'Human Resources',
            'Information Technology', 'Sales & Marketing', 'Operations',
            'Customer Support', 'Procurement', 'Legal & Compliance',
            'Research & Development', 'Production', 'Quality Assurance',
            'Logistics & Supply Chain', 'Business Development',
            'Internal Audit', 'Public Relations', 'Training & Development',
            'Security',
        ];
        foreach ($departments as $dept) {
            DB::table('departments')->insertOrIgnore([
                'name' => $dept,
                'created_by' => $company_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ── 3. Designations ────────────────────────────────────────────
        $designations = [
            'Chief Executive Officer (CEO)', 'Chief Operating Officer (COO)',
            'Chief Financial Officer (CFO)', 'Chief Technology Officer (CTO)',
            'General Manager', 'Deputy General Manager', 'Senior Manager',
            'Manager', 'Assistant Manager', 'Team Lead',
            'Senior Executive', 'Executive', 'Junior Executive',
            'Senior Officer', 'Officer', 'Junior Officer',
            'Senior Associate', 'Associate', 'Analyst',
            'Senior Accountant', 'Accountant', 'Accounts Officer',
            'Software Engineer', 'Senior Software Engineer', 'DevOps Engineer',
            'HR Manager', 'HR Officer', 'Recruiter',
            'Sales Manager', 'Sales Executive', 'Business Development Officer',
            'Customer Support Representative', 'Admin Assistant', 'Receptionist',
            'Intern',
        ];
        foreach ($designations as $desig) {
            DB::table('designations')->insertOrIgnore([
                'name' => $desig,
                'created_by' => $company_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ── 4. Leave Types (Pakistan Labour Law) ───────────────────────
        $leaveTypes = [
            ['name' => 'Annual Leave',          'days' => 14, 'type' => 'paid'],
            ['name' => 'Casual Leave',           'days' => 10, 'type' => 'paid'],
            ['name' => 'Sick Leave',             'days' => 10, 'type' => 'paid'],
            ['name' => 'Maternity Leave',        'days' => 90, 'type' => 'paid'],
            ['name' => 'Paternity Leave',        'days' => 3,  'type' => 'paid'],
            ['name' => 'Hajj Leave',             'days' => 30, 'type' => 'paid'],
            ['name' => 'Eid ul Fitr Leave',      'days' => 3,  'type' => 'paid'],
            ['name' => 'Eid ul Adha Leave',      'days' => 3,  'type' => 'paid'],
            ['name' => 'Unpaid Leave',           'days' => 0,  'type' => 'unpaid'],
            ['name' => 'Compensatory Leave',     'days' => 0,  'type' => 'paid'],
            ['name' => 'Study/Exam Leave',       'days' => 5,  'type' => 'paid'],
            ['name' => 'Bereavement Leave',      'days' => 3,  'type' => 'paid'],
        ];
        foreach ($leaveTypes as $leave) {
            DB::table('leave_types')->insertOrIgnore([
                'name'       => $leave['name'],
                'days'       => $leave['days'],
                'type'       => $leave['type'],
                'created_by' => $company_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ── 5. Expense Categories ──────────────────────────────────────
        $expenseCategories = [
            'Salaries & Wages', 'Rent & Utilities', 'Office Supplies',
            'Travel & Conveyance', 'Fuel & Vehicle', 'Marketing & Advertising',
            'Software & Subscriptions', 'Hardware & Equipment',
            'Repair & Maintenance', 'Legal & Professional Fees',
            'Bank Charges', 'Taxes & Government Fees', 'Training & Development',
            'Medical & Health', 'Communication (Mobile/Internet)',
            'Printing & Stationery', 'Security Services',
            'Miscellaneous', 'Entertainment & Meals', 'Insurance',
            'Freight & Courier', 'Import/Export Duties',
            'Sales Commission', 'Depreciation', 'Utility Bills (WAPDA/SNGPL)',
            'EOBI Contributions', 'PESSI Contributions',
            'Withholding Tax (WHT)', 'Income Tax', 'Sales Tax (GST)',
            'Worker Welfare Fund (WWF)', 'Worker Profit Participation Fund (WPPF)',
        ];
        foreach ($expenseCategories as $cat) {
            DB::table('expense_categories')->insertOrIgnore([
                'name'       => $cat,
                'created_by' => $company_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ── 6. Lead Stages (CRM) ───────────────────────────────────────
        $leadStages = ['New Lead', 'Contacted', 'Qualified', 'Proposal Sent', 'Negotiation', 'Won', 'Lost'];
        foreach ($leadStages as $i => $stage) {
            DB::table('lead_stages')->insertOrIgnore([
                'name'       => $stage,
                'order'      => $i + 1,
                'created_by' => $company_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ── 7. Candidate Sources (Recruitment) ─────────────────────────
        $sources = [
            'Rozee.pk', 'LinkedIn', 'Indeed', 'Mustakbil.com',
            'JobsInPakistan.com', 'Employee Referral', 'Walk-in',
            'Company Website', 'Facebook', 'Newspaper Ad', 'Recruitment Agency',
        ];
        foreach ($sources as $source) {
            DB::table('sources')->insertOrIgnore([
                'name'       => $source,
                'created_by' => $company_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
