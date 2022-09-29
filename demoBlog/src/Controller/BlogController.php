<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'slogan' => "La démo d'un blog",
            'age' => 28
        ]);
        // pour envoyer des variables depuis le controller, la méthode render() prend en 2ème arg un tableau associatif
    }

    /**
     * @Route("/blog", name="app_blog")
     */
    // une route est définie par 2 arguments : son chemin (/blog) et son nom (app_blog)
    // aller sur une route permet de lancer la méthode qui se trouve directement en-dessous
    
    // les méthodes d'un controller renvoient TOUJOURS un objet de classe Response
    public function index(ArticleRepository $repo): Response
    {
        // pour récuperer le repository, je le passe en arg de la méthode index()
        // cela s'appelle une injection de dépendance

        $articles = $repo->findAll();
        // j'utilise findAll() pour récupérer tous les articles en BDD

        return $this->render('blog/index.html.twig', [
            'articles' => $articles // j'envoie les articles au template
        ]);

        // render() permet d'afficher le contenu d'un template
    }

    /**
     * @Route("/blog/show/{id}", name="blog_show")
     */
    public function show($id, ArticleRepository $repo)   // $id correspond au {id} (param de route) dans l'URL
    {
        $article = $repo->find($id);
        // find() permet de récupérer 1 article en fonction de son id

        return $this->render('blog/show.html.twig', [
            'item' => $article
        ]);
    }

    /**
     * @Route("/blog/new", name="blog_create")
     */
    public function form()
    {
        return $this->render("blog/form.html.twig");
    }
}
