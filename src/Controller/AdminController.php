<?php

namespace App\Controller;

use App\Form\SportType;
use App\Form\CategorieType;
use App\Form\NiveauType;
use App\Entity\Categorie;
use App\Entity\Sport;
use App\Entity\Niveau;
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
     * @Route("/admin/categorie", name="ajouterCategorie")
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

            return $this->redirectToRoute('ajouterCategorie');
        }

        $categories = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findAll();

        return $this->render(
            'admin/categorie.html.twig',
            array('categorieForm' => $categorieForm->createView(), 'categories' => $categories)
        );
    }

    /**
     * Enregistrer un nouveau sport dans une catégorie
     * @Route("/admin/niveau", name="ajouterNiveau")
     */
    public function registerNiveau(Request $request)
    {
        $niveau = new Niveau();

        $niveauForm = $this->createForm(NiveauType::class, $niveau);
        $niveauForm->handleRequest($request);

            // si le formulaire est rempli et valide
        if ($niveauForm->isSubmitted() && $niveauForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($niveau);
            $em->flush();

            return $this->redirectToRoute('ajouterNiveau');
        }

        $niveaux = $this->getDoctrine()
            ->getRepository(Niveau::class)
            ->findAll();

        return $this->render(
            'admin/niveau.html.twig',
            array('niveauForm' => $niveauForm->createView(), 'niveaux' => $niveaux)
        );
    }
}