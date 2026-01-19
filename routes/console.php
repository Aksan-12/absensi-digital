<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use Illuminate\Support\Facades\Hash;

Artisan::command('users:rehash-passwords', function () {
    $this->comment('Scanning users and re-hashing plain-text passwords...');

    $count = 0;

    foreach (App\Models\User::cursor() as $user) {
        $pwd = $user->password;

        // If password looks like a hashed password (bcrypt/argon), skip
        if (is_string($pwd) && preg_match('/^\$(2y|2a|argon2i|argon2id)\$/', $pwd)) {
            continue;
        }

        // If password is empty or null, skip
        if (empty($pwd)) {
            continue;
        }

        // Re-hash the current value and save
        $user->password = Hash::make($pwd);
        $user->save();
        $count++;
        $this->info("Re-hashed password for: {$user->email}");
    }

    $this->comment("Done. Re-hashed {$count} users.");
})->describe('Re-hash plain-text user passwords stored in the database');
