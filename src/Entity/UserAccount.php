<?php

namespace App\Entity;

use App\Repository\UserAccountRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserAccountRepository::class)
 */
class UserAccount
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userAccounts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $accountOwner;

    /**
     * @ORM\OneToOne(targetEntity=BankAccount::class, inversedBy="accountOfUser", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $accountOfUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccountOwner(): ?User
    {
        return $this->accountOwner;
    }

    public function setAccountOwner(?User $accountOwner): self
    {
        $this->accountOwner = $accountOwner;

        return $this;
    }

    public function getAccountOfUser(): ?BankAccount
    {
        return $this->accountOfUser;
    }

    public function setAccountOfUser(BankAccount $accountOfUser): self
    {
        $this->accountOfUser = $accountOfUser;

        return $this;
    }
}
