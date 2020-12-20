<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    private $transactionAt;

    /**
     * @ORM\ManyToOne(targetEntity=BankAccount::class, inversedBy="transactionsCredit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CreditAccount;

    /**
     * @ORM\ManyToOne(targetEntity=BankAccount::class, inversedBy="transactionsDebit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $DebitAccount;

    // /**
    //  * @ORM\OneToOne(targetEntity=BankAccount::class, inversedBy="transactionCredit", cascade={"persist", "remove"})
    //  * @ORM\JoinColumn(nullable=false)
    //  */
    // private $creditAccount;

    // /**
    //  * @ORM\OneToOne(targetEntity=BankAccount::class, inversedBy="debitTransaction", cascade={"persist", "remove"})
    //  * @ORM\JoinColumn(nullable=false)
    //  */
    // private $debitAccount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getTransactionAt(): ?\DateTimeInterface
    {
        return $this->transactionAt;
    }

    public function setTransactionAt(\DateTimeInterface $transactionAt): self
    {
        $this->transactionAt = $transactionAt;

        return $this;
    }

    // public function getCreditAccount(): ?BankAccount
    // {
    //     return $this->creditAccount;
    // }

    // public function setCreditAccount(BankAccount $creditAccount): self
    // {
    //     $this->creditAccount = $creditAccount;

    //     return $this;
    // }

    // public function getDebitAccount(): ?BankAccount
    // {
    //     return $this->debitAccount;
    // }

    // public function setDebitAccount(BankAccount $debitAccount): self
    // {
    //     $this->debitAccount = $debitAccount;

    //     return $this;
    // }

    public function getCreditAccount(): ?BankAccount
    {
        return $this->CreditAccount;
    }

    public function setCreditAccount(?BankAccount $CreditAccount): self
    {
        $this->CreditAccount = $CreditAccount;

        return $this;
    }

    public function getDebitAccount(): ?BankAccount
    {
        return $this->DebitAccount;
    }

    public function setDebitAccount(?BankAccount $DebitAccount): self
    {
        $this->DebitAccount = $DebitAccount;

        return $this;
    }
}
