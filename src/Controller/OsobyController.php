<?php

namespace App\Controller;

use App\Entity\Osoby;
use Pagerfanta\Pagerfanta;
use App\Form\OsobyEditFormType;
use App\Repository\OsobyRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OsobyController extends AbstractController
{
    /**
     * @Route("/osoby/{page<\d+>}", name="app_osoby")
     * @IsGranted("IS_AUTHENTICATED_REMEMBERED")
     */
    public function list(OsobyRepository $repository, $page = 1): Response
    {
        $queryBuilder = $repository->findAllByNazwisko();

        $pagerfanta = new PagerFanta(
            new QueryAdapter($queryBuilder)
        );

        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($page);

        return $this->render('admin/osoby.html.twig', [
            'pager' => $pagerfanta
            ]);
    }

    /**
     * @Route("/osoby/delete/{id}", name="app_osoby_delete")
     */
    public function delete(Osoby $osoba, OsobyRepository $repository): Response
    {
        $repository->remove($osoba, true);
        $this->addFlash('success','Osoba została skasowana');

        return $this->redirectToRoute('app_osoby');
    }

    /**
     * @Route("/osoby/edit/{id}", name="app_osoby_edit")
     */
    public function edit(Osoby $osoba, Request $request): Response
    {
        $form = $this->createForm(OsobyEditFormType::class, $osoba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $osoba = $form->getData();

            $this->addFlash('success','Dane osoby zostały zmienione');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($osoba);
            $entityManager->flush();

            return $this->redirectToRoute('app_osoby');
        }


        return $this->render('admin/osoby_edit.html.twig', [
            'osobyForm' => $form->createView(),
            ]);
    }
}
