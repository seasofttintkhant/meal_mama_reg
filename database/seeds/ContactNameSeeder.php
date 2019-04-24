<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Kinder;

class ContactNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kinders = Kinder::all();

        foreach($kinders as $kinder){
            $user = User::find($kinder->kinder_user_id);
            $user->contact_name = $kinder->contact_name;
            $user->update();
        }
    }
}
