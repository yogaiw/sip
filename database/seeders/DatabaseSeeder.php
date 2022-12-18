<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            [
                'id_by_campus' => '18102179',
                'username' => '18102179',
                'name' => 'Zadita Awalia',
                'email' => '18102179@ittelkom-pwt.ac.id',
                'password' => Hash::make('18102179'),
                'role' => 1 // student
            ],
            [
                'id_by_campus' => '112233',
                'username' => '112233',
                'name' => 'Trihastuti',
                'email' => '112233@ittelkom-pwt.ac.id',
                'password' => Hash::make('112233'),
                'role' => 2 // lecturer
            ]
        ]);

        // DB::table('proposals')->insert([
        //     [
        //         'author' => 1,
        //         'title' => 'Aplikasi Pencatatan Pengeluaran',
        //         'file' => 'proposal.pdf'
        //     ]
        // ]);
    }
}
