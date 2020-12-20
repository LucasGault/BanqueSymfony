<?php

namespace App\Entity;

use App\Repository\BankAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BankAccountRepository::class)
 */
class BankAccount
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=34)
     */
    private $iban;

    /**
     * @ORM\Column(type="float")
     */
    private $initialBalance;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bankAccounts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserOfAccount;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="CreditAccount")
     */
    private $transactionsCredit;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="DebitAccount")
     */
    private $transactionsDebit;

    /**
     * @ORM\OneToOne(targetEntity=AccountBeneficiary::class, mappedBy="isBeneficiary", cascade={"persist", "remove"})
     */
    private $accountBeneficiary;

    public function __construct()
    {
        $this->transactionsCredit = new ArrayCollection();
        $this->transactionsDebit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getInitialBalance(): ?float
    {
        return $this->initialBalance;
    }

    public function setInitialBalance(float $initialBalance): self
    {
        $this->initialBalance = $initialBalance;

        return $this;
    }

    public function getUserOfAccount(): ?User
    {
        return $this->UserOfAccount;
    }

    public function setUserOfAccount(?User $UserOfAccount): self
    {
        $this->UserOfAccount = $UserOfAccount;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactionsCredit(): Collection
    {
        return $this->transactionsCredit;
    }

    public function addTransactionsCredit(Transaction $transactionsCredit): self
    {
        if (!$this->transactionsCredit->contains($transactionsCredit)) {
            $this->transactionsCredit[] = $transactionsCredit;
            $transactionsCredit->setCreditAccount($this);
        }

        return $this;
    }

    public function removeTransactionsCredit(Transaction $transactionsCredit): self
    {
        if ($this->transactionsCredit->removeElement($transactionsCredit)) {
            // set the owning side to null (unless already changed)
            if ($transactionsCredit->getCreditAccount() === $this) {
                $transactionsCredit->setCreditAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactionsDebit(): Collection
    {
        return $this->transactionsDebit;
    }

    public function addTransactionsDebit(Transaction $transactionsDebit): self
    {
        if (!$this->transactionsDebit->contains($transactionsDebit)) {
            $this->transactionsDebit[] = $transactionsDebit;
            $transactionsDebit->setDebitAccount($this);
        }

        return $this;
    }

    public function removeTransactionsDebit(Transaction $transactionsDebit): self
    {
        if ($this->transactionsDebit->removeElement($transactionsDebit)) {
            // set the owning side to null (unless already changed)
            if ($transactionsDebit->getDebitAccount() === $this) {
                $transactionsDebit->setDebitAccount(null);
            }
        }

        return $this;
    }

    public function getAccountBeneficiary(): ?AccountBeneficiary
    {
        return $this->accountBeneficiary;
    }

    public function setAccountBeneficiary(AccountBeneficiary $accountBeneficiary): self
    {
        $this->accountBeneficiary = $accountBeneficiary;

        // set the owning side of the relation if necessary
        if ($accountBeneficiary->getIsBeneficiary() !== $this) {
            $accountBeneficiary->setIsBeneficiary($this);
        }

        return $this;
    }
}
