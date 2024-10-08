<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AuthorRepository;
class AuthorController extends AbstractController


{
    private $AuthorRepository;

    public function __construct(AuthorRepository $AuthorRepository)
    {
        $this->AuthorRepository = $AuthorRepository;
    }
    // private array $Authors;

    // public function __construct()
    // {
    //     $this->authors = [
    //         array('id' => 1, 'picture' => '/images/hq720.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100),
    //         array('id' => 2, 'picture' => '/images/maxresdefault.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200),
    //         array('id' => 3, 'picture' => '/images/hq720.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
    //     ];
    // }

    #[Route('/author/{name}', name: 'show_author', defaults: ['name' => 'user'], methods: ['GET'])]
    public function showAuthor(string $name): Response
    {
        return $this->render('author/show.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/authors', name: 'list_authors', methods: ['GET'])]
    public function listAuthors(): Response
    {
        $authors = $this->authorRepository->listAuthors();
        
        return $this->render('author/list.html.twig', [
            'authors' => $authors, 
        ]);
    }
    #[Route('/author/{id}', name: 'show_author', methods: ['GET'])]
    public function showAuthors(int $id): Response
    {
        $author = $this->authorRepository->find($id);
        return $this->render('author/showAuthor.html.twig', [
            'author' => $author,
        ]);
    }
}