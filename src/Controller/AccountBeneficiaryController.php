<?php

namespace App\Controller;

use App\Entity\AccountBeneficiary;

use App\Entity\User;

use App\Form\AccountBeneficiaryType;
use App\Repository\AccountBeneficiaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/account/beneficiary")
 */
class AccountBeneficiaryController extends AbstractController
{
    /**
     * @Route("/", name="account_beneficiary_index", methods={"GET"})
     */
    public function index(AccountBeneficiaryRepository $accountBeneficiaryRepository): Response
    {
        return $this->render('account_beneficiary/index.html.twig', [
            'account_beneficiaries' => $accountBeneficiaryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="account_beneficiary_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $accountBeneficiary = new AccountBeneficiary();
        $form = $this->createForm(AccountBeneficiaryType::class, $accountBeneficiary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // $accountBeneficiary->setUser();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accountBeneficiary);
            $entityManager->flush();

            return $this->redirectToRoute('account_beneficiary_index');
        }

        return $this->render('account_beneficiary/new.html.twig', [
            'account_beneficiary' => $accountBeneficiary,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="account_beneficiary_show", methods={"GET"})
     */
    public function show(AccountBeneficiary $accountBeneficiary): Response
    {
        return $this->render('account_beneficiary/show.html.twig', [
            'account_beneficiary' => $accountBeneficiary,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="account_beneficiary_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AccountBeneficiary $accountBeneficiary): Response
    {
        $form = $this->createForm(AccountBeneficiaryType::class, $accountBeneficiary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('account_beneficiary_index');
        }

        return $this->render('account_beneficiary/edit.html.twig', [
            'account_beneficiary' => $accountBeneficiary,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="account_beneficiary_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AccountBeneficiary $accountBeneficiary): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accountBeneficiary->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accountBeneficiary);
            $entityManager->flush();
        }

        return $this->redirectToRoute('account_beneficiary_index');
    }
}
