<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'id' => '1',
            'name' => 'yolo',
            'secret' => 'MfiPWz5UNqB5BgxnwK0YuZ0ueI0byxBJIaObRtzy',
            'redirect' => env('APP_URL'),
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
