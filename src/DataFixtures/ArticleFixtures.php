<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
  

   
    public function load(ObjectManager $manager): void
    {
    for($i = 1;$i <= 10; $i++)
    {
        // $product = new Product();
        // $manager->persist($product);
        $article=new Article;

        $article->setTitle("Titre de m article n $i")
                ->setContent("<p>contenu de l article</p>")
                ->setImage("http://picsum.photos/250/150")
                ->setCreatedAt(new \DateTime);
   $manager->persist($article);//preparer

        $manager->flush();//executer
    }
}
}
