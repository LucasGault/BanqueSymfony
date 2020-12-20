<?php

namespace App\Form;

use App\Entity\AccountBeneficiary;
use App\Entity\BankAccount;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class AccountBeneficiaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isBeneficiary', EntityType::class, [
                'class' => BankAccount::class,
                'choice_label' => 'iban',
                'label' => 'Iban du bénéficiaire '
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'label' => ''
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AccountBeneficiary::class,
        ]);
    }
}
