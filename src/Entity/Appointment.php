<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;  

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'time')]
    private $time;

    #[ORM\ManyToOne(targetEntity: Doctor::class, inversedBy: 'appointments')]
    public $Doctor_name;

    
    public function getId(): ?int
    {
        return $this->id;
    }   

    public function __toString()
    {
        // to show the name of the Category in the select
       return $this->prescribes;
        // to show the id of the Category in the select
        // return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDoctorName(): ?Doctor
    {
        return $this->Doctor_name;
    }

    public function setDoctorName(?Doctor $Doctor_name): self
    {
        $this->Doctor_name = $Doctor_name;

        return $this;
    }

    
}
