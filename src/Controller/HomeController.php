<?php

namespace App\Controller;
use App\Entity\Appointment;
use App\Entity\Prescribe;
use App\Form\AppointmentType;
use App\Security\AppCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]  
    public function register(Request $request,EntityManagerInterface $doctrine, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppCustomAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {

        // $session = new Session();
        // $session->start(); 
       
        $user = new Appointment();
        $form = $this->createForm(AppointmentType::class, $user);
        $form->handleRequest($request);
        $repository = $doctrine->getRepository(Appointment::class);       
        $appointments = $repository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('home/home.html.twig', [
            'form' => $form->createView(),
            'appointments' => $appointments,
        ]);
    }

    #[Route('/prescription', name: 'prescription_list')]

    public function index(EntityManagerInterface $doctrine): Response{
        $repository = $doctrine->getRepository(Prescribe::class);       
        $users = $repository->findAll();
        // dd($users);
        return $this->render('Prescribe/prescribe.html.twig',[
            'users'=> $users
        ]);

    }

}
