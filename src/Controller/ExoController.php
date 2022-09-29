<?php

namespace App\Controller;

use App\Form\VoitureType;
use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExoController extends AbstractController
{
    #[Route('/exo', name: 'app_exo')]
    public function index(): Response
    {
        return $this->render('exo/index.html.twig', [
            'controller_name' => 'ExoController',
        ]);
    }

   
    #[Route('/voitures', name: 'voitures')]
    public function voitures()
    {
        return $this->render('exo/voitures.html.twig',[
            'voiture'=>"R5",
            'description'=>" la voiture est cher",
            'prix'=>150000
            
        ]);

    }
    #[Route('/voiture/liste', name: 'voiture_liste')]
    public function liste (VoitureRepository $repo): Response
    {

        $voitures=$repo->findAll();
        return $this->render('exo/liste.html.twig', [
            'voitures' => $voitures
        ]);
    }


    #[Route('/voitures/new', name: 'voiture_new')]
    #[Route('/Voitures/edit/{id}', name: 'voitures_edit')]
    public function form(Request $globals,EntityManagerInterface $Manager,Voiture $voiture = null)
    {
        if($voiture == null)
        {
        $voiture=new voiture;
        
        }
        $form= $this->createForm(VoitureType::class,$voiture);
        
        $form->handleRequest($globals);
        if($form->isSubmitted()&& $form->isValid())
        {
             $Manager->persist($voiture);
             $Manager->flush();
   
            return $this->redirectToRoute('voiture_liste',[
            'id'=>$voiture->getId()
            ]);
     
             }

             return $this->renderForm("exo/form.html.twig",[
                'formVoiture'=> $form,
                'editMode'=>$voiture->getId()!== null
                
            ]);
            
    }

            #[Route('/voitures/delete/{id}', name: 'voitures_delete')]

            public function delete($id,EntityManagerInterface $manager,VoitureRepository $repo)
            {
        
              $voiture=$repo->find($id);
              $manager->remove($voiture);
              $manager->flush();
               return $this->redirectToRoute('voiture_liste');
        
        
            }
        





        }

 
      
       







