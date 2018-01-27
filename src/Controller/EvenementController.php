<?php

namespace App\Controller;

use App\Form\EvenementType;
use App\Entity\Evenement;
use App\Entity\Sport;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class EvenementController extends Controller
{
    /**
     * @Route("/evenements/proposer", name="proposerevenements")
     */
    public function registerEvenement(Request $request)
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render(
            'sitepublic/proposer.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/evenements/{id}", name="evenements")
     */
    public function showEvenement($id)
    {
        $evenement = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->find($id);

        if (!$evenement) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->render('sitepublic/evenements.html.twig', ['evenement' => $evenement]);
    }
}
