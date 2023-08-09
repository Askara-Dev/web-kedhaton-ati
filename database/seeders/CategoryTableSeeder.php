<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(
        [
            [
                'title' => 'berita',
                'slug' => 'berita',
                'description' => 'kategori berita',
                'thumbnail' => 'noiamge.jpg',
                'created_at' => date("Y-m-d H-i-s"),
                'updated_at' => date("Y-m-d H-i-s"),
                'parent_id' => null
            ],
            [
                'title' => 'budaya',
                'slug' => 'budaya',
                'description' => 'kategori budaya',
                'thumbnail' => 'noiamge.jpg',
                'created_at' => date("Y-m-d H-i-s"),
                'updated_at' => date("Y-m-d H-i-s"),
                'parent_id' => null
            ],
            [
                'title' => 'sejarah',
                'slug' => 'sejarah',
                'description' => 'kategori sejarah',
                'thumbnail' => 'noiamge.jpg',
                'created_at' => date("Y-m-d H-i-s"),
                'updated_at' => date("Y-m-d H-i-s"),
                'parent_id' => null
            ],
            [
                'title' => 'wayang',
                'slug' => 'wayang',
                'description' => 'kategori wayang',
                'thumbnail' => 'noiamge.jpg',
                'created_at' => date("Y-m-d H-i-s"),
                'updated_at' => date("Y-m-d H-i-s"),
                'parent_id' => null
            ]

        ]);
    }
}
