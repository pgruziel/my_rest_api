<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Product;
use App\Entity\Country;
use App\Entity\Price;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName('Test-1');
        $manager->persist($product);

        $country1 = new Country();
        $country1->setName('Polska');
        $country1->setCode('pl');
        $country1->setCurrency('PLN');
        $manager->persist($country1);

        $country2 = new Country();
        $country2->setName('United States');
        $country2->setCode('us');
        $country2->setCurrency('USD');
        $manager->persist($country2);

        $price1 = new Price();
        $price1->setProductId($product->getId());
        $price1->setCountryId($country1->getId());
        $price1->setValue(100);
        $manager->persist($price1);

        $price2 = new Price();
        $price2->setProductId($product->getId());
        $price2->setCountryId($country2->getId());
        $price2->setValue(25);
        $manager->persist($price2);

        $manager->flush();
    }
}
