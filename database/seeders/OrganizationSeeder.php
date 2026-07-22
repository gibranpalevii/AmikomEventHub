<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::create([
            'name' => 'HIMA Sistem Informasi',
            'code' => 'HIMASI',
            'description' => 'Himpunan Mahasiswa Sistem Informasi',
            'status' => 'active',
        ]);

        Organization::create([
            'name' => 'HIMA Informatika',
            'code' => 'HIMATIKA',
            'description' => 'Himpunan Mahasiswa Informatika',
            'status' => 'active',
        ]);

        Organization::create([
            'name' => 'BEM Universitas',
            'code' => 'BEM',
            'description' => 'Badan Eksekutif Mahasiswa',
            'status' => 'active',
        ]);

        Organization::create([
            'name' => 'UKM Musik',
            'code' => 'UKMMS',
            'description' => 'Unit Kegiatan Mahasiswa Musik',
            'status' => 'active',
        ]);
    }
}