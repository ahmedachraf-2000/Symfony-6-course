<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Blog;
use App\Form\BlogFormType;
use App\Repository\AuthorRepository;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{


    public function __construct(private BlogRepository $blogRepository) {}


    #[Route('/blogs', name: 'blog_index', methods:['GET'])]
    public function index(): Response
    {
        $posts = $this->blogRepository->findBy([], ['publishedAt' => 'DESC']);
        return $this->render('blog/index.html.twig', [
            'posts' => $posts,
        ]);
    }


    #[Route('/blogs/create', name: 'blog_create', methods: ['GET','POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager,AuthorRepository $authorRepository): Response
    {
       $blog = new Blog();
       $form = $this->createForm(BlogFormType::class, $blog);
       $form-> handleRequest($request);
       $imageFile =$form ->get('imagePath')->getData();

       if($imageFile){
        $newFileName = uniqid() . '.' . $imageFile->guessExtension();
        $imageFile -> move(
            $this->getParameter('kernel.project_dir').'/public/uploads',$newFileName
        );

        $blog->setImagePath('/uploads/'.$newFileName);
       }

       if($form->isSubmitted() && $form->isValid()){
            $defaultAuthor = $authorRepository->find(13);
            $blog->setAuthor($defaultAuthor);
 
            $entityManager->persist($blog);

            $entityManager->flush();
            return $this->redirectToRoute('blog_index');
       }

         return $this->render('blog/create.html.twig', [
            'form' => $form->createView(),
        ]); 
    }
    #[Route('/blogs/delete/{id}', name: 'blog_delete', methods: ['GET','DELETE'])]
    public function delte(string $id,  EntityManagerInterface $entityManager ): Response
    {
        $post = $this->blogRepository->find($id);
        if (!$post) {
            throw $this->createNotFoundException("post not found");
        }
        $entityManager->remove($post);
        $entityManager->flush();

        return $this->redirectToRoute('blog_index');
    }

    #[Route('/blogs/{slug}', name: 'blog_show', methods: ['GET'])]
    public function show(string $slug): Response
    {
        $post = $this->blogRepository->findOneBy(['slug' => $slug]);
        if (!$post) {
            throw $this->createNotFoundException("post not found");
        }
        return $this->render('blog/show.html.twig', [
            'post' => $post,
        ]);
    }



}
