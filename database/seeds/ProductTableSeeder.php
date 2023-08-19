<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
                'imagePath' =>'images\horseriding.jpg',
                'title' => 'Ιππασία',
                'description' =>'Διάρκεια: 15΄ ',
                'price' => '10',
                'days' => 'Δευτέρα & Τετάρτη',
                'times' => '08:00-14:00'
                
        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath' =>'images\painting.jpg',
            'title' => 'Καλλιτεχνικά',
            'description' =>'Διάρκεια: 5 ώρες΄',
            'price' => '40',
            'days' => 'Τρίτη & Πέμπτη',
            'times' => '11:00-17:00'
         ]);
        $product->save();

        $product = new \App\Product([
            'imagePath' =>'images\guidestour.jpg',
            'title' => 'Ξενάγηση',
            'description' =>' Πεζοπορία και ξενάγηση Στα περίχωρα όπως Βίταλα, Αντρονιάνοι, μαλετιάνοι πλατάνα. Διάρκεια: 6 ώρες ',
            'price' => '50',
            'days' => 'Σάββατο & Κυριακή',
            'times' => '12:00-18:00'
        ]);
        $product->save();        
            }
        }
