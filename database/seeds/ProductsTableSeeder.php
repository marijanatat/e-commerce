<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        for( $i=1;$i<=30;$i++){
        Product::create([
            'name' => 'Laptop' . $i,
            'slug' => 'laptop-'.$i,
            'details' => [13,14,15][array_rand([13,14,15])]. 'inch, ' .[1,2,3][array_rand([1,2,3])]. 'TB SSD,32GB RAM ',
            'price' => rand(30000,200000),
            'description' => 'Lorem'. $i.' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            'image' => 'products/dummy/laptop-'.$i.'.jpg',
                'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
        ])->categories()->attach(1);
        }
        
        $product=Product::find(1);
        $product->categories()->attach(2);

        for($i=1;$i<=9;$i++){
            Product::create([
                'name' => 'Desktop' . $i,
                'slug' => 'Desktop-'.$i,
                'details' => [24,25,27][array_rand([24,25,27])]. 'inch, ' .[1,2,3][array_rand([1,2,3])]. 'TB SSD,32GB RAM ',
                'price' => rand(20000,200000),
                'description' => 'Lorem'. $i.' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/desktop-'.$i.'.jpg',
                'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
            ])>categories()->attach(2);
            }

            for($i=1;$i<=9;$i++){
                Product::create([
                    'name' => 'Phone' . $i,
                    'slug' => 'Phone-'.$i,
                    'details' => [16,32,64][array_rand([16,32,64])]. 'inch, ' .[7,8,9][array_rand([7,8,9])]. 'TB SSD,32GB RAM ',
                    'price' => rand(5000,200000),
                    'description' => 'Lorem'. $i.' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                    'image' => 'products/dummy/phone-'.$i.'.jpg',
                'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
                ])>categories()->attach(3);
                }

    
    }
}
