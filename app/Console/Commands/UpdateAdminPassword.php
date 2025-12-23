<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class UpdateAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:update-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update admin password to 12345678';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Cari user admin dengan username 'admin'
        $admin = AdminUser::where('username', 'admin')->first();
        
        if (!$admin) {
            $this->error('Admin user not found!');
            $this->info('Trying to create admin user...');
            
            // Jika tidak ada, buat admin baru
            $admin = AdminUser::create([
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@pkl-kominfo.com',
                'password' => Hash::make('12345678'),
                'role' => 'super_admin',
                'is_active' => true,
            ]);
            
            $this->info('Admin user created successfully!');
        } else {
            // Update password
            $admin->password = Hash::make('12345678');
            $admin->save();
            
            $this->info('Admin password has been updated successfully!');
        }

        $this->info('Username: ' . $admin->username);
        $this->info('Email: ' . $admin->email);
        $this->info('New Password: 12345678');
        
        return 0;
    }
}
