<?php

namespace App\DataFixtures;

use App\Entity\Favorite;
use App\Entity\Home;
use App\Entity\HomeProduct;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // Product
        $products = [];
        for ($j = 0; $j < 100; ++$j) {
            $rand = mt_rand(1, 3);

            $product = new Product();
            $product->setPBarCode($this->faker->ean13());
            $product->setPName($this->faker->words($rand, true));
            $product->setPBrand($this->faker->word());
            $products[] = $product;

            $manager->persist($product);
        }

        // Favorite
        $favorites = [];
        for ($i = 0; $i < 100; ++$i) {
            $favorite = new Favorite();
            $favorite->setFAdditionDate($this->faker->dateTimeThisMonth());
            $favorite->setFOrderNumber(mt_rand(0, 100));
            $favorite->setProduct($products[mt_rand(0, count($products) - 1)]);
            $favorites[] = $favorite;

            $manager->persist($favorite);
        }

        // Home
        $homes = [];
        for ($k = 0; $k < 10; ++$k) {
            $home = new Home();
            $home->setHName($this->faker->name());
            $home->setHKey(mt_rand(0, 99999));
            $home->setHPassword($this->faker->password());
            $homes[] = $home;

            $manager->persist($home);
        }

        // HomeProduct
        for ($l = 0; $l < 50; ++$l) {
            $homeproduct = new HomeProduct();
            $homeproduct->setHpScanDate($this->faker->dateTimeThisMonth());
            $homeproduct->setHpUseByDate($this->faker->dateTimeThisMonth());
            $homeproduct->setHpConsumed($this->faker->boolean());
            $homeproduct->setProduct($products[mt_rand(0, count($products) - 1)]);
            $homeproduct->setHome($homes[mt_rand(0, count($homes) - 1)]);

            $manager->persist($homeproduct);
        }

        $manager->flush();
    }
}
