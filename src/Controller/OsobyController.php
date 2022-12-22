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
     * @Route("/account/edit", name="app_osoby_edit")
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, string $photoDir): Response
    {
        $form = $this->createForm(OsobyEditFormType::class, $this->getUser());
        $cv_name = $this->getUser()->getCv();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $osoba = $form->getData();
            if (!empty($osoba->getPlainPassword()))
                $osoba->setPassword($osoba->getPlainPassword());
            if (null !== $cv = $form['cv']->getData()) {
                $filename = bin2hex(random_bytes(6)) . '.' . $cv->guessExtension();
                try {
                    $cv->move($photoDir, $filename);
                } catch (FileException $e) {
                    // to do
                }
                $osoba->setCv($filename);
            }
            else
            {
                $osoba->setCv($cv_name);
            }

            $this->addFlash('success', 'Dane osoby zostały zmienione');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($osoba);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }


        return $this->render('admin/osoby_edit.html.twig', [
            'osobyForm' => $form->createView(),
        ]);
    }
}
