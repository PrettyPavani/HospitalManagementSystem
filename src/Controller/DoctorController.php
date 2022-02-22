<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Prescribe;
use App\Repository\DoctorRepository;
use App\Entity\Appointment;
use App\Form\AddDoctorType;
use App\Form\AppointmentType;
use App\Form\PrescriptionType;
use App\Security\AppCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Doctrine\Persistence\ManagerRegistry;


class DoctorController extends AbstractController
{
    private $em;
    private $doctorRepository;
    public function __construct(EntityManagerInterface $em, DoctorRepository $doctorRepository) 
    {
        $this->em = $em;
        $this->doctorRepository = $doctorRepository;
    }
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

    #[Route('/doctor/update/{id}', name: 'appointment_update')]

    public function update(Request $request,EntityManagerInterface $entityManager,ManagerRegistry $doctrine,$id): Response
    {
        $repository = $doctrine->getRepository(Prescribe::class);       
        $prescribe = $repository->find($id);
        $form = $this->createForm(PrescriptionType::class, $prescribe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $prescribe = $form->getData();
            $entityManager->persist($prescribe);
            $entityManager->flush();
            return $this->redirectToRoute('doctor');
        }
        return $this->render('doctor/prescribe.html.twig', [
            'form' => $form->createView()
        ]);    
    }

    #[Route('/doctor/prescribe/{id}', name: 'doctor_prescribe')]
    public function create(Request $request,EntityManagerInterface $entityManager): Response {
        $appointment = new Appointment();
        $appointment->setDate(new \DateTime('tomorrow'));
        $appointment->setTime(new \DateTime('tomorrow'));
        $prescribe = new Prescribe();
        $prescribe ->getPrescribe($prescribe);        
        $form = $this->createForm(PrescriptionType::class, $prescribe);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $prescribe = $form->getData();
            $entityManager->persist($appointment); 
            $entityManager->persist($prescribe);
            $entityManager->flush();
            return $this->redirectToRoute('doctor');
        }
        return $this->render('doctor/prescribe.html.twig', [
            'form' => $form->createView()
        ]);
    }
  
}
