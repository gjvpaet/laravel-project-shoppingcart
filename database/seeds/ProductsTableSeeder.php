<?php

use ShoppingCart\Product;
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
        $product = new Product([
            'image_path' => 'http://media.harrypotter.bloomsbury.com/rep/g/Harry%20Potter%20and%20the%20Philosopher\'s%20Stone%20%202.jpg',
            'title' => 'Harry Potter',
            'description' => 'Super cool - at least as a child.',
            'price' => 10
        ]);
        $product->save();

        $product = new Product([
            'image_path' => 'http://www.revelationz.net/images/book/gameofthrones3.jpg',
            'title' => 'A Song of Ice and Fire - A Storm of Swords',
            'description' => 'No one is going to survive!',
            'price' => 10
        ]);
        $product->save();

        $product = new Product([
            'image_path' => 'http://d.gr-assets.com/141111141641/33.jpg',
            'title' => 'Lord of the Rings',
            'description' => 'I found the movies to be better...',
            'price' => 20
        ]);
        $product->save();

        $product = new Product([
            'image_path' => 'http://ecx.images-amazon.com/images/I/919-FLL37TL.jpg',
            'title' => 'A Song of Ice and Fire - Game of Thrones',
            'description' => 'No one is going to survive!',
            'price' => 20
        ]);
        $product->save();

        $product = new Product([
            'image_path' => 'http://www.georgerrmartin.com/wp-content/uploads/2012/08/feastforcrows.jpg',
            'title' => 'A Song of Ice and Fire - A Feast for Crows',
            'description' => 'Still, no one is going to survive!',
            'price' => 20
        ]);
        $product->save();
    }
}
