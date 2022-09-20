<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 20; $i++) {
                    $product = new Product();
                    $product->setPBarCode(mt_rand(10000000, 99999999));
                    $product->setPName('product '.$i);
                    $product->setPBrand('brand '.$i);
                    $manager->persist($product);
                }
                
        $manager->flush();
    }
}
