<?php

namespace App\Controller;

use App\Form\SportType;
use App\Form\CategorieType;
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

        $sportForm = $this->createForm(SportType::class, $sport);
        $sportForm->handleRequest($request);

            // si le formulaire est rempli et valide
        if ($sportForm->isSubmitted() && $sportForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($sport);
            $em->flush();

            return $this->redirectToRoute('ajouterSport');
        }

        $sports = $this->getDoctrine()
            ->getRepository(Sport::class)
            ->findAll();

        return $this->render(
            'admin/sport.html.twig',
            array('sportForm' => $sportForm->createView(), 'sports' => $sports)
        );
    }

    /**
     * Enregistrer un nouveau sport dans une catégorie
     * @Route("/admin/categorie", name="ajouterCategories")
     */
    public function registerCategorie(Request $request)
    {
        $categorie = new Categorie();

        $categorieForm = $this->createForm(CategorieType::class, $categorie);
        $categorieForm->handleRequest($request);

            // si le formulaire est rempli et valide
        if ($categorieForm->isSubmitted() && $categorieForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('ajouterSport');
        }

        $categories = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findAll();

        return $this->render(
            'admin/categorie.html.twig',
            array('categorieForm' => $categorieForm->createView(), 'categories' => $categories)
        );
    }
}