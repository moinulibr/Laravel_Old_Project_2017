<?php

use App\Model\Backend\Admin\TransactionHistory\Total_bill_payment_history;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        factory(Total_bill_payment_history::class,45000)->create();
        //factory(App\User::class,5000)->create();

        // $this->call(UsersTableSeeder::class);
        /*
        DB::table('users')->insert([
            ['role_id' => '1',
            'name' => 'Mr, Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')],
            [
            'role_id' => '5',
            'name' => 'Mr, Supplier',
            'email' => 'supplier@gmail.com',
            'password' => Hash::make('12345678')
            ],
            ['role_id' => '6',
            'name' => 'Mr, Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('12345678')]
        ]);


        DB::table('payment_methods')->insert([
            ['name' => 'Cash'],
            ['name' => 'Mobile Banking'],
            ['name' => 'Bank Account'],
            ['name' => 'Others']
        ]);
        

        DB::table('payment_typies')->insert([
            ['name' => 'Full Payment'],
            ['name' => 'Partial Payment'],
            ['name' => 'Others']
        ]);
        

        DB::table('mobile_banking_companies')->insert([
            ['name' => 'Bkash'],
            ['name' => 'Roket'],
            ['name' => 'Nogod']
        ]);
       

        DB::table('account_for_users')->insert([
                ['name' => 'Office Uses'],
                ['name' => 'Supplier Uses'],
                ['name' => 'Client Uses']
        ]);


        DB::table('roles')->insert([
                ['name' => 'Admin'],
                ['name' => 'Sub Admin'],
                ['name' => 'Moderator'],
                ['name' => 'General Employee'],
                ['name' => 'Supplier'],
                ['name' => 'Client']
        ]);


        DB::table('products')->insert([
                ['name' => 'Product 01'],
                ['name' => 'Product 02'],
                ['name' => 'Product 03'],
                ['name' => 'Product 04'],
                ['name' => 'Product 05'],
                ['name' => 'Product 06'],
                ['name' => 'Product 07'],
                ['name' => 'Product 08'],
                ['name' => 'Product 09'],
                ['name' => 'Product 10']
        ]);
        */
    }
}
