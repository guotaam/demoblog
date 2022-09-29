<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home()
    {

    return $this->render('blog/home.html.twig',[
        'slogan'=>"la démo d'un slogan",
        'age'=>28,
        
    ]);

    }


    #[Route('/blog', name: 'app_blog')]
    public function index(ArticleRepository $repo): Response
    {

        $articles=$repo->findAll();
        return $this->render('blog/index.html.twig', [
            'articles' => $articles
        ]);
    }
    #[Route('/blog/show/{id}', name: 'blog_show')]
    public function show($id,ArticleRepository $repo)
    {
        $article = $repo->find($id);
        return $this->render('blog/show.html.twig',[
            'item'=>$article
        ]);
    }
    

    #[Route('/blog/new', name: 'blog_create')]
    #[Route('/blog/edit/{id}', name: 'blog_edit')]
    public function form(Request $globals,EntityManagerInterface $Manager,Article $article = null)
    {
        if($article == null)
        {
        $article=new Article;
        $article->setCreatedAt(new \DateTime);
        }
        $form= $this->createForm(ArticleType::class,$article);
        //dump($globals);
        $form->handleRequest($globals);
        dump($article);
        if($form->isSubmitted()&& $form->isValid())
        {
       

       $Manager->persist($article);
       $Manager->flush();

       return $this->redirectToRoute('blog_show',[
       'id'=>$article->getId()
       ]);

        }
        return $this->renderForm("blog/form.html.twig",[
        'formArticle'=> $form,
        'editMode'=>$article->getId()!== null
        // si ns somme si sr la route edit ou  create
        //editMode=0 ou editMode=1
    ]);
    }

    #[Route('/blog/delete/{id}', name: 'blog_delete')]

    public function delete($id,EntityManagerInterface $manager,ArticleRepository $repo)
    {

      $article=$repo->find($id);
      $manager->remove($article);//preparer
      $manager->flush();//executer la supp
       return $this->redirectToRoute('app_blog');


    }


}
