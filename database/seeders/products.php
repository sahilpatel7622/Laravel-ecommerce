<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class products extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'Redmi Note 15',
            'price' => '₹30,999',
            'category' => 'Mobiles',
            'gallery' => 'https://m.media-amazon.com/images/I/81UgjzCNSrL._SX679_.jpg',
            'description' => 'REDMI Note 15 Pro 5G (Silver Ash 8GB+256GB) | 200MasterPixel OIS Camera | Dimensity 7400-Ultra | 17.3cm CrystalRes AMOLED Screen |'
        ]
        );
         DB::table('products')->insert([
            'name' => 'Apple iPhone 16 Pro',
            'price' => '₹1,59,900',
            'category' => 'Mobiles',
            'gallery' => 'https://m.media-amazon.com/images/I/619oqSJVY5L._SX679_.jpg',
            'description' => 'iPhone 16 Pro Max 1 TB: 5G Mobile Phone with Camera Control, 4K 120 fps Dolby Vision and a Huge Leap in Battery Life. Works with AirPods; Black Titanium'
        ]);
         DB::table('products')->insert([
            'name' => 'Samsung Galaxy S23 Ultra',
            'price' => '₹1,09,999',
            'category' => 'Mobiles',
            'gallery' => 'https://m.media-amazon.com/images/I/71qGismu6NL._SX679_.jpg',
            'description' => 'Samsung Galaxy S23 FE 5G (Mint, 8GB, 128GB Storage)'
        ]);
         DB::table('products')->insert([
            'name' => 'OnePlus 15R 5G',
            'price' => '₹49,999',
            'category' => 'Mobiles',
            'gallery' => 'https://m.media-amazon.com/images/I/61AsNTuJ6mL._SX679_.jpg',
            'description' => 'The OnePlus 15R 5G is a mid-range smartphone that offers a range of features and specifications.'
        ]);
         DB::table('products')->insert([
            'name' => 'Google Pixel 7 Pro',
            'price' => '₹34,999',
            'category' => 'Mobiles',
            'gallery' => 'https://m.media-amazon.com/images/I/51OFxuD1GgL._SX522_.jpg',
            'description' => 'Google Pixel 7 Pro (Obsidian, 128 GB) (12 GB RAM)'
        ]);
        DB::table('products')->insert([
            'name' => 'LG',
            'price' => '₹70,000',
            'category' => 'TV',
            'gallery' => 'https://m.media-amazon.com/images/I/71yz55f1VlL._SX522_.jpg',
            'description' => 'LG 139 cm (55 Inches) UR7500 AI Series 4K Ultra HD (3840 x 2160) LED Smart TV (Black) (2020 Model)'
        ]);
         DB::table('products')->insert([
            'name' => 'Samsung',
            'price' => '₹80,000',
            'category' => 'TV',
            'gallery' => 'https://m.media-amazon.com/images/I/81GeWU+aNGL._SX522_.jpg',
            'description' => 'Samsung 139 cm (55 inches) QN90C Neo QLED 4K Ultra HD Smart TV (Black)'
        ]);
         DB::table('products')->insert([
            'name' => 'Sony',
            'price' => '₹63,000',
            'category' => 'TV',
            'gallery' => 'https://m.media-amazon.com/images/I/81Vs1ZXn43L._SX522_.jpg',
            'description' => 'Sony 139 cm (55 inches) X80K Series 4K Ultra HD Smart LED Google TV XR55X80K'
        ]);
         DB::table('products')->insert([
            'name' => 'Toshiba',
            'price' => '₹30,000',
            'category' => 'TV',
            'gallery' => 'https://m.media-amazon.com/images/I/9121McCSSxL._SX522_.jpg',
            'description' => 'Toshiba 139 cm (55 inches) C350NP Series 4K Ultra HD Smart LED Google TV 55C350NP (Black)'
        ]);
         DB::table('products')->insert([
            'name' => 'TCL TV',
            'price' => '₹35,000',
            'category' => 'TV',
            'gallery' => 'https://m.media-amazon.com/images/I/71BXyInFv8L._SX522_.jpg',
            'description' => 'TCL 139 cm (55 inches) 4K UHD Smart QLED Google TV 55T6C (Black)'
        ]);
    }   
}
