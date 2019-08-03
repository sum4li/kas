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
            'SM 04',
            'Jl. Kacangan - Pelemrejo Km 1. Kacangan, Andong, Boyolali',
            '021-29335597',
            'sekawanmuda04@gmail.com'
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
