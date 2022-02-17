<?php

namespace App\Entity;

use App\Repository\PrescribeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrescribeRepository::class)]
class Prescribe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Prescribe;

    public function __construct()
    {
        $this->Appointment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointment(): Collection
    {
        return $this->Appointment;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->Appointment->contains($appointment)) {
            $this->Appointment[] = $appointment;
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        $this->Appointment->removeElement($appointment);

        return $this;
    }

    public function getPrescribe(): ?string
    {
        return $this->Prescribe;
    }

    public function setPrescribe(string $Prescribe): self
    {
        $this->Prescribr = $Prescribe;

        return $this;
    }

}
