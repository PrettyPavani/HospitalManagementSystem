<?php

namespace App\Entity;

use App\Repository\LastnameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LastnameRepository::class)]
class Lastname
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
