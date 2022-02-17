<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Form\PrescriptionType;
use App\Form\AppointmentType;
use App\Entity\Prescribe;
use App\Security\AppCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class PrescribeController extends AbstractController
{
    #[Route('/prescribe', name: 'prescribe')]
    public function index(Request $request): Response
    {
        $prescribe = new Prescribe();
        $appointment = new Appointment();
        $prescribe ->getAppointment($appointment);        
        $form = $this->createForm(PrescriptionType::class, $prescribe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager->persist($prescribe);
            // $entityManager->persist($doctor);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }   
        return $this->render('prescribe/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
 