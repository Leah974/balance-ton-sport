<?php

namespace App\Controller;

use App\Form\EvenementType;
use App\Entity\Evenement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


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
}
