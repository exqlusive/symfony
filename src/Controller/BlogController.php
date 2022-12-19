<?php declare(strict_types = 1);

namespace App\Controller;

use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'index')]
    public function index(BlogRepository $posts): Response
    {
        return $this->render('blog/index.html.twig', [
            'messages' => $posts->findAll(),
        ]);
    }

    #[Route('/blog/{slug}', name: 'blog_show')]
    public function show(string $slug, BlogRepository $posts): Response
    {
        $post = $posts->findOneBy(['slug' => $slug]);

        return $this->render('blog/show.html.twig', [
            'message' => $post ?? 'Not Found',
        ]);
    }

    #[Route('/blog/create', name: 'blog_create', priority: 1)]
    public function create(): Response
    {
        $post = new \App\Entity\Blog();

        $form = $this->createFormBuilder($post)
            ->add('title')
            ->add('slug')
            ->add('content')
            ->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Save'])
            ->getForm();

        return $this->render('blog/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/blog', name: 'blog_store')]
    public function store(): Response
    {
        return new Response();
    }

    #[Route('/blog/{id<\d+>}/edit', name: 'blog_edit')]
    public function edit(int $id): Response
    {
        return $this->render('blog/edit.html.twig', [
            'message' => $this->messages[$id] ?? 'Not Found',
        ]);
    }

    #[Route('/blog/{id<\d+>}', name: 'blog_update')]
    public function update(int $id): Response
    {
        return new Response();
    }

    #[Route('/blog/{id<\d+>}', name: 'blog_delete')]
    public function delete(int $id): Response
    {
        return new Response();
    }
}
