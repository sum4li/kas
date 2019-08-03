<?php

use Illuminate\Database\Seeder;

class account_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = ['saldo','Sumbangan Perseorangan','Sumbangan Pengusaha','Iuran Anggota'];
        foreach($account as $key => $row){
            App\Account::create([
                'name'=>$row,
                'slug'=>str_slug($row)
            ]);
        }
    }
}
