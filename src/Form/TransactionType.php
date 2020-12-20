<?php

namespace App\Form;

use App\Entity\BankAccount;

use App\Entity\Transaction;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

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
            ->add('amount', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Montant'
                ],
                'label' => 'Montant',

            ])
            ->add('transactionAt', DateTimeType::class,[
                'years' => range(2020,2021),
                'label' => 'Virement effectué le :'
            ])
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
                        ->where('u.UserOfAccount = ?1')
                        // ->andWhere('u.accountBeneficiary = ?2')
                        ->setParameter('1', $this->security->getUser()->getId());
                        // ->setParameters(array('1' => $this->security->getUser()->getId(), '2' => $this->security->getAcountBeneficiary()->getIsBeneficiary()));
                }
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
