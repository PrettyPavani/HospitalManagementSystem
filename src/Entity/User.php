<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    const ROLE_ADMIN ='ROLE_ADMIN';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $email;

        /**
     * @ORM\Column(type="json_array")
     */
    #[ORM\Column(type: 'json')]

    private $roles = [];

      /**
     *@[ORM\Column(type: 'string', length: 180, unique: true)]
     * @Assert\NotBlank
     * @Assert\Length(min=6)
    */
    #[ORM\Column(type: 'string')]
    private $password;

     /**     
     * @Assert\NotBlank
    */
    #[ORM\Column(type: 'string', length: 255)]
    private $firstname;

    /**
     *@[ORM\Column(type: 'string', length: 180, unique: true)]
     * @Assert\NotBlank
    */   
    private $lastname;


    #[ORM\Column(type: 'text')]
    private $Phone;    

    #[ORM\Column(type: 'integer')]
    private $age;

    /**
     *@[ORM\Column(type: 'string', length: 180, unique: true)]
     * @Assert\NotBlank
    */    
    private $bloodgroup;
    
    /**
     *@[ORM\Column(type: 'string', length: 180, unique: true)]
     * @Assert\NotBlank
    */
    private $confirmPassword;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
   
    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }    

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getBloodgroup(): ?string
    {
        return $this->bloodgroup;
    }

    public function setBloodgroup(string $bloodgroup): self
    {
        $this->bloodgroup = $bloodgroup;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    public function isAdmin(): bool {
        return in_array(self::ROLE_ADMIN,$this->getRoles());
    }
}
