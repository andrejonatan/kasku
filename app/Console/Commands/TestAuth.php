<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:test-auth')]
#[Description('Command description')]
class TestAuth extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = 'testuser_' . time();
        $password = 'password123';
        
        $user = \App\Models\AkunUser::create([
            'username' => $username,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'role' => 'Anggota',
            'nim' => time(),
            'nama_user' => 'Test User',
            'jenis_kelamin' => 'L',
            'no_hp' => time(),
            'email' => time() . '@test.com',
            'id_jabatan' => 1,
            'is_admin' => 0,
        ]);
        
        $this->info("Created user: " . $user->username);
        
        $result = \Illuminate\Support\Facades\Auth::guard('web')->attempt(['username' => $username, 'password' => $password]);
        $this->info("Auth attempt with correct password: " . ($result ? 'success' : 'failed'));
        
        if ($result) {
            $this->info("Logged in user ID: " . \Illuminate\Support\Facades\Auth::id());
        }
    }
}
