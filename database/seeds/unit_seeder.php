<?php

use Illuminate\Database\Seeder;

class unit_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit = [
            ['name'=>'BAG','description'=>'bag, sack, tote'],
            ['name'=>'BBL','description'=>'barrel'],
            ['name'=>'BDL','description'=>'banded bundle, bundle, bale'],
            ['name'=>'BIN','description'=>'bin, tray'],
            ['name'=>'BOX','description'=>'box, cage, wooden box'],
            ['name'=>'CAN','description'=>'bottle, bucket, canister, 5-gal. pail, pail'],
            ['name'=>'CAS','description'=>'chest, case'],
            ['name'=>'CNT','description'=>'container'],
            ['name'=>'CRT','description'=>'banded crate, crate, wooden crate'],
            ['name'=>'CSK','description'=>'cask'],
            ['name'=>'CTN','description'=>'carton, fiberboard carton'],
            ['name'=>'CYL','description'=>'cylinder'],
            ['name'=>'DRM','description'=>'barrel, drum, fiberboard drum, 55-gal. drum, 5-gal. drum, steel drum, vat'],
            ['name'=>'KEG','description'=>'jug, keg'],
            ['name'=>'PCS','description'=>'loose, piece'],
            ['name'=>'PKG','description'=>'basket, envelope, gaylord, package, packet, rack'],
            ['name'=>'PLT','description'=>'banded, crated or loose on pallet; pallet box; pallet; shrink-wrap pallet; slipsheet; wooden pallet'],
            ['name'=>'ROL','description'=>'coil, reel, roll, spool'],
            ['name'=>'SKD','description'=>'banded or loose on skid, skid, wooden skid'],
            ['name'=>'TBE','description'=>'fibertube, tube'],
            ['name'=>'TRK','description'=>'trunk'],
            ['name'=>'TNK','description'=>'tank']
        ];

        foreach($unit as $row){
            App\Unit::Create([
                'name'=>$row['name'],
                'slug'=>str_slug($row['name']),
                'description'=>$row['description']
            ]);
        }

        $currency = [
            ['name'=>'USD','country_name'=>'United State America'],
            ['name'=>'IDR','country_name'=>'Indonesia']
        ];

        foreach($currency as $row){
            App\Currency::create([
                'name'=>$row['name'],
                'slug'=>str_slug($row['name']),
                'country_name'=>$row['country_name']
            ]);
        }
    }
}
