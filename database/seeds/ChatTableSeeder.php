<?php

use Illuminate\Database\Seeder;

class ChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i <= 10 ; $i++) {
            \App\Models\Chat::create([
                'body' => $i .'番目メッセージサンプル',
                'user_id' => 0
            ]);
        }
    }
}
