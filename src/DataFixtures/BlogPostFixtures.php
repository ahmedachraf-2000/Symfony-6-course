<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BlogPostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $post1 = new Blog();
        $post1->setTitle('Getting started with Symfony');
        $post1->setSlug('symfony-6');
        $post1->setContent("Symfony is a PHP framework that speeds up web development. In this post we cover setup, structure, and your first controller.");
        $post1->setAuthor($this->getReference('author_1'));
        $post1->setPublishedAt(new \DateTimeImmutable('2025-10-10'));
        $post1->setImagePath('https://images.unsplash.com/photo-1515879218367-8466d910aaa4?q=80&w=1200&auto=format&fit=crop');
        $manager->persist($post1);

        $post2 = new Blog();
        $post2->setTitle('Understand Doctrine ORM');
        $post2->setSlug('doctrine-orm');
        $post2->setContent('Doctrine ORM makes it easy to interact with the database. You map entities, write less SQL, and gain powerful repositories.');
        $post2->setAuthor($this->getReference('author_2'));
        $post2->setPublishedAt(new \DateTimeImmutable('2025-10-11'));
        $post2->setImagePath('https://images.unsplash.com/photo-1517433670267-08bbd4be890f?q=80&w=1200&auto=format&fit=crop');
        $manager->persist($post2);

        $post3 = new Blog();
        $post3->setTitle('Twig templates in action');
        $post3->setSlug('twig-templates');
        $post3->setContent("Twig is Symfony's template engine. Learn layout inheritance, blocks, filters, and how to render clean UI.");
        $post3->setAuthor($this->getReference('author_3'));
        $post3->setPublishedAt(new \DateTimeImmutable('2025-10-12'));
        $post3->setImagePath('https://images.unsplash.com/photo-1516259762381-22954d7d3ad2?q=80&w=1200&auto=format&fit=crop');
        $manager->persist($post3);

        $manager->flush();
    }

    public function getDependencies():array
    {
        return [AuthorFixtures::class];
    }


}
