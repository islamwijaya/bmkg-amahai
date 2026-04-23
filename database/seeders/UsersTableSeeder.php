<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'is_admin' => 0,
                'email_verified_at' => '2026-04-18 01:09:43',
                'password' => '$2y$12$Hyh9/LpLie4QdgUTIyd/B.h0fSwVmbm.djjqdxjUrcDH.bhUr5Tei',
                'remember_token' => 'hsKD8puxHi',
                'created_at' => '2026-04-18 01:09:44',
                'updated_at' => '2026-04-18 01:09:44',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Administrator',
                'email' => 'admin@bmkg.go.id',
                'is_admin' => 1,
                'email_verified_at' => NULL,
                'password' => '$2y$12$v56X00JpsJ.i0m6JRKQCZOItrvQeJv21JXiH3uM1lTBlMzruKUPNO',
                'remember_token' => NULL,
                'created_at' => '2026-04-18 01:10:21',
                'updated_at' => '2026-04-18 01:10:21',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Admin Test',
                'email' => 'test@bmkg.go.id',
                'is_admin' => 1,
                'email_verified_at' => NULL,
                'password' => '$2y$12$P49UBZlF4zNcCmv8LDofAeHDZiRsfMlkvESqsRgTyFaPzSiuqqnhe',
                'remember_token' => NULL,
                'created_at' => '2026-04-21 02:12:48',
                'updated_at' => '2026-04-21 02:12:48',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Admin Test',
                'email' => 'test1@bmkg.go.id',
                'is_admin' => 1,
                'email_verified_at' => NULL,
                'password' => '$2y$12$iN.ZNBLj/qmQCoF.ikyy/etw9kmSLtL3QNlqefqB8Rv0O4D3y/4EW',
                'remember_token' => NULL,
                'created_at' => '2026-04-21 02:18:35',
                'updated_at' => '2026-04-21 02:18:35',
            ),
        ));
        
        
    }
}