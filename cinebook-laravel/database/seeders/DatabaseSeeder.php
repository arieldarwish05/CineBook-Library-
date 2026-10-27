<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            "type" => "Book",
            "title" => "The Hobbit",
            "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfsmyEYWiN_Gptd0jFiuLALNnXqul2Es3PNznfIkYAqw&s=10",
            "detailLabel" => "Author",
            "detailVal" => "J.R.R. Tolkien",
            "price" => "$14.99"
        ]);

        Book::create([
            "type" => "Movie",
            "title" => "Inception",
            "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxU6bmdSQjOPJzxiHI8oK60vo0WLoUQQ6gxw-UoyusBg&s=10",
            "detailLabel" => "Director",
            "detailVal" => "Christopher Nolan",
            "price" => "$19.99"
        ]);

        Book::create([
            "type" => "Audio",
            "title" => "Thriller Album",
            "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfsmyEYWiN_Gptd0jFiuLALNnXqul2Es3PNznfIkYAqw&s=10",
            "detailLabel" => "Artist",
            "detailVal" => "Michael Jackson",
            "price" => "$9.99"
        ]);

        




    }
}