<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Advertisement;
use App\Models\Agent;
use App\Models\AgentWallet;
use App\Models\Biller;
use App\Models\Business;
use App\Models\City;
use App\Models\Country;
use App\Models\FundRequest;
use App\Models\PaymentChargePackage;
use App\Models\SourceOfIncome;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\UserPermission;
use App\Services\FundRequestService;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        DB::statement('ALTER TABLE users AUTO_INCREMENT = 10000');

//        DB::statement('ALTER TABLE fund_requests AUTO_INCREMENT=10000');

        DB::table('banks')->insert([
            ['bank_name' => 'Bank of South Pacific Fiji','bsb' => '069001','swift'=> 'BOSPFJFJ'],
            ['bank_name' => 'ANZ Bank Fiji','bsb' => '010890','swift'=> 'ANZBFJFX'],
            ['bank_name' => 'Westpac Bank Fiji','bsb' => '039001','swift'=> 'WPACFJFX'],
            ['bank_name' => 'HFC Bank Fiji','bsb' => '129010','swift'=> 'HFCLFJFJ'],
            ['bank_name' => 'Bank of Baroda Fiji','bsb' => '049101','swift'=> 'BARBFJFJ'],
            ['bank_name' => 'BRED Bank Fiji','bsb' => '119010','swift'=> 'BREDFJFJ'],
        ]);

        DB::table('merchant_categories')->insert([
            ['category_name' => 'AGRICULTURE, FORESTRY AND FISHING'],
            ['category_name' => 'MINING AND QUARRYING'],
            ['category_name' => 'MANUFACTURING'],
            ['category_name' => 'ELECTRICITY, GAS, STEAM AND AIR CONDITIONING SUPPLY']]);

        DB::table('business_types')->insert([
            ['business_type' => 'Sole Proprietorship'],
            ['business_type' => 'Private company'],
            ['business_type' => 'Public company'],
            ['business_type' => 'Non profit organisation']]);

//        Country::factory()->has(City::factory()->count(10))->count(3)->create();

        $path = 'database/seeders/cities.sql';
        DB::unprepared(file_get_contents($path));


        DB::table('transfer_limit_schemes')->insert(
            ['name' => 'Default limit', 'eligible_limit_per_month' => 10000, 'eligible_limit_per_day' => 2000]);

        DB::table('commission_schemes')->insert(
            ['name' => 'Default commission scheme', 'commission_type' => 'PERCENTAGE', 'commission_value' => 0.5]);

        DB::table('admin_bank_details')->insert(
            ['bank_name' => 'Default bank', 'account_no' => '12345', 'bsb' => 'axxx123', 'swift' => 'XXX123']);

        DB::table('user_types')->insert([
            ['user_type' => 'Admin'],
            ['user_type' => 'Customer'],
            ['user_type' => 'Agent'],
            ['user_type' => 'Merchant'],
            ['user_type' => 'Biller'],
            ['user_type' => 'Admin_commission'],
            ['user_type' => 'Sub_account'],
            ['user_type' => 'Admin_withdrawal'],
            ['user_type' => 'Staff']
        ]);

        DB::table('biller_categories')->insert([
            ['category_name' => 'Services'],
            ['user_type' => 'Bill payments'],
            ['user_type' => 'Recharges'],
        ]);

        DB::table('complaint_types')->insert([
            ['transaction_type' => 'GENERAL_COMPLAINT', 'type_description' => 'App is slow'],
            ['transaction_type' => 'GENERAL_COMPLAINT', 'type_description' => 'Other'],
            ['transaction_type' => 'WALLET_TRANSFER', 'type_description' => 'Customer complaining'],
            ['transaction_type' => 'WALLET_TRANSFER', 'type_description' => 'Fraud'],
            ['transaction_type' => 'WALLET_TRANSFER', 'type_description' => 'Other'],
            ['transaction_type' => 'DEPOSIT', 'type_description' => 'Did not get funds'],
            ['transaction_type' => 'DEPOSIT', 'type_description' => 'Other'],
            ['transaction_type' => 'WITHDRAWAL', 'type_description' => 'Amount not as expected'],
            ['transaction_type' => 'WITHDRAWAL', 'type_description' => 'Other'],
            ['transaction_type' => 'BILL_PAYMENT', 'type_description' => 'My Bill not paid'],
            ['transaction_type' => 'BILL_PAYMENT', 'type_description' => 'Other'],
            ['transaction_type' => 'WITHDRAWAL_CHARGE', 'type_description' => 'Charged more then expected'],
            ['transaction_type' => 'WITHDRAWAL_CHARGE', 'type_description' => 'Other'],
            ['transaction_type' => 'CASHBACK', 'type_description' => 'Amount not received as expected'],
            ['transaction_type' => 'CASHBACK', 'type_description' => 'Other'],
        ]);


        User::factory()->create([
//            'id' => rand(100,999),
            'user_type_id' => 1,
            'mobile_no' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('password123'),
            'is_kyc_verified' => true,
            'is_registration_completed' => true,
            'transaction_pin' => bcrypt('1234'),
            'email' => 'admin@pacpay.com',
            'kyc_verified_by' => 1,
            'first_name' => 'Pacpay',
            'last_name' => '',
            'gender' => 'MALE'
        ]);

        $customer1 = User::factory()->create([
            'user_type_id' => 2,
            'mobile_no' => '2222222',
            'username' => 'customer',
            'password' => bcrypt('password123'),
            'is_kyc_verified' => true,
            'is_registration_completed' => true,
            'transaction_pin' => bcrypt('1234'),
            'kyc_verified_by' => 3,
        ])->paymentChargePackage()->attach([3]);


        User::factory()->has(Business::factory())->has(Agent::factory()->has(AgentWallet::factory()->state(new Sequence(['wallet_type' => 'FUNDS'], ['wallet_type' => 'COMMISSION']))->count(2)))->create([
            'user_type_id' => 3,
            'mobile_no' => '3333333',
            'username' => 'agent',
            'password' => bcrypt('password123'),
            'is_kyc_verified' => true,
            'is_registration_completed' => true,
            'transaction_pin' => bcrypt('1234'),
            'kyc_verified_by' => 1,
        ]);


        User::factory()->has(Business::factory())->create([
            'user_type_id' => 4,
            'mobile_no' => '4444444',
            'username' => 'merchant',
            'password' => bcrypt('password123'),
            'is_kyc_verified' => true,
            'is_registration_completed' => true,
            'transaction_pin' => bcrypt('1234'),
            'kyc_verified_by' => 1,
            'has_sub_accounts' => true
        ])->paymentChargePackage()->attach([2, 3]);

        User::factory()->has(Biller::factory())->create([
            'user_type_id' => 5,
            'mobile_no' => '5555555',
            'username' => 'biller',
            'password' => bcrypt('password123'),
            'is_kyc_verified' => true,
            'is_registration_completed' => true,
            'transaction_pin' => bcrypt('1234'),
            'kyc_verified_by' => 1,
        ])->paymentChargePackage()->attach([1]);


        $customer2 = User::factory()->create([
            'user_type_id' => 2,
            'mobile_no' => '2222000',
            'username' => 'customer2',
            'password' => bcrypt('password123'),
            'is_kyc_verified' => true,
            'is_registration_completed' => true,
            'transaction_pin' => bcrypt('1234'),
            'kyc_verified_by' => 3,
        ])->paymentChargePackage()->attach([3]);

        User::factory()->has(Business::factory())
            ->has(Agent::factory()
                ->has(AgentWallet::factory()->state(new Sequence(['wallet_type' => 'FUNDS'], ['wallet_type' => 'COMMISSION']))->count(2)))
            ->create([
                'user_type_id' => 3,
                'mobile_no' => '3333000',
                'username' => 'agent2',
                'password' => bcrypt('password123'),
                'is_kyc_verified' => true,
                'is_registration_completed' => true,
                'transaction_pin' => bcrypt('1234'),
                'kyc_verified_by' => 1
            ]);


        User::factory()->has(Business::factory())->create([
            'user_type_id' => 4,
            'mobile_no' => '444000',
            'username' => 'merchant2',
            'password' => bcrypt('password123'),
            'is_kyc_verified' => true,
            'is_registration_completed' => true,
            'transaction_pin' => bcrypt('1234'),
            'kyc_verified_by' => 1,
        ])->paymentChargePackage()->attach([2, 3]);

        User::factory()->create([
            'user_type_id' => 6,
            'mobile_no' => 'admin_commission',
            'username' => 'admin_commission',
            'password' => bcrypt('password123'),
            'is_kyc_verified' => true,
            'is_registration_completed' => true,
            'transaction_pin' => bcrypt('1234'),
            'email' => 'admin_comm@pacpay.com',
            'kyc_verified_by' => 1
        ]);

        User::factory()->create([
            'user_type_id' => 8,
            'mobile_no' => 'admin_withdrawal',
            'username' => 'admin_withdrawal',
            'password' => bcrypt('password123'),
            'is_kyc_verified' => true,
            'is_registration_completed' => true,
            'transaction_pin' => bcrypt('1234'),
            'email' => 'admin_wt@pacpay.com',
            'kyc_verified_by' => 1
        ]);

       $staff = User::factory()->create([
            'user_type_id' => 9,
            'mobile_no' => '9090909',
            'username' => 'staff',
            'password' => bcrypt('password123'),
            'is_kyc_verified' => true,
            'is_registration_completed' => true,
            'transaction_pin' => bcrypt('1234'),
            'email' => 'staff@pacpay.com',
            'kyc_verified_by' => 1
        ]);




        $this->call(FAQTableSeeder::class);

        Advertisement::factory()->count(4)->create();

        SystemSetting::create(
            [
                'withdrawal_commission_tiers' => json_decode('{"withdrawal_ranges":[{"min_range":10,"max_range":100,"commission":"0.5"},{"min_range":101,"max_range":500,"commission":"1.10"},{"min_range":501,"max_range":1000,"commission":"1.50"},{"min_range":1001,"max_range":2000,"commission":"2.00"}]}'),
                'withdrawal_charges' => '{"agent_withdrawal_charges":{"min_charge":2,"max_charge":10,"percentage_charge":2}},{"bank_withdrawal_charges":{"min_charge":2,"max_charge":10,"percentage_charge":2}}'

            ]
        );

        DB::statement('INSERT INTO pacpay.vouchers (id, code, model_type, model_id, data, expires_at, created_at, updated_at) VALUES (6, \'SCVW-RYAY\', \'App\\\Models\\\Promotion\', 4, \'{"promotion_name":"Cashback fund request","voucher_for":"FUND_REQUEST","expiry_date":"2021-10-10","min_txn_amount":"10","cashback_type":"FIXED_AMOUNT","cashback_amount":"2","voucher_type":"INSTANT","reward_upto_max_amount":null,"voucher_description":"Win cashback of 10% upto 100 for doing sending funds","user_id":null,"is_active":true}\', \'2021-10-10 23:59:59\', \'2021-10-03 19:51:38\', \'2021-10-03 19:51:38\');');
        DB::statement('INSERT INTO pacpay.vouchers (id, code, model_type, model_id, data, expires_at, created_at, updated_at) VALUES (7, \'9HXD-9BJN\', \'App\\\Models\\\Promotion\', 5, \'{"promotion_name":"Win cashback merchant","voucher_for":"MERCHANT_PAYMENT","expiry_date":"2022-11-01","min_txn_amount":"100","cashback_type":"PERCENTAGE","cashback_amount":"1","voucher_type":"RETURNING","reward_upto_max_amount":"2","voucher_description":"Win 1% of casback on transaction of min 100 amount to merchant 4","user_id":"4","is_active":true}\', \'2022-11-01 23:59:59\', \'2021-10-03 19:57:30\', \'2021-10-03 19:57:30\');');
        DB::statement('INSERT INTO pacpay.vouchers (id, code, model_type, model_id, data, expires_at, created_at, updated_at) VALUES (8, \'7536-3DDU\', \'App\\\Models\\\Promotion\', 6, \'{"promotion_name":"Pay bill and win","voucher_for":"BILL_PAYMENT","expiry_date":"2021-11-01","min_txn_amount":"20","cashback_type":"FIXED_AMOUNT","cashback_amount":"0.2","voucher_type":"RETURNING","reward_upto_max_amount":"2","voucher_description":"Win 0.2 of casback on transaction of min 20 amount to biller 5","user_id":"1","is_active":true}\', \'2021-11-01 23:59:59\', \'2021-10-05 21:06:22\', \'2021-10-05 21:06:22\');');
        DB::statement('INSERT INTO pacpay.vouchers (id, code, model_type, model_id, data, expires_at, created_at, updated_at) VALUES (9, \'T6FC-8U8N\', \'App\\\Models\\\Promotion\', 7, \'{"promotion_name":"Deposit and win","voucher_for":"DEPOSIT","expiry_date":"2021-11-01","min_txn_amount":"5","cashback_type":"FIXED_AMOUNT","cashback_amount":"0.5","voucher_type":"RETURNING","voucher_description":"Win 0.5 of casback on deposit of 5 from agent 3","user_id":"1","is_active":true}\', \'2021-11-01 23:59:59\', \'2021-10-05 21:07:23\', \'2021-10-05 21:07:23\');');

        DB::statement("INSERT INTO pacpay.promotions (created_at, updated_at, id, promotion_name, promotion_model, promotion_transaction_type, voucher_id) VALUES ('2021-10-03 19:51:38', '2021-10-03 19:51:38', 4, 'Cashback fund request', 'App\\\Models\\\FundRequest', 'WALLET_TRANSFER', 6)");
        DB::statement("INSERT INTO pacpay.promotions (created_at, updated_at, id, promotion_name, promotion_model, promotion_transaction_type, voucher_id) VALUES ('2021-10-03 19:57:30', '2021-10-03 19:57:30', 5, 'Do merchant payment and earn cashback', 'App\\\Models\\\FundRequest', 'WALLET_TRANSFER', 7)");
        DB::statement("INSERT INTO pacpay.promotions (created_at, updated_at, id, promotion_name, promotion_model, promotion_transaction_type, voucher_id) VALUES ('2021-10-05 21:06:22', '2021-10-05 21:06:22', 6, 'Pay bill and win cashbacks', 'App\\\Models\\\BillPayment', 'BILL_PAYMENT', 8)");
        DB::statement("INSERT INTO pacpay.promotions (created_at, updated_at, id, promotion_name, promotion_model, promotion_transaction_type, voucher_id) VALUES ('2021-10-05 21:07:23', '2021-10-05 21:07:23', 7, 'Win cashback on deposits', 'App\\\Models\\\Deposit', 'DEPOSIT', 9)");


        PaymentChargePackage::insert([
                ['package_name' => 'Default bill pay scheme',
                    'package_type' => 'BILL_PAYMENT',
                    'charges' => '{"payment_charges":{"min_charge":1,"max_charge":3,"percentage_charge":1}}',
                    'is_default' => true
                ],
                ['package_name' => 'Default merchant pay scheme',
                    'package_type' => 'MERCHANT_PAYMENT',
                    'charges' => '{"payment_charges":{"min_charge":2,"max_charge":6,"percentage_charge":2}}',
                    'is_default' => true
                ],
                ['package_name' => 'Default p2p pay scheme',
                    'package_type' => 'P2P_PAYMENT',
                    'charges' => '{"payment_charges":{"min_charge":3,"max_charge":9,"percentage_charge":0}}',
                    'is_default' => true
                ]
            ]
        );


DB::statement("INSERT INTO pacpay.app_grid (id, label, logo_url, type, redirect_to, unique_id, grid_for, grid_no) VALUES (1, 'Services', null, 'category', 'services', 1, 'App\\\Models\\\BillerCategory', 1)");
DB::statement("INSERT INTO pacpay.app_grid (id, label, logo_url, type, redirect_to, unique_id, grid_for, grid_no) VALUES (2, 'Bill payments', null, 'category', 'bill_payments', 2, 'App\\\Models\\\BillerCategory', 2)");
DB::statement("INSERT INTO pacpay.app_grid (id, label, logo_url, type, redirect_to, unique_id, grid_for, grid_no) VALUES (3, 'Recharges', null, 'category', 'recharge_screen', 3, 'App\\\Models\\\BillerCategory', 3)");
DB::statement("INSERT INTO pacpay.app_grid (id, label, logo_url, type, redirect_to, unique_id, grid_for, grid_no) VALUES (4, 'Some label', null, 'singular', 'biller', 1, 'App\\\Models\\\Biller', 4)");
DB::statement("INSERT INTO pacpay.app_grid (id, label, logo_url, type, redirect_to, unique_id, grid_for, grid_no) VALUES (5, null, null, null, null, null, null, 5)");
DB::statement("INSERT INTO pacpay.app_grid (id, label, logo_url, type, redirect_to, unique_id, grid_for, grid_no) VALUES (6, null, null, null, null, null, null, 6)");
DB::statement("INSERT INTO pacpay.app_grid (id, label, logo_url, type, redirect_to, unique_id, grid_for, grid_no) VALUES (7, null, null, null, null, null, null, 7)");
DB::statement("INSERT INTO pacpay.app_grid (id, label, logo_url, type, redirect_to, unique_id, grid_for, grid_no) VALUES (8, 'More', null, 'category', 'app_more', null, null, 8)");

        Permission::create(['name' => 'VIEW_USER']);
        Permission::create(['name' => 'CREATE_USER']);
        Permission::create(['name' => 'MANAGE_USER_WALLET']);
        Permission::create(['name' => 'MANAGE_USER_VERIFICATION']);
        Permission::create(['name' => 'UPLOAD_USER_DOCUMENT']);
        Permission::create(['name' => 'EDIT_USER_BASIC_DETAILS']);
        Permission::create(['name' => 'SEND_USER_NOTIFICATION']);
        Permission::create(['name' => 'MANAGE_COMPLAINT']);
        Permission::create(['name' => 'MANAGE_ADVERTISEMENT']);


        $staff->givePermissionTo(['VIEW_USER','CREATE_USER','MANAGE_USER_VERIFICATION']);

        Role::create(['name' => 'Super admin']);

        $admin = User::where('user_type_id',UserType::Admin)->first();
        $admin->assignRole('Super admin');


        DB::table('source_of_income')->insert([
            ['source' => 'Self-employment income' ],
            ['source' => 'Employment income'],
            ['source' => 'pension'],
            ['source' => 'Savings'],
            ['source' => 'Social Welfare'],
            ['source' => 'Friends & Family gifts and support']
        ]);

    }
}
