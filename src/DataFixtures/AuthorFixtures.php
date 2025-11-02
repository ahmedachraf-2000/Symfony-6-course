<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $author1 = new Author();
        $author1 -> setName("Markus");
        $manager->persist($author1);

        $author2 = new Author();
        $author2->setName("Sarah");
        $manager->persist($author2);

        $author3 = new Author();
        $author3->setName("John Wick");
        $manager->persist($author3);

        $manager->flush();

        $this->addReference('author_1',$author1);
        $this->addReference('author_2', $author2);
        $this->addReference('author_3', $author3);



    }
}
