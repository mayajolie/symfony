<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Employers;
use App\Entity\Authen;
use App\Entity\Services;
use App\Repository\EmployersRepository;
use App\Repository\ServicesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\Bundle\DoctrineBundle\Repository\EmployersEntityRepository;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class JrController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(){
        return $this->render('jr/index.html.twig');

    }
    //======================Authentification========================//
    /**
     * @Route("/jr/authen", name="authen")
     */
  
    public function authen(){
        //return $this->redirectToRoute('accueil');
        return $this->render('jr/authen.html.twig');
   }
   /**
     * @Route("/", name="deconex")
     */
    public function deconnexion(){
        
   }

    //====================Lister Employer======================//
    /**
     * @Route("/jr", name="accueil")
     */
    public function accueil()
    {
        $repo = $this->getDoctrine()->getRepository(Employers::class);

        $employers = $repo->findAll();

        return $this->render('jr/accueil.html.twig', [
            'employers' => $employers
        ]);
    }
    //================Lister Service=================//   
    /**
     * @Route("/jr/listSer", name="list-service")
     */

    public function findService()
    {

        $repo = $this->getDoctrine()->getRepository(Services::class);

        $services = $repo->findAll();

        return $this->render('jr/liste_service.html.twig', [
            'services' => $services
        ]);
    }
    //====================Ajouter/Modifier Service===========================//
    /**
     * @Route("/jr/ajoutSer", name="ajoutSer")
     * @Route("/jr/{id}/modif", name="modifSer")

     */
    public function ajoutService(Services $service = null, Request $request, ObjectManager $manager)
    {
        if (!$service) {
            $service = new Services();
        }
        $form = $this->createFormBuilder($service)
            ->add('libelle')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($service);
            $manager->flush();
            return $this->redirectToRoute('list-service');
        }
        return $this->render(
            'jr/ajout_service.html.twig',
            [
                'formeservice' => $form->createView(),
                'Mode' => $service->getId() !== null
            ]
        );
    }
    //============Supprimer un Service=======================//
    /**
     * @Route("/jr/{id}/delete", name="supprim")
     */
    public function suprimersevice(Services $ser, ObjectManager $manager)
    {
        $manager->remove($ser);
        $manager->flush();
        $this->addFlash('danger', 'suppression reussie');

        return $this->redirectToRoute('list-service');
    }
    //================Ajouter/Modifier Employer==================//
    /**
     * @Route("/jr/ajout", name="ajout")
     * @Route("jr/{id}/ajout"), name="edit)
     */
    public function ajout(Employers $employes = null, Request $request, ObjectManager $manager)
    {
        if (!$employes) {
            $employes = new Employers;
        }

        $form = $this->createFormBuilder($employes)
            ->add('matricule')
            ->add('nomComplet')
            ->add('DateNaiss', DateType::class, ['widget' => 'single_text', 'format' => 'yyyy-MM-dd'])
            ->add('salaire')
            ->add('service', EntityType::class, ['class' => Services::class, 'choice_label' => 'libelle'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($employes);
            $manager->flush();
            return $this->redirectToRoute('accueil');
        }


        return $this->render('jr/ajout.html.twig', [
            'formemployer' => $form->createView(),
            'editMode' => $employes->getId() !== null
        ]);
    }
    //======================Supprimer un Employer===================//
    /**
     * @Route("/jr/{id}/delete", name="supprimer")
     */
    public function suprimer(Employers $employe, ObjectManager $manager)
    {
        $manager->remove($employe);
        $manager->flush();
        $this->addFlash('danger', 'suppression reussie');

        return $this->redirectToRoute('accueil', ['id' => $employe->getId()]);
    }
     
}
