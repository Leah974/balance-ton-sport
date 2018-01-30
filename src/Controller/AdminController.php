<?php

namespace App\Controller;

use App\Form\SportType;
use App\Entity\Categorie;
use App\Entity\Sport;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{
    /**
     * Enregistrer un nouveau sport dans une catégorie
     * @Route("/admin/sport", name="ajouterSport")
     */
    public function registerSport(Request $request)
    {
        $sport = new Sport();

        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

            // si le formulaire est rempli et valide
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($sport);
            $em->flush();

            return $this->redirectToRoute('ajouterSport');
        }

        return $this->render(
            'admin/sport.html.twig',
            array('form' => $form->createView())
        );
    }
}