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
                'username' => 'zadita', // 1
                'email' => 'zadita@localhost',
                'password' => Hash::make('zadita'),
                'role' => 1
            ],
            [
                'username' => 'trihastuti', // 2
                'email' => 'trihastuti@localhost',
                'password' => Hash::make('trihastuti'),
                'role' => 2
            ],
            [
                'username' => 'mega', // 3
                'email' => 'mega@localhost',
                'password' => Hash::make('mega'),
                'role' => 2
            ]
        ]);

        DB::table('students')->insert([
            [
                'user_id' => 1,
                'nim' => '18102179',
                'name' => 'Zadita Awalia',
                'pembimbing1_id' => 2,
                'penguji_id' => 3
            ]
        ]);

        DB::table('lecturers')->insert([
            [
                'user_id' => 2,
                'nip' => '1234',
                'name' => 'Trihastuti'
            ],
            [
                'user_id' => 3,
                'nip' => '5678',
                'name' => 'Mega Pranata'
            ]
        ]);

        DB::table('proposals')->insert([
            [
                'author_id' => 1,
                'title' => 'Aplikasi Sirespaspro',
                'abstract_indonesian' => 'anjay',
                'abstract_english' => 'amazing'
            ]
        ]);

        DB::table('revisions')->insert([
            [
                'proposal_id' => 1,
                'from_id' => 1,
                'message' => 'revisi pertama'
            ],
            [
                'proposal_id' => 1,
                'from_id' => 3,
                'message' => 'BAB II kurang blablabl'
            ],
            [
                'proposal_id' => 1,
                'from_id' => 1,
                'message' => 'revisi kedua menanggapi feedback'
            ],
            [
                'proposal_id' => 1,
                'from_id' => 3,
                'message' => 'Daftar Pustaka nya bblabla'
            ],
            [
                'proposal_id' => 1,
                'from_id' => 1,
                'message' => 'sudah diperbaiki'
            ],
            [
                'proposal_id' => 1,
                'from_id' => 3,
                'message' => 'Baik saya acc'
            ],
        ]);
    }
}
