<?php

namespace App\Entity;

use App\Repository\BankAccountRepository;
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
     * @ORM\OneToOne(targetEntity=UserAccount::class, mappedBy="accountOfUser", cascade={"persist", "remove"})
     */
    private $accountOfUser;

    // /**
    //  * @ORM\OneToOne(targetEntity=Transaction::class, mappedBy="creditAccount", cascade={"persist", "remove"})
    //  */
    // private $transactionCredit;

    // /**
    //  * @ORM\OneToOne(targetEntity=Transaction::class, mappedBy="debitAccount", cascade={"persist", "remove"})
    //  */
    // private $debitTransaction;

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

    public function getAccountOfUser(): ?UserAccount
    {
        return $this->accountOfUser;
    }

    public function setAccountOfUser(UserAccount $accountOfUser): self
    {
        $this->accountOfUser = $accountOfUser;

        // set the owning side of the relation if necessary
        if ($accountOfUser->getAccountOfUser() !== $this) {
            $accountOfUser->setAccountOfUser($this);
        }

        return $this;
    }

    // public function getTransactionCredit(): ?Transaction
    // {
    //     return $this->transactionCredit;
    // }

    // public function setTransactionCredit(Transaction $transactionCredit): self
    // {
    //     $this->transactionCredit = $transactionCredit;

    //     // set the owning side of the relation if necessary
    //     if ($transactionCredit->getCreditAccount() !== $this) {
    //         $transactionCredit->setCreditAccount($this);
    //     }

    //     return $this;
    // }

    // public function getDebitTransaction(): ?Transaction
    // {
    //     return $this->debitTransaction;
    // }

    // public function setDebitTransaction(Transaction $debitTransaction): self
    // {
    //     $this->debitTransaction = $debitTransaction;

    //     // set the owning side of the relation if necessary
    //     if ($debitTransaction->getDebitAccount() !== $this) {
    //         $debitTransaction->setDebitAccount($this);
    //     }

    //     return $this;
    // }
}
