<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 111,
                'name' => 'Student Information create',
                'parent' => 'Student Information',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:21:22',
                'updated_at' => '2023-10-28 10:21:22',
            ),
            1 => 
            array (
                'id' => 112,
                'name' => 'Student Information index',
                'parent' => 'Student Information',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:21:22',
                'updated_at' => '2023-10-28 10:21:22',
            ),
            2 => 
            array (
                'id' => 113,
                'name' => 'Student Information show',
                'parent' => 'Student Information',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:21:22',
                'updated_at' => '2023-10-28 10:21:22',
            ),
            3 => 
            array (
                'id' => 114,
                'name' => 'Student Information edit',
                'parent' => 'Student Information',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:21:22',
                'updated_at' => '2023-10-28 10:21:22',
            ),
            4 => 
            array (
                'id' => 115,
                'name' => 'Student Information destroy',
                'parent' => 'Student Information',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:21:22',
                'updated_at' => '2023-10-28 10:21:22',
            ),
            5 => 
            array (
                'id' => 116,
                'name' => 'Student Information trash',
                'parent' => 'Student Information',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:21:22',
                'updated_at' => '2023-10-28 10:21:22',
            ),
            6 => 
            array (
                'id' => 117,
                'name' => 'Student Information restore',
                'parent' => 'Student Information',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:21:22',
                'updated_at' => '2023-10-28 10:21:22',
            ),
            7 => 
            array (
                'id' => 118,
                'name' => 'Student Information delete',
                'parent' => 'Student Information',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:21:22',
                'updated_at' => '2023-10-28 10:21:22',
            ),
            8 => 
            array (
                'id' => 119,
                'name' => 'Student Information status',
                'parent' => 'Student Information',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:21:22',
                'updated_at' => '2023-10-28 10:21:22',
            ),
            9 => 
            array (
                'id' => 120,
                'name' => 'Student Information properties',
                'parent' => 'Student Information',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:21:22',
                'updated_at' => '2023-10-28 10:21:22',
            ),
            10 => 
            array (
                'id' => 121,
                'name' => 'Student Information print',
                'parent' => 'Student Information',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:21:22',
                'updated_at' => '2023-10-28 10:21:22',
            ),
            11 => 
            array (
                'id' => 144,
                'name' => 'Income create',
                'parent' => 'Income',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:34:05',
                'updated_at' => '2023-10-28 10:34:05',
            ),
            12 => 
            array (
                'id' => 145,
                'name' => 'Income index',
                'parent' => 'Income',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:34:05',
                'updated_at' => '2023-10-28 10:34:05',
            ),
            13 => 
            array (
                'id' => 146,
                'name' => 'Income show',
                'parent' => 'Income',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:34:05',
                'updated_at' => '2023-10-28 10:34:05',
            ),
            14 => 
            array (
                'id' => 147,
                'name' => 'Income edit',
                'parent' => 'Income',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:34:05',
                'updated_at' => '2023-10-28 10:34:05',
            ),
            15 => 
            array (
                'id' => 148,
                'name' => 'Income destroy',
                'parent' => 'Income',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:34:05',
                'updated_at' => '2023-10-28 10:34:05',
            ),
            16 => 
            array (
                'id' => 149,
                'name' => 'Income trash',
                'parent' => 'Income',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:34:05',
                'updated_at' => '2023-10-28 10:34:05',
            ),
            17 => 
            array (
                'id' => 150,
                'name' => 'Income restore',
                'parent' => 'Income',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:34:05',
                'updated_at' => '2023-10-28 10:34:05',
            ),
            18 => 
            array (
                'id' => 151,
                'name' => 'Income delete',
                'parent' => 'Income',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:34:05',
                'updated_at' => '2023-10-28 10:34:05',
            ),
            19 => 
            array (
                'id' => 152,
                'name' => 'Income status',
                'parent' => 'Income',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:34:05',
                'updated_at' => '2023-10-28 10:34:05',
            ),
            20 => 
            array (
                'id' => 153,
                'name' => 'Income properties',
                'parent' => 'Income',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:34:05',
                'updated_at' => '2023-10-28 10:34:05',
            ),
            21 => 
            array (
                'id' => 154,
                'name' => 'Income print',
                'parent' => 'Income',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 10:34:05',
                'updated_at' => '2023-10-28 10:34:05',
            ),
            22 => 
            array (
                'id' => 155,
                'name' => 'Dashboard index',
                'parent' => 'Dashboard',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:08:51',
                'updated_at' => '2023-10-28 12:08:51',
            ),
            23 => 
            array (
                'id' => 156,
                'name' => 'Menu Label create',
                'parent' => 'Menu Label',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:45:30',
                'updated_at' => '2023-10-28 12:45:30',
            ),
            24 => 
            array (
                'id' => 157,
                'name' => 'Menu Label index',
                'parent' => 'Menu Label',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:45:30',
                'updated_at' => '2023-10-28 12:45:30',
            ),
            25 => 
            array (
                'id' => 158,
                'name' => 'Menu Label show',
                'parent' => 'Menu Label',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:45:30',
                'updated_at' => '2023-10-28 12:45:30',
            ),
            26 => 
            array (
                'id' => 159,
                'name' => 'Menu Label edit',
                'parent' => 'Menu Label',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:45:30',
                'updated_at' => '2023-10-28 12:45:30',
            ),
            27 => 
            array (
                'id' => 160,
                'name' => 'Menu Label destroy',
                'parent' => 'Menu Label',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:45:30',
                'updated_at' => '2023-10-28 12:45:30',
            ),
            28 => 
            array (
                'id' => 161,
                'name' => 'Menu Label trash',
                'parent' => 'Menu Label',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:45:30',
                'updated_at' => '2023-10-28 12:45:30',
            ),
            29 => 
            array (
                'id' => 162,
                'name' => 'Menu Label restore',
                'parent' => 'Menu Label',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:45:30',
                'updated_at' => '2023-10-28 12:45:30',
            ),
            30 => 
            array (
                'id' => 163,
                'name' => 'Menu Label delete',
                'parent' => 'Menu Label',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:45:30',
                'updated_at' => '2023-10-28 12:45:30',
            ),
            31 => 
            array (
                'id' => 164,
                'name' => 'Menu Label status',
                'parent' => 'Menu Label',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:45:30',
                'updated_at' => '2023-10-28 12:45:30',
            ),
            32 => 
            array (
                'id' => 165,
                'name' => 'Menu Label properties',
                'parent' => 'Menu Label',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:45:30',
                'updated_at' => '2023-10-28 12:45:30',
            ),
            33 => 
            array (
                'id' => 166,
                'name' => 'Menu Label print',
                'parent' => 'Menu Label',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:45:30',
                'updated_at' => '2023-10-28 12:45:30',
            ),
            34 => 
            array (
                'id' => 167,
                'name' => 'Menu create',
                'parent' => 'Menu',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:51:14',
                'updated_at' => '2023-10-28 12:51:14',
            ),
            35 => 
            array (
                'id' => 168,
                'name' => 'Menu index',
                'parent' => 'Menu',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:51:14',
                'updated_at' => '2023-10-28 12:51:14',
            ),
            36 => 
            array (
                'id' => 169,
                'name' => 'Menu show',
                'parent' => 'Menu',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:51:14',
                'updated_at' => '2023-10-28 12:51:14',
            ),
            37 => 
            array (
                'id' => 170,
                'name' => 'Menu edit',
                'parent' => 'Menu',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:51:14',
                'updated_at' => '2023-10-28 12:51:14',
            ),
            38 => 
            array (
                'id' => 171,
                'name' => 'Menu destroy',
                'parent' => 'Menu',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:51:14',
                'updated_at' => '2023-10-28 12:51:14',
            ),
            39 => 
            array (
                'id' => 172,
                'name' => 'Menu trash',
                'parent' => 'Menu',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:51:14',
                'updated_at' => '2023-10-28 12:51:14',
            ),
            40 => 
            array (
                'id' => 173,
                'name' => 'Menu restore',
                'parent' => 'Menu',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:51:14',
                'updated_at' => '2023-10-28 12:51:14',
            ),
            41 => 
            array (
                'id' => 174,
                'name' => 'Menu delete',
                'parent' => 'Menu',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:51:14',
                'updated_at' => '2023-10-28 12:51:14',
            ),
            42 => 
            array (
                'id' => 175,
                'name' => 'Menu status',
                'parent' => 'Menu',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:51:14',
                'updated_at' => '2023-10-28 12:51:14',
            ),
            43 => 
            array (
                'id' => 176,
                'name' => 'Menu properties',
                'parent' => 'Menu',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:51:14',
                'updated_at' => '2023-10-28 12:51:14',
            ),
            44 => 
            array (
                'id' => 177,
                'name' => 'Menu print',
                'parent' => 'Menu',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 12:51:14',
                'updated_at' => '2023-10-28 12:51:14',
            ),
            45 => 
            array (
                'id' => 178,
                'name' => 'Role create',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 13:58:11',
                'updated_at' => '2023-10-28 13:58:11',
            ),
            46 => 
            array (
                'id' => 179,
                'name' => 'Role index',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 13:58:11',
                'updated_at' => '2023-10-28 13:58:11',
            ),
            47 => 
            array (
                'id' => 180,
                'name' => 'Role show',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 13:58:11',
                'updated_at' => '2023-10-28 13:58:11',
            ),
            48 => 
            array (
                'id' => 181,
                'name' => 'Role edit',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 13:58:11',
                'updated_at' => '2023-10-28 13:58:11',
            ),
            49 => 
            array (
                'id' => 182,
                'name' => 'Role destroy',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 13:58:11',
                'updated_at' => '2023-10-28 13:58:11',
            ),
            50 => 
            array (
                'id' => 183,
                'name' => 'Role trash',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 13:58:11',
                'updated_at' => '2023-10-28 13:58:11',
            ),
            51 => 
            array (
                'id' => 184,
                'name' => 'Role restore',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 13:58:11',
                'updated_at' => '2023-10-28 13:58:11',
            ),
            52 => 
            array (
                'id' => 185,
                'name' => 'Role delete',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 13:58:11',
                'updated_at' => '2023-10-28 13:58:11',
            ),
            53 => 
            array (
                'id' => 186,
                'name' => 'Role status',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 13:58:11',
                'updated_at' => '2023-10-28 13:58:11',
            ),
            54 => 
            array (
                'id' => 187,
                'name' => 'Role properties',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 13:58:11',
                'updated_at' => '2023-10-28 13:58:11',
            ),
            55 => 
            array (
                'id' => 188,
                'name' => 'Role print',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 13:58:11',
                'updated_at' => '2023-10-28 13:58:11',
            ),
            56 => 
            array (
                'id' => 189,
                'name' => 'Admin create',
                'parent' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:09:00',
                'updated_at' => '2023-10-28 14:09:00',
            ),
            57 => 
            array (
                'id' => 190,
                'name' => 'Admin index',
                'parent' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:09:00',
                'updated_at' => '2023-10-28 14:09:00',
            ),
            58 => 
            array (
                'id' => 191,
                'name' => 'Admin show',
                'parent' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:09:00',
                'updated_at' => '2023-10-28 14:09:00',
            ),
            59 => 
            array (
                'id' => 192,
                'name' => 'Admin edit',
                'parent' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:09:00',
                'updated_at' => '2023-10-28 14:09:00',
            ),
            60 => 
            array (
                'id' => 193,
                'name' => 'Admin destroy',
                'parent' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:09:00',
                'updated_at' => '2023-10-28 14:09:00',
            ),
            61 => 
            array (
                'id' => 194,
                'name' => 'Admin trash',
                'parent' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:09:00',
                'updated_at' => '2023-10-28 14:09:00',
            ),
            62 => 
            array (
                'id' => 195,
                'name' => 'Admin restore',
                'parent' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:09:00',
                'updated_at' => '2023-10-28 14:09:00',
            ),
            63 => 
            array (
                'id' => 196,
                'name' => 'Admin delete',
                'parent' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:09:00',
                'updated_at' => '2023-10-28 14:09:00',
            ),
            64 => 
            array (
                'id' => 197,
                'name' => 'Admin status',
                'parent' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:09:00',
                'updated_at' => '2023-10-28 14:09:00',
            ),
            65 => 
            array (
                'id' => 198,
                'name' => 'Admin properties',
                'parent' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:09:00',
                'updated_at' => '2023-10-28 14:09:00',
            ),
            66 => 
            array (
                'id' => 199,
                'name' => 'Admin print',
                'parent' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:09:00',
                'updated_at' => '2023-10-28 14:09:00',
            ),
            67 => 
            array (
                'id' => 200,
                'name' => 'Branch create',
                'parent' => 'Branch',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:10:55',
                'updated_at' => '2023-10-28 14:10:55',
            ),
            68 => 
            array (
                'id' => 201,
                'name' => 'Branch index',
                'parent' => 'Branch',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:10:55',
                'updated_at' => '2023-10-28 14:10:55',
            ),
            69 => 
            array (
                'id' => 202,
                'name' => 'Branch show',
                'parent' => 'Branch',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:10:55',
                'updated_at' => '2023-10-28 14:10:55',
            ),
            70 => 
            array (
                'id' => 203,
                'name' => 'Branch edit',
                'parent' => 'Branch',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:10:55',
                'updated_at' => '2023-10-28 14:10:55',
            ),
            71 => 
            array (
                'id' => 204,
                'name' => 'Branch destroy',
                'parent' => 'Branch',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:10:55',
                'updated_at' => '2023-10-28 14:10:55',
            ),
            72 => 
            array (
                'id' => 205,
                'name' => 'Branch trash',
                'parent' => 'Branch',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:10:55',
                'updated_at' => '2023-10-28 14:10:55',
            ),
            73 => 
            array (
                'id' => 206,
                'name' => 'Branch restore',
                'parent' => 'Branch',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:10:55',
                'updated_at' => '2023-10-28 14:10:55',
            ),
            74 => 
            array (
                'id' => 207,
                'name' => 'Branch delete',
                'parent' => 'Branch',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:10:55',
                'updated_at' => '2023-10-28 14:10:55',
            ),
            75 => 
            array (
                'id' => 208,
                'name' => 'Branch status',
                'parent' => 'Branch',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:10:55',
                'updated_at' => '2023-10-28 14:10:55',
            ),
            76 => 
            array (
                'id' => 209,
                'name' => 'Branch properties',
                'parent' => 'Branch',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:10:55',
                'updated_at' => '2023-10-28 14:10:55',
            ),
            77 => 
            array (
                'id' => 210,
                'name' => 'Branch print',
                'parent' => 'Branch',
                'guard_name' => 'web',
                'created_at' => '2023-10-28 14:10:55',
                'updated_at' => '2023-10-28 14:10:55',
            ),
            78 => 
            array (
                'id' => 276,
                'name' => 'Software Info create',
                'parent' => 'Software Info',
                'guard_name' => 'web',
                'created_at' => '2023-10-31 00:17:35',
                'updated_at' => '2023-10-31 00:17:35',
            ),
            79 => 
            array (
                'id' => 277,
                'name' => 'Software Info index',
                'parent' => 'Software Info',
                'guard_name' => 'web',
                'created_at' => '2023-10-31 00:17:35',
                'updated_at' => '2023-10-31 00:17:35',
            ),
            80 => 
            array (
                'id' => 278,
                'name' => 'Theme Settings create',
                'parent' => 'Theme Settings',
                'guard_name' => 'web',
                'created_at' => '2023-11-01 17:02:46',
                'updated_at' => '2023-11-01 17:02:46',
            ),
            81 => 
            array (
                'id' => 279,
                'name' => 'Test Menu index',
                'parent' => 'Test Menu',
                'guard_name' => 'web',
                'created_at' => '2023-11-02 11:14:50',
                'updated_at' => '2023-11-02 11:14:50',
            ),
            82 => 
            array (
                'id' => 291,
                'name' => 'Messages create',
                'parent' => 'Messages',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:21',
                'updated_at' => '2024-04-16 13:30:21',
            ),
            83 => 
            array (
                'id' => 292,
                'name' => 'Messages index',
                'parent' => 'Messages',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:21',
                'updated_at' => '2024-04-16 13:30:21',
            ),
            84 => 
            array (
                'id' => 293,
                'name' => 'Messages show',
                'parent' => 'Messages',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:21',
                'updated_at' => '2024-04-16 13:30:21',
            ),
            85 => 
            array (
                'id' => 294,
                'name' => 'Messages edit',
                'parent' => 'Messages',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:21',
                'updated_at' => '2024-04-16 13:30:21',
            ),
            86 => 
            array (
                'id' => 295,
                'name' => 'Messages destroy',
                'parent' => 'Messages',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:21',
                'updated_at' => '2024-04-16 13:30:21',
            ),
            87 => 
            array (
                'id' => 296,
                'name' => 'Messages trash',
                'parent' => 'Messages',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:21',
                'updated_at' => '2024-04-16 13:30:21',
            ),
            88 => 
            array (
                'id' => 297,
                'name' => 'Messages restore',
                'parent' => 'Messages',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:21',
                'updated_at' => '2024-04-16 13:30:21',
            ),
            89 => 
            array (
                'id' => 298,
                'name' => 'Messages delete',
                'parent' => 'Messages',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:21',
                'updated_at' => '2024-04-16 13:30:21',
            ),
            90 => 
            array (
                'id' => 299,
                'name' => 'Messages status',
                'parent' => 'Messages',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:21',
                'updated_at' => '2024-04-16 13:30:21',
            ),
            91 => 
            array (
                'id' => 300,
                'name' => 'Messages properties',
                'parent' => 'Messages',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:21',
                'updated_at' => '2024-04-16 13:30:21',
            ),
            92 => 
            array (
                'id' => 301,
                'name' => 'Messages print',
                'parent' => 'Messages',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:21',
                'updated_at' => '2024-04-16 13:30:21',
            ),
            93 => 
            array (
                'id' => 302,
                'name' => 'Home Setting create',
                'parent' => 'Home Setting',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:57',
                'updated_at' => '2024-04-16 13:30:57',
            ),
            94 => 
            array (
                'id' => 303,
                'name' => 'Home Setting index',
                'parent' => 'Home Setting',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:57',
                'updated_at' => '2024-04-16 13:30:57',
            ),
            95 => 
            array (
                'id' => 304,
                'name' => 'Home Setting show',
                'parent' => 'Home Setting',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:57',
                'updated_at' => '2024-04-16 13:30:57',
            ),
            96 => 
            array (
                'id' => 305,
                'name' => 'Home Setting edit',
                'parent' => 'Home Setting',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:57',
                'updated_at' => '2024-04-16 13:30:57',
            ),
            97 => 
            array (
                'id' => 306,
                'name' => 'Home Setting destroy',
                'parent' => 'Home Setting',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:58',
                'updated_at' => '2024-04-16 13:30:58',
            ),
            98 => 
            array (
                'id' => 307,
                'name' => 'Home Setting trash',
                'parent' => 'Home Setting',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:58',
                'updated_at' => '2024-04-16 13:30:58',
            ),
            99 => 
            array (
                'id' => 308,
                'name' => 'Home Setting restore',
                'parent' => 'Home Setting',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:58',
                'updated_at' => '2024-04-16 13:30:58',
            ),
            100 => 
            array (
                'id' => 309,
                'name' => 'Home Setting delete',
                'parent' => 'Home Setting',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:58',
                'updated_at' => '2024-04-16 13:30:58',
            ),
            101 => 
            array (
                'id' => 310,
                'name' => 'Home Setting status',
                'parent' => 'Home Setting',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:58',
                'updated_at' => '2024-04-16 13:30:58',
            ),
            102 => 
            array (
                'id' => 311,
                'name' => 'Home Setting properties',
                'parent' => 'Home Setting',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:58',
                'updated_at' => '2024-04-16 13:30:58',
            ),
            103 => 
            array (
                'id' => 312,
                'name' => 'Home Setting print',
                'parent' => 'Home Setting',
                'guard_name' => 'web',
                'created_at' => '2024-04-16 13:30:58',
                'updated_at' => '2024-04-16 13:30:58',
            ),
            104 => 
            array (
                'id' => 324,
                'name' => 'Admission Data create',
                'parent' => 'Admission Data',
                'guard_name' => 'web',
                'created_at' => '2024-04-17 17:08:27',
                'updated_at' => '2024-04-17 17:08:27',
            ),
            105 => 
            array (
                'id' => 325,
                'name' => 'Admission Data index',
                'parent' => 'Admission Data',
                'guard_name' => 'web',
                'created_at' => '2024-04-17 17:08:27',
                'updated_at' => '2024-04-17 17:08:27',
            ),
            106 => 
            array (
                'id' => 326,
                'name' => 'Admission Data show',
                'parent' => 'Admission Data',
                'guard_name' => 'web',
                'created_at' => '2024-04-17 17:08:27',
                'updated_at' => '2024-04-17 17:08:27',
            ),
            107 => 
            array (
                'id' => 327,
                'name' => 'Admission Data edit',
                'parent' => 'Admission Data',
                'guard_name' => 'web',
                'created_at' => '2024-04-17 17:08:27',
                'updated_at' => '2024-04-17 17:08:27',
            ),
            108 => 
            array (
                'id' => 328,
                'name' => 'Admission Data destroy',
                'parent' => 'Admission Data',
                'guard_name' => 'web',
                'created_at' => '2024-04-17 17:08:27',
                'updated_at' => '2024-04-17 17:08:27',
            ),
            109 => 
            array (
                'id' => 329,
                'name' => 'Admission Data trash',
                'parent' => 'Admission Data',
                'guard_name' => 'web',
                'created_at' => '2024-04-17 17:08:27',
                'updated_at' => '2024-04-17 17:08:27',
            ),
            110 => 
            array (
                'id' => 330,
                'name' => 'Admission Data restore',
                'parent' => 'Admission Data',
                'guard_name' => 'web',
                'created_at' => '2024-04-17 17:08:27',
                'updated_at' => '2024-04-17 17:08:27',
            ),
            111 => 
            array (
                'id' => 331,
                'name' => 'Admission Data delete',
                'parent' => 'Admission Data',
                'guard_name' => 'web',
                'created_at' => '2024-04-17 17:08:27',
                'updated_at' => '2024-04-17 17:08:27',
            ),
            112 => 
            array (
                'id' => 332,
                'name' => 'Admission Data status',
                'parent' => 'Admission Data',
                'guard_name' => 'web',
                'created_at' => '2024-04-17 17:08:27',
                'updated_at' => '2024-04-17 17:08:27',
            ),
            113 => 
            array (
                'id' => 333,
                'name' => 'Admission Data properties',
                'parent' => 'Admission Data',
                'guard_name' => 'web',
                'created_at' => '2024-04-17 17:08:27',
                'updated_at' => '2024-04-17 17:08:27',
            ),
            114 => 
            array (
                'id' => 334,
                'name' => 'Admission Data print',
                'parent' => 'Admission Data',
                'guard_name' => 'web',
                'created_at' => '2024-04-17 17:08:27',
                'updated_at' => '2024-04-17 17:08:27',
            ),
            115 => 
            array (
                'id' => 335,
                'name' => 'Categories create',
                'parent' => 'Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-22 17:41:29',
                'updated_at' => '2024-04-22 17:41:29',
            ),
            116 => 
            array (
                'id' => 336,
                'name' => 'Categories index',
                'parent' => 'Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-22 17:41:29',
                'updated_at' => '2024-04-22 17:41:29',
            ),
            117 => 
            array (
                'id' => 337,
                'name' => 'Categories show',
                'parent' => 'Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-22 17:41:29',
                'updated_at' => '2024-04-22 17:41:29',
            ),
            118 => 
            array (
                'id' => 338,
                'name' => 'Categories edit',
                'parent' => 'Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-22 17:41:29',
                'updated_at' => '2024-04-22 17:41:29',
            ),
            119 => 
            array (
                'id' => 339,
                'name' => 'Categories destroy',
                'parent' => 'Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-22 17:41:29',
                'updated_at' => '2024-04-22 17:41:29',
            ),
            120 => 
            array (
                'id' => 340,
                'name' => 'Categories trash',
                'parent' => 'Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-22 17:41:29',
                'updated_at' => '2024-04-22 17:41:29',
            ),
            121 => 
            array (
                'id' => 341,
                'name' => 'Categories restore',
                'parent' => 'Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-22 17:41:29',
                'updated_at' => '2024-04-22 17:41:29',
            ),
            122 => 
            array (
                'id' => 342,
                'name' => 'Categories delete',
                'parent' => 'Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-22 17:41:29',
                'updated_at' => '2024-04-22 17:41:29',
            ),
            123 => 
            array (
                'id' => 343,
                'name' => 'Categories status',
                'parent' => 'Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-22 17:41:29',
                'updated_at' => '2024-04-22 17:41:29',
            ),
            124 => 
            array (
                'id' => 344,
                'name' => 'Categories properties',
                'parent' => 'Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-22 17:41:29',
                'updated_at' => '2024-04-22 17:41:29',
            ),
            125 => 
            array (
                'id' => 345,
                'name' => 'Categories print',
                'parent' => 'Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-22 17:41:29',
                'updated_at' => '2024-04-22 17:41:29',
            ),
            126 => 
            array (
                'id' => 346,
                'name' => 'Sub Categories create',
                'parent' => 'Sub Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 11:26:31',
                'updated_at' => '2024-04-23 11:26:31',
            ),
            127 => 
            array (
                'id' => 347,
                'name' => 'Sub Categories index',
                'parent' => 'Sub Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 11:26:31',
                'updated_at' => '2024-04-23 11:26:31',
            ),
            128 => 
            array (
                'id' => 348,
                'name' => 'Sub Categories show',
                'parent' => 'Sub Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 11:26:31',
                'updated_at' => '2024-04-23 11:26:31',
            ),
            129 => 
            array (
                'id' => 349,
                'name' => 'Sub Categories edit',
                'parent' => 'Sub Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 11:26:31',
                'updated_at' => '2024-04-23 11:26:31',
            ),
            130 => 
            array (
                'id' => 350,
                'name' => 'Sub Categories destroy',
                'parent' => 'Sub Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 11:26:31',
                'updated_at' => '2024-04-23 11:26:31',
            ),
            131 => 
            array (
                'id' => 351,
                'name' => 'Sub Categories trash',
                'parent' => 'Sub Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 11:26:31',
                'updated_at' => '2024-04-23 11:26:31',
            ),
            132 => 
            array (
                'id' => 352,
                'name' => 'Sub Categories restore',
                'parent' => 'Sub Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 11:26:31',
                'updated_at' => '2024-04-23 11:26:31',
            ),
            133 => 
            array (
                'id' => 353,
                'name' => 'Sub Categories delete',
                'parent' => 'Sub Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 11:26:31',
                'updated_at' => '2024-04-23 11:26:31',
            ),
            134 => 
            array (
                'id' => 354,
                'name' => 'Sub Categories status',
                'parent' => 'Sub Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 11:26:31',
                'updated_at' => '2024-04-23 11:26:31',
            ),
            135 => 
            array (
                'id' => 355,
                'name' => 'Sub Categories properties',
                'parent' => 'Sub Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 11:26:32',
                'updated_at' => '2024-04-23 11:26:32',
            ),
            136 => 
            array (
                'id' => 356,
                'name' => 'Sub Categories print',
                'parent' => 'Sub Categories',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 11:26:32',
                'updated_at' => '2024-04-23 11:26:32',
            ),
            137 => 
            array (
                'id' => 368,
                'name' => 'Add Size create',
                'parent' => 'Add Size',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:14:49',
                'updated_at' => '2024-04-23 13:14:49',
            ),
            138 => 
            array (
                'id' => 369,
                'name' => 'Add Size index',
                'parent' => 'Add Size',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:14:49',
                'updated_at' => '2024-04-23 13:14:49',
            ),
            139 => 
            array (
                'id' => 370,
                'name' => 'Add Size show',
                'parent' => 'Add Size',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:14:49',
                'updated_at' => '2024-04-23 13:14:49',
            ),
            140 => 
            array (
                'id' => 371,
                'name' => 'Add Size edit',
                'parent' => 'Add Size',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:14:49',
                'updated_at' => '2024-04-23 13:14:49',
            ),
            141 => 
            array (
                'id' => 372,
                'name' => 'Add Size destroy',
                'parent' => 'Add Size',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:14:49',
                'updated_at' => '2024-04-23 13:14:49',
            ),
            142 => 
            array (
                'id' => 373,
                'name' => 'Add Size trash',
                'parent' => 'Add Size',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:14:49',
                'updated_at' => '2024-04-23 13:14:49',
            ),
            143 => 
            array (
                'id' => 374,
                'name' => 'Add Size restore',
                'parent' => 'Add Size',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:14:50',
                'updated_at' => '2024-04-23 13:14:50',
            ),
            144 => 
            array (
                'id' => 375,
                'name' => 'Add Size delete',
                'parent' => 'Add Size',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:14:50',
                'updated_at' => '2024-04-23 13:14:50',
            ),
            145 => 
            array (
                'id' => 376,
                'name' => 'Add Size status',
                'parent' => 'Add Size',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:14:50',
                'updated_at' => '2024-04-23 13:14:50',
            ),
            146 => 
            array (
                'id' => 377,
                'name' => 'Add Size properties',
                'parent' => 'Add Size',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:14:50',
                'updated_at' => '2024-04-23 13:14:50',
            ),
            147 => 
            array (
                'id' => 378,
                'name' => 'Add Size print',
                'parent' => 'Add Size',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:14:50',
                'updated_at' => '2024-04-23 13:14:50',
            ),
            148 => 
            array (
                'id' => 379,
                'name' => 'Add Color create',
                'parent' => 'Add Color',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:15:49',
                'updated_at' => '2024-04-23 13:15:49',
            ),
            149 => 
            array (
                'id' => 380,
                'name' => 'Add Color index',
                'parent' => 'Add Color',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:15:49',
                'updated_at' => '2024-04-23 13:15:49',
            ),
            150 => 
            array (
                'id' => 381,
                'name' => 'Add Color show',
                'parent' => 'Add Color',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:15:49',
                'updated_at' => '2024-04-23 13:15:49',
            ),
            151 => 
            array (
                'id' => 382,
                'name' => 'Add Color edit',
                'parent' => 'Add Color',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:15:49',
                'updated_at' => '2024-04-23 13:15:49',
            ),
            152 => 
            array (
                'id' => 383,
                'name' => 'Add Color destroy',
                'parent' => 'Add Color',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:15:49',
                'updated_at' => '2024-04-23 13:15:49',
            ),
            153 => 
            array (
                'id' => 384,
                'name' => 'Add Color trash',
                'parent' => 'Add Color',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:15:49',
                'updated_at' => '2024-04-23 13:15:49',
            ),
            154 => 
            array (
                'id' => 385,
                'name' => 'Add Color restore',
                'parent' => 'Add Color',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:15:49',
                'updated_at' => '2024-04-23 13:15:49',
            ),
            155 => 
            array (
                'id' => 386,
                'name' => 'Add Color delete',
                'parent' => 'Add Color',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:15:49',
                'updated_at' => '2024-04-23 13:15:49',
            ),
            156 => 
            array (
                'id' => 387,
                'name' => 'Add Color status',
                'parent' => 'Add Color',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:15:49',
                'updated_at' => '2024-04-23 13:15:49',
            ),
            157 => 
            array (
                'id' => 388,
                'name' => 'Add Color properties',
                'parent' => 'Add Color',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:15:49',
                'updated_at' => '2024-04-23 13:15:49',
            ),
            158 => 
            array (
                'id' => 389,
                'name' => 'Add Color print',
                'parent' => 'Add Color',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:15:49',
                'updated_at' => '2024-04-23 13:15:49',
            ),
            159 => 
            array (
                'id' => 390,
                'name' => 'Brand create',
                'parent' => 'Brand',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:16:18',
                'updated_at' => '2024-04-23 13:16:18',
            ),
            160 => 
            array (
                'id' => 391,
                'name' => 'Brand index',
                'parent' => 'Brand',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:16:18',
                'updated_at' => '2024-04-23 13:16:18',
            ),
            161 => 
            array (
                'id' => 392,
                'name' => 'Brand show',
                'parent' => 'Brand',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:16:18',
                'updated_at' => '2024-04-23 13:16:18',
            ),
            162 => 
            array (
                'id' => 393,
                'name' => 'Brand edit',
                'parent' => 'Brand',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:16:18',
                'updated_at' => '2024-04-23 13:16:18',
            ),
            163 => 
            array (
                'id' => 394,
                'name' => 'Brand destroy',
                'parent' => 'Brand',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:16:18',
                'updated_at' => '2024-04-23 13:16:18',
            ),
            164 => 
            array (
                'id' => 395,
                'name' => 'Brand trash',
                'parent' => 'Brand',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:16:18',
                'updated_at' => '2024-04-23 13:16:18',
            ),
            165 => 
            array (
                'id' => 396,
                'name' => 'Brand restore',
                'parent' => 'Brand',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:16:18',
                'updated_at' => '2024-04-23 13:16:18',
            ),
            166 => 
            array (
                'id' => 397,
                'name' => 'Brand delete',
                'parent' => 'Brand',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:16:18',
                'updated_at' => '2024-04-23 13:16:18',
            ),
            167 => 
            array (
                'id' => 398,
                'name' => 'Brand status',
                'parent' => 'Brand',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:16:18',
                'updated_at' => '2024-04-23 13:16:18',
            ),
            168 => 
            array (
                'id' => 399,
                'name' => 'Brand properties',
                'parent' => 'Brand',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:16:18',
                'updated_at' => '2024-04-23 13:16:18',
            ),
            169 => 
            array (
                'id' => 400,
                'name' => 'Brand print',
                'parent' => 'Brand',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 13:16:18',
                'updated_at' => '2024-04-23 13:16:18',
            ),
            170 => 
            array (
                'id' => 401,
                'name' => 'Price Range create',
                'parent' => 'Price Range',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 16:20:19',
                'updated_at' => '2024-04-23 16:20:19',
            ),
            171 => 
            array (
                'id' => 402,
                'name' => 'Price Range index',
                'parent' => 'Price Range',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 16:20:19',
                'updated_at' => '2024-04-23 16:20:19',
            ),
            172 => 
            array (
                'id' => 403,
                'name' => 'Price Range show',
                'parent' => 'Price Range',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 16:20:19',
                'updated_at' => '2024-04-23 16:20:19',
            ),
            173 => 
            array (
                'id' => 404,
                'name' => 'Price Range edit',
                'parent' => 'Price Range',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 16:20:19',
                'updated_at' => '2024-04-23 16:20:19',
            ),
            174 => 
            array (
                'id' => 405,
                'name' => 'Price Range destroy',
                'parent' => 'Price Range',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 16:20:19',
                'updated_at' => '2024-04-23 16:20:19',
            ),
            175 => 
            array (
                'id' => 406,
                'name' => 'Price Range trash',
                'parent' => 'Price Range',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 16:20:20',
                'updated_at' => '2024-04-23 16:20:20',
            ),
            176 => 
            array (
                'id' => 407,
                'name' => 'Price Range restore',
                'parent' => 'Price Range',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 16:20:20',
                'updated_at' => '2024-04-23 16:20:20',
            ),
            177 => 
            array (
                'id' => 408,
                'name' => 'Price Range delete',
                'parent' => 'Price Range',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 16:20:20',
                'updated_at' => '2024-04-23 16:20:20',
            ),
            178 => 
            array (
                'id' => 409,
                'name' => 'Price Range status',
                'parent' => 'Price Range',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 16:20:20',
                'updated_at' => '2024-04-23 16:20:20',
            ),
            179 => 
            array (
                'id' => 410,
                'name' => 'Price Range properties',
                'parent' => 'Price Range',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 16:20:20',
                'updated_at' => '2024-04-23 16:20:20',
            ),
            180 => 
            array (
                'id' => 411,
                'name' => 'Price Range print',
                'parent' => 'Price Range',
                'guard_name' => 'web',
                'created_at' => '2024-04-23 16:20:20',
                'updated_at' => '2024-04-23 16:20:20',
            ),
            181 => 
            array (
                'id' => 412,
                'name' => 'Create Product create',
                'parent' => 'Create Product',
                'guard_name' => 'web',
                'created_at' => '2024-04-24 00:59:57',
                'updated_at' => '2024-04-24 00:59:57',
            ),
            182 => 
            array (
                'id' => 413,
                'name' => 'Create Product index',
                'parent' => 'Create Product',
                'guard_name' => 'web',
                'created_at' => '2024-04-24 00:59:57',
                'updated_at' => '2024-04-24 00:59:57',
            ),
            183 => 
            array (
                'id' => 414,
                'name' => 'Create Product show',
                'parent' => 'Create Product',
                'guard_name' => 'web',
                'created_at' => '2024-04-24 00:59:58',
                'updated_at' => '2024-04-24 00:59:58',
            ),
            184 => 
            array (
                'id' => 415,
                'name' => 'Create Product edit',
                'parent' => 'Create Product',
                'guard_name' => 'web',
                'created_at' => '2024-04-24 00:59:58',
                'updated_at' => '2024-04-24 00:59:58',
            ),
            185 => 
            array (
                'id' => 416,
                'name' => 'Create Product destroy',
                'parent' => 'Create Product',
                'guard_name' => 'web',
                'created_at' => '2024-04-24 00:59:58',
                'updated_at' => '2024-04-24 00:59:58',
            ),
            186 => 
            array (
                'id' => 417,
                'name' => 'Create Product trash',
                'parent' => 'Create Product',
                'guard_name' => 'web',
                'created_at' => '2024-04-24 00:59:58',
                'updated_at' => '2024-04-24 00:59:58',
            ),
            187 => 
            array (
                'id' => 418,
                'name' => 'Create Product restore',
                'parent' => 'Create Product',
                'guard_name' => 'web',
                'created_at' => '2024-04-24 00:59:58',
                'updated_at' => '2024-04-24 00:59:58',
            ),
            188 => 
            array (
                'id' => 419,
                'name' => 'Create Product delete',
                'parent' => 'Create Product',
                'guard_name' => 'web',
                'created_at' => '2024-04-24 00:59:58',
                'updated_at' => '2024-04-24 00:59:58',
            ),
            189 => 
            array (
                'id' => 420,
                'name' => 'Create Product status',
                'parent' => 'Create Product',
                'guard_name' => 'web',
                'created_at' => '2024-04-24 00:59:58',
                'updated_at' => '2024-04-24 00:59:58',
            ),
            190 => 
            array (
                'id' => 421,
                'name' => 'Create Product properties',
                'parent' => 'Create Product',
                'guard_name' => 'web',
                'created_at' => '2024-04-24 00:59:58',
                'updated_at' => '2024-04-24 00:59:58',
            ),
            191 => 
            array (
                'id' => 422,
                'name' => 'Create Product print',
                'parent' => 'Create Product',
                'guard_name' => 'web',
                'created_at' => '2024-04-24 00:59:58',
                'updated_at' => '2024-04-24 00:59:58',
            ),
            192 => 
            array (
                'id' => 423,
                'name' => 'Shipping create',
                'parent' => 'Shipping',
                'guard_name' => 'web',
                'created_at' => '2024-04-25 15:51:21',
                'updated_at' => '2024-04-25 15:51:21',
            ),
            193 => 
            array (
                'id' => 424,
                'name' => 'Shipping index',
                'parent' => 'Shipping',
                'guard_name' => 'web',
                'created_at' => '2024-04-25 15:51:21',
                'updated_at' => '2024-04-25 15:51:21',
            ),
            194 => 
            array (
                'id' => 425,
                'name' => 'Shipping show',
                'parent' => 'Shipping',
                'guard_name' => 'web',
                'created_at' => '2024-04-25 15:51:21',
                'updated_at' => '2024-04-25 15:51:21',
            ),
            195 => 
            array (
                'id' => 426,
                'name' => 'Shipping edit',
                'parent' => 'Shipping',
                'guard_name' => 'web',
                'created_at' => '2024-04-25 15:51:21',
                'updated_at' => '2024-04-25 15:51:21',
            ),
            196 => 
            array (
                'id' => 427,
                'name' => 'Shipping destroy',
                'parent' => 'Shipping',
                'guard_name' => 'web',
                'created_at' => '2024-04-25 15:51:21',
                'updated_at' => '2024-04-25 15:51:21',
            ),
            197 => 
            array (
                'id' => 428,
                'name' => 'Shipping trash',
                'parent' => 'Shipping',
                'guard_name' => 'web',
                'created_at' => '2024-04-25 15:51:21',
                'updated_at' => '2024-04-25 15:51:21',
            ),
            198 => 
            array (
                'id' => 429,
                'name' => 'Shipping restore',
                'parent' => 'Shipping',
                'guard_name' => 'web',
                'created_at' => '2024-04-25 15:51:21',
                'updated_at' => '2024-04-25 15:51:21',
            ),
            199 => 
            array (
                'id' => 430,
                'name' => 'Shipping delete',
                'parent' => 'Shipping',
                'guard_name' => 'web',
                'created_at' => '2024-04-25 15:51:21',
                'updated_at' => '2024-04-25 15:51:21',
            ),
            200 => 
            array (
                'id' => 431,
                'name' => 'Shipping status',
                'parent' => 'Shipping',
                'guard_name' => 'web',
                'created_at' => '2024-04-25 15:51:21',
                'updated_at' => '2024-04-25 15:51:21',
            ),
            201 => 
            array (
                'id' => 432,
                'name' => 'Shipping properties',
                'parent' => 'Shipping',
                'guard_name' => 'web',
                'created_at' => '2024-04-25 15:51:21',
                'updated_at' => '2024-04-25 15:51:21',
            ),
            202 => 
            array (
                'id' => 433,
                'name' => 'Shipping print',
                'parent' => 'Shipping',
                'guard_name' => 'web',
                'created_at' => '2024-04-25 15:51:21',
                'updated_at' => '2024-04-25 15:51:21',
            ),
            203 => 
            array (
                'id' => 434,
                'name' => 'Cuppon create',
                'parent' => 'Cuppon',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:17:17',
                'updated_at' => '2024-04-27 16:17:17',
            ),
            204 => 
            array (
                'id' => 435,
                'name' => 'Cuppon index',
                'parent' => 'Cuppon',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:17:18',
                'updated_at' => '2024-04-27 16:17:18',
            ),
            205 => 
            array (
                'id' => 436,
                'name' => 'Cuppon show',
                'parent' => 'Cuppon',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:17:18',
                'updated_at' => '2024-04-27 16:17:18',
            ),
            206 => 
            array (
                'id' => 437,
                'name' => 'Cuppon edit',
                'parent' => 'Cuppon',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:17:18',
                'updated_at' => '2024-04-27 16:17:18',
            ),
            207 => 
            array (
                'id' => 438,
                'name' => 'Cuppon destroy',
                'parent' => 'Cuppon',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:17:18',
                'updated_at' => '2024-04-27 16:17:18',
            ),
            208 => 
            array (
                'id' => 439,
                'name' => 'Cuppon trash',
                'parent' => 'Cuppon',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:17:18',
                'updated_at' => '2024-04-27 16:17:18',
            ),
            209 => 
            array (
                'id' => 440,
                'name' => 'Cuppon restore',
                'parent' => 'Cuppon',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:17:18',
                'updated_at' => '2024-04-27 16:17:18',
            ),
            210 => 
            array (
                'id' => 441,
                'name' => 'Cuppon delete',
                'parent' => 'Cuppon',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:17:18',
                'updated_at' => '2024-04-27 16:17:18',
            ),
            211 => 
            array (
                'id' => 442,
                'name' => 'Cuppon status',
                'parent' => 'Cuppon',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:17:18',
                'updated_at' => '2024-04-27 16:17:18',
            ),
            212 => 
            array (
                'id' => 443,
                'name' => 'Cuppon properties',
                'parent' => 'Cuppon',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:17:18',
                'updated_at' => '2024-04-27 16:17:18',
            ),
            213 => 
            array (
                'id' => 444,
                'name' => 'Cuppon print',
                'parent' => 'Cuppon',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:17:18',
                'updated_at' => '2024-04-27 16:17:18',
            ),
            214 => 
            array (
                'id' => 445,
                'name' => 'Trend create',
                'parent' => 'Trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:18:03',
                'updated_at' => '2024-04-27 16:18:03',
            ),
            215 => 
            array (
                'id' => 446,
                'name' => 'Trend index',
                'parent' => 'Trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:18:03',
                'updated_at' => '2024-04-27 16:18:03',
            ),
            216 => 
            array (
                'id' => 447,
                'name' => 'Trend show',
                'parent' => 'Trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:18:03',
                'updated_at' => '2024-04-27 16:18:03',
            ),
            217 => 
            array (
                'id' => 448,
                'name' => 'Trend edit',
                'parent' => 'Trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:18:03',
                'updated_at' => '2024-04-27 16:18:03',
            ),
            218 => 
            array (
                'id' => 449,
                'name' => 'Trend destroy',
                'parent' => 'Trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:18:03',
                'updated_at' => '2024-04-27 16:18:03',
            ),
            219 => 
            array (
                'id' => 450,
                'name' => 'Trend trash',
                'parent' => 'Trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:18:03',
                'updated_at' => '2024-04-27 16:18:03',
            ),
            220 => 
            array (
                'id' => 451,
                'name' => 'Trend restore',
                'parent' => 'Trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:18:04',
                'updated_at' => '2024-04-27 16:18:04',
            ),
            221 => 
            array (
                'id' => 452,
                'name' => 'Trend delete',
                'parent' => 'Trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:18:04',
                'updated_at' => '2024-04-27 16:18:04',
            ),
            222 => 
            array (
                'id' => 453,
                'name' => 'Trend status',
                'parent' => 'Trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:18:04',
                'updated_at' => '2024-04-27 16:18:04',
            ),
            223 => 
            array (
                'id' => 454,
                'name' => 'Trend properties',
                'parent' => 'Trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:18:04',
                'updated_at' => '2024-04-27 16:18:04',
            ),
            224 => 
            array (
                'id' => 455,
                'name' => 'Trend print',
                'parent' => 'Trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:18:04',
                'updated_at' => '2024-04-27 16:18:04',
            ),
            225 => 
            array (
                'id' => 456,
                'name' => 'Add product to trend create',
                'parent' => 'Add product to trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:21:01',
                'updated_at' => '2024-04-27 16:21:01',
            ),
            226 => 
            array (
                'id' => 457,
                'name' => 'Add product to trend index',
                'parent' => 'Add product to trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:21:01',
                'updated_at' => '2024-04-27 16:21:01',
            ),
            227 => 
            array (
                'id' => 458,
                'name' => 'Add product to trend show',
                'parent' => 'Add product to trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:21:01',
                'updated_at' => '2024-04-27 16:21:01',
            ),
            228 => 
            array (
                'id' => 459,
                'name' => 'Add product to trend edit',
                'parent' => 'Add product to trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:21:01',
                'updated_at' => '2024-04-27 16:21:01',
            ),
            229 => 
            array (
                'id' => 460,
                'name' => 'Add product to trend destroy',
                'parent' => 'Add product to trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:21:01',
                'updated_at' => '2024-04-27 16:21:01',
            ),
            230 => 
            array (
                'id' => 461,
                'name' => 'Add product to trend trash',
                'parent' => 'Add product to trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:21:01',
                'updated_at' => '2024-04-27 16:21:01',
            ),
            231 => 
            array (
                'id' => 462,
                'name' => 'Add product to trend restore',
                'parent' => 'Add product to trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:21:01',
                'updated_at' => '2024-04-27 16:21:01',
            ),
            232 => 
            array (
                'id' => 463,
                'name' => 'Add product to trend delete',
                'parent' => 'Add product to trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:21:01',
                'updated_at' => '2024-04-27 16:21:01',
            ),
            233 => 
            array (
                'id' => 464,
                'name' => 'Add product to trend status',
                'parent' => 'Add product to trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:21:01',
                'updated_at' => '2024-04-27 16:21:01',
            ),
            234 => 
            array (
                'id' => 465,
                'name' => 'Add product to trend properties',
                'parent' => 'Add product to trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:21:01',
                'updated_at' => '2024-04-27 16:21:01',
            ),
            235 => 
            array (
                'id' => 466,
                'name' => 'Add product to trend print',
                'parent' => 'Add product to trend',
                'guard_name' => 'web',
                'created_at' => '2024-04-27 16:21:01',
                'updated_at' => '2024-04-27 16:21:01',
            ),
            236 => 
            array (
                'id' => 467,
                'name' => 'Customer Orders create',
                'parent' => 'Customer Orders',
                'guard_name' => 'web',
                'created_at' => '2024-04-28 15:07:09',
                'updated_at' => '2024-04-28 15:07:09',
            ),
            237 => 
            array (
                'id' => 468,
                'name' => 'Customer Orders index',
                'parent' => 'Customer Orders',
                'guard_name' => 'web',
                'created_at' => '2024-04-28 15:07:09',
                'updated_at' => '2024-04-28 15:07:09',
            ),
            238 => 
            array (
                'id' => 469,
                'name' => 'Customer Orders show',
                'parent' => 'Customer Orders',
                'guard_name' => 'web',
                'created_at' => '2024-04-28 15:07:09',
                'updated_at' => '2024-04-28 15:07:09',
            ),
            239 => 
            array (
                'id' => 470,
                'name' => 'Customer Orders edit',
                'parent' => 'Customer Orders',
                'guard_name' => 'web',
                'created_at' => '2024-04-28 15:07:09',
                'updated_at' => '2024-04-28 15:07:09',
            ),
            240 => 
            array (
                'id' => 471,
                'name' => 'Customer Orders destroy',
                'parent' => 'Customer Orders',
                'guard_name' => 'web',
                'created_at' => '2024-04-28 15:07:09',
                'updated_at' => '2024-04-28 15:07:09',
            ),
            241 => 
            array (
                'id' => 472,
                'name' => 'Customer Orders trash',
                'parent' => 'Customer Orders',
                'guard_name' => 'web',
                'created_at' => '2024-04-28 15:07:09',
                'updated_at' => '2024-04-28 15:07:09',
            ),
            242 => 
            array (
                'id' => 473,
                'name' => 'Customer Orders restore',
                'parent' => 'Customer Orders',
                'guard_name' => 'web',
                'created_at' => '2024-04-28 15:07:09',
                'updated_at' => '2024-04-28 15:07:09',
            ),
            243 => 
            array (
                'id' => 474,
                'name' => 'Customer Orders delete',
                'parent' => 'Customer Orders',
                'guard_name' => 'web',
                'created_at' => '2024-04-28 15:07:09',
                'updated_at' => '2024-04-28 15:07:09',
            ),
            244 => 
            array (
                'id' => 475,
                'name' => 'Customer Orders status',
                'parent' => 'Customer Orders',
                'guard_name' => 'web',
                'created_at' => '2024-04-28 15:07:09',
                'updated_at' => '2024-04-28 15:07:09',
            ),
            245 => 
            array (
                'id' => 476,
                'name' => 'Customer Orders properties',
                'parent' => 'Customer Orders',
                'guard_name' => 'web',
                'created_at' => '2024-04-28 15:07:09',
                'updated_at' => '2024-04-28 15:07:09',
            ),
            246 => 
            array (
                'id' => 477,
                'name' => 'Customer Orders print',
                'parent' => 'Customer Orders',
                'guard_name' => 'web',
                'created_at' => '2024-04-28 15:07:09',
                'updated_at' => '2024-04-28 15:07:09',
            ),
            247 => 
            array (
                'id' => 489,
                'name' => 'Slider Settings create',
                'parent' => 'Slider Settings',
                'guard_name' => 'web',
                'created_at' => '2024-04-30 11:15:41',
                'updated_at' => '2024-04-30 11:15:41',
            ),
            248 => 
            array (
                'id' => 490,
                'name' => 'Slider Settings index',
                'parent' => 'Slider Settings',
                'guard_name' => 'web',
                'created_at' => '2024-04-30 11:15:41',
                'updated_at' => '2024-04-30 11:15:41',
            ),
            249 => 
            array (
                'id' => 491,
                'name' => 'Slider Settings show',
                'parent' => 'Slider Settings',
                'guard_name' => 'web',
                'created_at' => '2024-04-30 11:15:41',
                'updated_at' => '2024-04-30 11:15:41',
            ),
            250 => 
            array (
                'id' => 492,
                'name' => 'Slider Settings edit',
                'parent' => 'Slider Settings',
                'guard_name' => 'web',
                'created_at' => '2024-04-30 11:15:41',
                'updated_at' => '2024-04-30 11:15:41',
            ),
            251 => 
            array (
                'id' => 493,
                'name' => 'Slider Settings destroy',
                'parent' => 'Slider Settings',
                'guard_name' => 'web',
                'created_at' => '2024-04-30 11:15:41',
                'updated_at' => '2024-04-30 11:15:41',
            ),
            252 => 
            array (
                'id' => 494,
                'name' => 'Slider Settings trash',
                'parent' => 'Slider Settings',
                'guard_name' => 'web',
                'created_at' => '2024-04-30 11:15:41',
                'updated_at' => '2024-04-30 11:15:41',
            ),
            253 => 
            array (
                'id' => 495,
                'name' => 'Slider Settings restore',
                'parent' => 'Slider Settings',
                'guard_name' => 'web',
                'created_at' => '2024-04-30 11:15:41',
                'updated_at' => '2024-04-30 11:15:41',
            ),
            254 => 
            array (
                'id' => 496,
                'name' => 'Slider Settings delete',
                'parent' => 'Slider Settings',
                'guard_name' => 'web',
                'created_at' => '2024-04-30 11:15:41',
                'updated_at' => '2024-04-30 11:15:41',
            ),
            255 => 
            array (
                'id' => 497,
                'name' => 'Slider Settings status',
                'parent' => 'Slider Settings',
                'guard_name' => 'web',
                'created_at' => '2024-04-30 11:15:41',
                'updated_at' => '2024-04-30 11:15:41',
            ),
            256 => 
            array (
                'id' => 498,
                'name' => 'Slider Settings properties',
                'parent' => 'Slider Settings',
                'guard_name' => 'web',
                'created_at' => '2024-04-30 11:15:41',
                'updated_at' => '2024-04-30 11:15:41',
            ),
            257 => 
            array (
                'id' => 499,
                'name' => 'Slider Settings print',
                'parent' => 'Slider Settings',
                'guard_name' => 'web',
                'created_at' => '2024-04-30 11:15:42',
                'updated_at' => '2024-04-30 11:15:42',
            ),
        ));
        
        
    }
}