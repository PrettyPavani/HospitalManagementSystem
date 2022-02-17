<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Form\AppointmentType;
use App\Entity\Doctor;
use App\Security\AppCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class AppointmentController extends AbstractController
{
    #[Route('/appointment', name: 'appointment')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppCustomAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new Appointment();
        $doctor = new Doctor();
        $user ->getDoctorName($doctor);        
        $form = $this->createForm(AppointmentType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager->persist($user);
            // $entityManager->persist($doctor);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }      
        return $this->render('appointment/index.html.twig', [
            'form' => $form->createView(),
        ]); 
    }

    #[Route('/list', name: 'list')]
    public function show(EntityManagerInterface $doctrine): Response{
        $repository = $doctrine->getRepository(Appointment::class);       
        $appointments = $repository->findAll();
        // dd($appointments);
        // dump($output[0]->getFields()->getName())

        return $this->render('appointment/appointment.html.twig',[
            // 'appointments'=> dump($appointments[0]->getDate())
            'appointments' => $appointments
        ]);
    }
}
