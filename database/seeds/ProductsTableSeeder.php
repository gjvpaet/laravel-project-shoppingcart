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
            'image_path' => 'http://media.bloomsbury.com/rep/bj/9780747573609.jpg',
            'title' => 'Harry Potter',
            'description' => 'No one is going to survive!',
            'price' => 10
        ]);
        $product->save();

        $product = new Product([
            'image_path' => 'http://ecx.images-amazon.com/images/I/91ssa1Ggt8L.jpg',
            'title' => 'Harry Potter',
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
