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
                'username' => 'zadita',
                'name' => 'Zadita Awalia',
                'email' => '18102179@ittelkom-pwt.ac.id',
                'password' => Hash::make('zadita'),
                'role' => 1 // student
            ],
            [
                'id_by_campus' => '112233',
                'username' => 'trihasututi',
                'name' => 'Trihastuti',
                'email' => '112233@ittelkom-pwt.ac.id',
                'password' => Hash::make('112233'),
                'role' => 2 // lecturer
            ],
            [
                'id_by_campus' => '445566',
                'username' => 'mega',
                'name' => 'Mega Pranata',
                'email' => '445566@ittelkom-pwt.ac.id',
                'password' => Hash::make('mega'),
                'role' => 2 // lecturer
            ]
        ]);

        // DB::table('proposals')->insert([
        //     [
        //         'author' => 1,
        //         'title' => 'Pengembangan Aplikasi Sistem Informasi Akademik Berbasis Web',
        //         'abstract_indonesian' => 'SIAKAD',
        //         'abstract_english' => 'SIAKAD',
        //         'pembimbing1' => 2,
        //         'penguji' => 3,
        //         'status' => 0
        //     ]
        // ]);
    }
}
