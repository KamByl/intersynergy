<?php

namespace App\DataFixtures;

use App\Factory\OsobyFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        OsobyFactory::createOne([
            'email' => 'abra@example.com',
            'roles' => ['ROLE_ADMIN'],
        ]);

        OsobyFactory::new()->createMany(50);

        $manager->flush();
    }
}
