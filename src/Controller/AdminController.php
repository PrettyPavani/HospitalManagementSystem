<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Entity\Doctor;
use App\Entity\Appointment;
use App\Form\AddDoctorType;
use App\Repository\DoctorRepository;
use App\Security\AppCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;

class AdminController extends AbstractController
{

    private $em;
    private $doctorRepository;
    public function __construct(EntityManagerInterface $em, DoctorRepository $doctorRepository) 
    {
        $this->em = $em;
        $this->doctorRepository = $doctorRepository;
    }
   
    #[Route('/admin', name: 'admin')]
    public function index(EntityManagerInterface $entityManager,ManagerRegistry $doctrine ,Request $request): Response
    {
        $users = new User();
        $repository = $doctrine->getRepository(User::class);       
        $users = $repository->findAll();
        $doctors = new Doctor();
        $repository = $doctrine->getRepository(Doctor::class);       
        $doctors = $repository->findAll();
        $form = $this->createForm(AddDoctorType::class, $doctors);
        $repository = $doctrine->getRepository(Appointment::class);       
        $appointments = $repository->findAll();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager->persist($doctors);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }        
        return $this->render('admin/index.html.twig',[
            'users'=> $users,
            'doctors'=> $doctors,
            'appointments'=>$appointments,
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/create', name: 'create_admin')]
    public function create(Request $request,EntityManagerInterface $entityManager): Response {
        $doctor = new Doctor();
        $form = $this->createForm(AddDoctorType::class, $doctor);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newDoctor = $form->getData();
            $entityManager->persist($doctor);
            // $entityManager->persist($doctor);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/edit/{id}', name: 'edit')]

    public function update(ManagerRegistry $doctrine,$id): Response
    {
        $entityManager = $doctrine->getManager();
        $doctor = $entityManager->getRepository(Doctor::class)->find($id);
        $entityManager->flush();    
        return $this->redirectToRoute('admin');    
    }

  
    #[Route('/admin/delete/{id}',methods:['GET','DELETE'], name: 'delete')]

    public function delete(ManagerRegistry $doctrine,$id): Response
    {
        $repository = $doctrine->getRepository(Doctor::class);       
        $doctor = $repository->find($id);
        $this->em->remove($doctor);
        $this->em->flush();
        return $this->redirectToRoute('admin');    
    }
}
