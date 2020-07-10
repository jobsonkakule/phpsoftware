<?php

use App\Connection;

require (dirname(__DIR__) . '/vendor/autoload.php');
$faker = Faker\Factory::create('fr_FR');

$pdo = Connection::getPDO();

// $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
// $pdo->exec('TRUNCATE TABLE post_category');
// $pdo->exec('TRUNCATE TABLE post');
// $pdo->exec('TRUNCATE TABLE category');
// $pdo->exec('TRUNCATE TABLE user');
// $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

// $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
// $pdo->exec('TRUNCATE TABLE province');
// $pdo->exec('TRUNCATE TABLE city');
// $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

// $posts = [];
// $categories = [];
// $states = ['current', 'past', 'investigation'];
// $flags = ['min', 'middle', 'max'];
// for ($i = 0; $i < 6; $i++) {
//     $state = $states[array_rand($states, 1)];
//     $flag = $flags[array_rand($flags, 1)];
//     $pdo->exec("INSERT INTO disease SET name = '{$faker->word}', state = '$state', flag = '$flag', description = '{$faker->paragraphs(rand(3,15), true)}', first_at = '{$faker->date} {$faker->time}'");
// }
// $string = ['Amani', 'Aline', 'Didie'];
// echo $string[array_rand($string, 1)] . "\n";


// for ($i = 0; $i < 5; $i++) {
//     $pdo->exec("INSERT INTO category SET name = '{$faker->sentence(3)}', slug = '{$faker->slug}'");
//     $categories[] = $pdo->lastInsertId();
// }

// foreach($posts as $post) {
//     $randCategories = $faker->randomElements($categories, rand(0, count($categories)));
//     foreach ($randCategories as $category) {
//         $pdo->exec("INSERT INTO post_category SET post_id = $post, category_id = $category");
//     }
// }
// $password = password_hash('editor', PASSWORD_BCRYPT);
// for ($i = 0; $i < 25; $i++) {
//     $pdo->exec("INSERT INTO province SET title='{$faker->country}'");
// }
// for ($i = 0; $i < 15; $i++) {
//     $id = rand(0,26);
//     $pdo->exec("INSERT INTO city SET title='{$faker->city}', province_id = $id");
// }

// $pdo->exec("INSERT INTO user SET username='editor', password='$password', pseudo='{$faker->name}', email='{$faker->email}', role='editor'");

// $password = password_hash('user', PASSWORD_BCRYPT);
// $pdo->exec("INSERT INTO user SET username='user', password='$password', pseudo='{$faker->name}', email='{$faker->email}', role='user'");
