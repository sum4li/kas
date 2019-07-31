<?php

use Illuminate\Database\Seeder;

class setting_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $name=['Nama Toko','Alamat','Nomer Telepon','Email'];
        $type=['text','text','text','text'];
        $description=[
            'TEG',
            'Jl. Raya Serang Km.39,5 Kec. Parigi Serang',
            '021-29335597',
            'transecomet@transecomet.com'
        ];
        for($i=0;$i<count($name);$i++){

            App\Setting::create([
                'id'=>$faker->uuid,
                'name'=> $name[$i],
                'slug'=> str_slug($name[$i]),
                'type'=> $type[$i],
                'description'=> $description[$i]
            ]);
        }
    }
}
