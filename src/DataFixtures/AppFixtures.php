<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $post = new \App\Entity\Blog();

        $post->setTitle('My first blog post');
        $post->setSlug('my-first-blog-post');
        $post->setContent('Lorem ipsum dolar sit amet');
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($post);

        $manager->flush();
    }
}
