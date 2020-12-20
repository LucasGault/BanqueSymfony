<?php

namespace App\Form;

use App\Entity\BankAccount;
use App\Entity\Beneficiary;

use App\Entity\Transaction;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TransactionType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debitAccount', EntityType::class, [
                'class' => BankAccount::class,
                'choice_label' => 'iban',
                'label' => 'Compte débité',

                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.UserOfAccount = :uid')
                        ->setParameter('uid', $this->security->getUser()->getId());
                }
            ])
            ->add('creditAccount', EntityType::class, [
                'class' => BankAccount::class,
                'choice_label' => 'iban',
                'label' => 'Compte crédité',

                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.UserOfAccount = :uid')
                        ->setParameter('uid', $this->security->getUser()->getId());
                }
            ])
            ->add('amount', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Montant'
                ],
                'label' => 'Montant',

            ])
            
            ->add('save', SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
