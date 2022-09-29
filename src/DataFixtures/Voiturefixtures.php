<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Voiture;

class Voiturefixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1;$i <= 15; $i++)
    {
        // $product = new Product();
        // $manager->persist($product);
        $voiture=new Voiture;

        $voiture->setMarque("marque de ma voiture n $i")
               
                ->setPrix($i * 3.7)
                ->setDescription("description de la voiture $i");
   $manager->persist($voiture);//preparer

        $manager->flush();
    }
}
}