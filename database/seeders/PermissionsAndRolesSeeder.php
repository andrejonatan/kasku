<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsAndRolesSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

    $permissions = [
        // AkunUser
        'view-any AkunUser',
        'view AkunUser',
        'create AkunUser',
        'update AkunUser',
        'delete AkunUser',

        // Jabatan
        'view-any Jabatan',
        'view Jabatan',
        'create Jabatan',
        'update Jabatan',
        'delete Jabatan',

        // JenisIuran
        'view-any JenisIuran',
        'view JenisIuran',
        'create JenisIuran',
        'update JenisIuran',
        'delete JenisIuran',

        // KategoriTransaksi
        'view-any KategoriTransaksi',
        'view KategoriTransaksi',
        'create KategoriTransaksi',
        'update KategoriTransaksi',
        'delete KategoriTransaksi',

        // KegiatanKelas
        'view-any KegiatanKelas',
        'view KegiatanKelas',
        'create KegiatanKelas',
        'update KegiatanKelas',
        'delete KegiatanKelas',

        // LogAktivitas
        'view-any LogAktivitas',
        'view LogAktivitas',
        'create LogAktivitas',
        'update LogAktivitas',
        'delete LogAktivitas',

        // PembayaranIuran
        'view-any PembayaranIuran',
        'view PembayaranIuran',
        'create PembayaranIuran',
        'update PembayaranIuran',
        'delete PembayaranIuran',

        // Periode
        'view-any Periode',
        'view Periode',
        'create Periode',
        'update Periode',
        'delete Periode',

        // Transaksi
        'view-any Transaksi',
        'view Transaksi',
        'create Transaksi',
        'update Transaksi',
        'delete Transaksi',
    ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $bendaharaRole = Role::firstOrCreate(['name' => 'Bendahara']);
        $anggotaRole = Role::firstOrCreate(['name' => 'Anggota']);

        $adminRole->syncPermissions(Permission::all());

        $bendaharaRole->syncPermissions([
        // AkunUser
        'view-any AkunUser',
        'view AkunUser',
        'create AkunUser',
        'update AkunUser',

        // Jabatan
        'view-any Jabatan',
        'view Jabatan',
        'create Jabatan',
        'update Jabatan',

        // JenisIuran
        'view-any JenisIuran',
        'view JenisIuran',
        'create JenisIuran',
        'update JenisIuran',

        // KategoriTransaksi
        'view-any KategoriTransaksi',
        'view KategoriTransaksi',
        'create KategoriTransaksi',
        'update KategoriTransaksi',

        // KegiatanKelas
        'view-any KegiatanKelas',
        'view KegiatanKelas',
        'create KegiatanKelas',
        'update KegiatanKelas',

        // LogAktivitas
        'view-any LogAktivitas',
        'view LogAktivitas',
        'create LogAktivitas',
        'update LogAktivitas',

        // PembayaranIuran
        'view-any PembayaranIuran',
        'view PembayaranIuran',
        'create PembayaranIuran',
        'update PembayaranIuran',

        // Periode
        'view-any Periode',
        'view Periode',
        'create Periode',
        'update Periode',

        // Transaksi
        'view-any Transaksi',
        'view Transaksi',
        'create Transaksi',
        'update Transaksi',
    ]);


    $anggotaRole->syncPermissions([
        'view-any AkunUser',
        'view AkunUser',

        'view-any Jabatan',
        'view Jabatan',

        'view-any JenisIuran',
        'view JenisIuran',

        'view-any KategoriTransaksi',
        'view KategoriTransaksi',

        'view-any KegiatanKelas',
        'view KegiatanKelas',

        'view-any LogAktivitas',
        'view LogAktivitas',

        'view-any PembayaranIuran',
        'view PembayaranIuran',

        'view-any Periode',
        'view Periode',

        'view-any Transaksi',
        'view Transaksi',
    ]);

    }
}