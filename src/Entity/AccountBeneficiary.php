<?php

namespace App\Entity;

use App\Repository\AccountBeneficiaryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccountBeneficiaryRepository::class)
 */
class AccountBeneficiary
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=BankAccount::class, inversedBy="accountBeneficiary", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $isBeneficiary;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="userBeneficiary", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsBeneficiary(): ?BankAccount
    {
        return $this->isBeneficiary;
    }

    public function setIsBeneficiary(BankAccount $isBeneficiary): self
    {
        $this->isBeneficiary = $isBeneficiary;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
