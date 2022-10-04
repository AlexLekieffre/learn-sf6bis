<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $image = new Image();
        $image->setChemin('https://via.placeholder.com/700x120/000000/FFFFFF/?text=Information')
            ->setAlt("informations")
            ->setIsPublished(true);

            $image2 = new Image();
            $image2->setChemin('https://via.placeholder.com/700x120/000000/FFFFFF/?text=second')
                ->setAlt("second")
                ->setIsPublished(true);
            
    
        $category = new Category();
        $category->setImage($image)
                ->setLabel('Informations')
                ->setContenu('retrouver l\'ensemble des articles "information"')
                ->setIsPublished(true);

        $category2 = new Category();
        $category2->setImage($image2)
                ->setLabel('second')
                ->setContenu('retrouver l\'ensemble des articles "second"')
                ->setIsPublished(true);
                
        $manager->persist($category,$category2);
                

        $manager->flush();
    }
}