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
                'email' => '18102181@ittelkom-pwt.ac.id',
                'password' => Hash::make('zadita'),
                'role' => 1
            ],
            [
                'username' => 'trihastuti', // 2
                'email' => 'trihastuti@ittelkom-pwt.ac.id',
                'password' => Hash::make('trihastuti'),
                'role' => 2
            ],
            [
                'username' => 'mega', // 3
                'email' => 'mega@ittelkom-pwt.ac.id',
                'password' => Hash::make('mega'),
                'role' => 2
            ],
            [
                'username' => 'staffakademik', // 4
                'email' => 'akademik@ittelkom-pwt.ac.id',
                'password' => Hash::make('staff'),
                'role' => 3
            ],
            [
                'username' => 'amalia', // 5
                'email' => 'amalia@ittelkom-pwt.ac.id',
                'password' => Hash::make('amalia'),
                'role' => 2
            ],
            [
                'username' => 'adityadwiputro', // 6
                'email' => 'aditya@ittelkom-pwt.ac.id',
                'password' => Hash::make('adityadwiputro'),
                'role' => 2
            ],
            [
                'username' => 'agiprasetiadi', // 7
                'email' => 'agi@ittelkom-pwt.ac.id',
                'password' => Hash::make('agiprasetiadi'),
                'role' => 2
            ],
            [
                'username' => 'anggizafia', // 8
                'email' => 'zafia@ittelkom-pwt.ac.id',
                'password' => Hash::make('anggizafia'),
                'role' => 2
            ],
            [
                'username' => 'aguspriyanto', // 9
                'email' => 'agus_priyanto@ittelkom-pwt.ac.id',
                'password' => Hash::make('aguspriyanto'),
                'role' => 2
            ],
            [
                'username' => 'diandra', // 10
                'email' => 'diandra@ittelkom-pwt.ac.id',
                'password' => Hash::make('diandra'),
                'role' => 2
            ],
        ]);

        DB::table('departments')->insert([
            [
                'name' => 'Teknik Informatika',
                'kaprodi_id' => 5
            ]
        ]);

        DB::table('students')->insert([
            [
                'user_id' => 1,
                'nim' => '18102181',
                'name' => 'Zadita Awalia',
                'department_id' => 1,
                'pembimbing1_id' => 2,
                'pembimbing2_id' => 5,
            ]
        ]);

        DB::table('lecturers')->insert([
            [
                'user_id' => 2,
                'nip' => '19890021',
                'name' => 'Trihastuti, S.Kom., M.T.'
            ],
            [
                'user_id' => 3,
                'nip' => '20930025',
                'name' => 'Mega Pranata, S.Pd., M.Kom.'
            ],
            [
                'user_id' => 5,
                'nip' => '20920001',
                'name' => 'Amalia Beladinna Arifa, S.Pd., M.Cs.'
            ],
            [
                'user_id' => 6,
                'nip' => '17930052',
                'name' => 'Aditya Dwi Putro, S.Kom., M.Kom.'
            ],
            [
                'user_id' => 7,
                'nip' => '20880003',
                'name' => 'Agi Prasetiadi, S.T., M.Eng.'
            ],
            [
                'user_id' => 8,
                'nip' => '19870011',
                'name' => 'Anggi Zafia, S.T., M.Eng.'
            ],
            [
                'user_id' => 9,
                'nip' => '14820069',
                'name' => 'Agus Priyanto, S.Kom., M.Kom.'
            ],
            [
                'user_id' => 10,
                'nip' => '20930048',
                'name' => 'Diandra Chika Fransisca, S.Si., M.Sc.'
            ],
        ]);

        DB::table('staff')->insert([
            [
                'user_id' => 4,
                'nik' => '123456',
                'name' => 'Staff Akademik'
            ]
        ]);

        // DB::table('proposals')->insert([
        //     [
        //         'author_id' => 1,
        //         'title' => 'Aplikasi Sirespaspro',
        //         'abstract_indonesian' => 'anjay',
        //         'abstract_english' => 'amazing'
        //     ]
        // ]);

        // DB::table('revisions')->insert([
        //     [
        //         'proposal_id' => 1,
        //         'from_id' => 1,
        //         'message' => 'revisi pertama'
        //     ],
        //     [
        //         'proposal_id' => 1,
        //         'from_id' => 3,
        //         'message' => 'BAB II kurang blablabl'
        //     ],
        //     [
        //         'proposal_id' => 1,
        //         'from_id' => 1,
        //         'message' => 'revisi kedua menanggapi feedback'
        //     ],
        //     [
        //         'proposal_id' => 1,
        //         'from_id' => 3,
        //         'message' => 'Daftar Pustaka nya bblabla'
        //     ],
        //     [
        //         'proposal_id' => 1,
        //         'from_id' => 1,
        //         'message' => 'sudah diperbaiki'
        //     ],
        //     [
        //         'proposal_id' => 1,
        //         'from_id' => 3,
        //         'message' => 'Baik saya acc'
        //     ],
        // ]);
    }
}
