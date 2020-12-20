<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    // /**
    //  * @ORM\OneToMany(targetEntity=UserAccount::class, mappedBy="accountOwner", orphanRemoval=true)
    //  */
    // private $userAccounts;

    /**
     * @ORM\OneToMany(targetEntity=BankAccount::class, mappedBy="UserOfAccount", orphanRemoval=true)
     */
    private $bankAccounts;

    /**
     * @ORM\OneToOne(targetEntity=AccountBeneficiary::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $userBeneficiary;

    public function __construct()
    {
        $this->userAccounts = new ArrayCollection();
        $this->bankAccounts = new ArrayCollection();
    }

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
    public function getUsername(): string
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
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

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return Collection|UserAccount[]
     */
    public function getUserAccounts(): Collection
    {
        return $this->userAccounts;
    }

    // public function addUserAccount(UserAccount $userAccount): self
    // {
    //     if (!$this->userAccounts->contains($userAccount)) {
    //         $this->userAccounts[] = $userAccount;
    //         $userAccount->setAccountOwner($this);
    //     }

    //     return $this;
    // }

    // public function removeUserAccount(UserAccount $userAccount): self
    // {
    //     if ($this->userAccounts->removeElement($userAccount)) {
    //         // set the owning side to null (unless already changed)
    //         if ($userAccount->getAccountOwner() === $this) {
    //             $userAccount->setAccountOwner(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection|BankAccount[]
     */
    public function getBankAccounts(): Collection
    {
        return $this->bankAccounts;
    }

    public function addBankAccount(BankAccount $bankAccount): self
    {
        if (!$this->bankAccounts->contains($bankAccount)) {
            $this->bankAccounts[] = $bankAccount;
            $bankAccount->setUserOfAccount($this);
        }

        return $this;
    }

    public function removeBankAccount(BankAccount $bankAccount): self
    {
        if ($this->bankAccounts->removeElement($bankAccount)) {
            // set the owning side to null (unless already changed)
            if ($bankAccount->getUserOfAccount() === $this) {
                $bankAccount->setUserOfAccount(null);
            }
        }

        return $this;
    }

    public function getUserBeneficiary(): ?AccountBeneficiary
    {
        return $this->userBeneficiary;
    }

    public function setUserBeneficiary(AccountBeneficiary $userBeneficiary): self
    {
        $this->userBeneficiary = $userBeneficiary;

        // set the owning side of the relation if necessary
        if ($userBeneficiary->getUser() !== $this) {
            $userBeneficiary->setUser($this);
        }

        return $this;
    }
}
