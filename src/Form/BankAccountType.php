<?php

namespace App\Form;

use App\Entity\BankAccount;
use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class BankAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('iban')
            ->add('initialBalance',null, [
                'label' => 'Apport initial'
            ])
            ->add('UserOfAccount', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'label' => 'Proprietaire du compte'
            ])
            // ->add('transactionCredit')
            // ->add('debitTransaction')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BankAccount::class,
        ]);
    }
}
