<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Appointment;
use App\Form\AddDoctorType;
use App\Form\AppointmentType;
use App\Security\AppCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class DoctorController extends AbstractController
{
    #[Route('/doctor', name: 'doctor')]
    public function register(Request $request, EntityManagerInterface $doctrine,UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppCustomAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
       
        $user = new Appointment();
        $form = $this->createForm(AppointmentType::class, $user);
        $form->handleRequest($request);
        $repository = $doctrine->getRepository(Appointment::class);       
        $appointments = $repository->findAll();
        return $this->render('doctor/index.html.twig', [
            'appointments' => $appointments,
        ]); 
    }

    #[Route('/doctor/delete/{id}',methods:['GET','DELETE'], name: 'appointment_delete')]

    public function delete(ManagerRegistry $doctrine,$id): Response
    {
        $repository = $doctrine->getRepository(Appointment::class);       
        $appointments = $repository->find($id);
        $this->em->remove($appointments);
        $this->em->flush();
        return $this->redirectToRoute('doctor');    
    }

    #[Route('/doctor/prescribe', name: 'doctor_prescribe')]
    public function create(Request $request,EntityManagerInterface $entityManager): Response {
        $appointment = new Appointment();
        $precribe = new Prescribe();
        $precribe ->getAppointment($appointment);
        $form = $this->createForm(Appointment::class, $appointment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $prescribe = $form->getData();
            $entityManager->persist($appointment);
            $entityManager->persist($precribe);
            $entityManager->flush();
            return $this->redirectToRoute('doctor');
        }
        return $this->render('doctor/prescribe.html.twig', [
            'form' => $form->createView()
        ]);
    }
  
}
