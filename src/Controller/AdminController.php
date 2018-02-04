<?php

namespace App\Controller;

use App\Form\SportType;
use App\Form\CategorieType;
use App\Form\NiveauType;
use App\Entity\Categorie;
use App\Entity\Sport;
use App\Entity\Niveau;
use App\Entity\Comments;
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

    /**
     * Suppression d'un sport
     * @Route("/admin/sport/supprimer/{id}", name="supprimerSport")
     */
    public function supprimerSport($id)
    {

        $sports = $this->getDoctrine()
        ->getRepository(Sport::class)
        ->findBy(
            ['id' => $id]
        );

        foreach($sports as $sport)
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($sport);
                $em->flush();
            }

            // à la suppresion retour vers la page ajouterSport
        return $this->redirectToRoute('ajouterSport');
    }

    /**
     * Suppresion d'une catégorie
     * @Route("/admin/categorie/supprimer/{id}", name="supprimerCategorie")
     */
    public function supprimerCategorie($id)
    {

        $categories = $this->getDoctrine()
        ->getRepository(Categorie::class)
        ->findBy(
            ['id' => $id]
        );

        foreach($categories as $categorie)
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($categorie);
                $em->flush();
            }

            // à la suppresion retour vers la page ajouterCategorie
        return $this->redirectToRoute('ajouterCategorie');
    }

/**
* Suppresion d'un niveau
* @Route("/admin/niveau/supprimer/{id}", name="supprimerNiveau")
*/
public function supprimerNiveau($id)
    {

        $niveaux = $this->getDoctrine()
        ->getRepository(Niveau::class)
        ->findBy(
            ['id' => $id]
        );

        foreach($niveaux as $niveau)
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($niveau);
                $em->flush();
            }

            // à la suppresion retour vers la page ajouterCategorie
        return $this->redirectToRoute('ajouterNiveau');
}

/**
* Listes des commentaires signalés
* @Route("/admin/commentaire", name="afficherCommentaire")
*/
public function afficherCommentaire()
    {

        $comments = $this->getDoctrine()
            ->getRepository(Comments::class)
            ->findBy(
               ['statut' => false]
            );

        return $this->render(
            'admin/commentaire.html.twig',
                ['comments' => $comments]
        );
}

/**
* Supprimer un commentaire signalé
* @Route("/admin/commentaire/supprimer/{id}", name="supprimerCommentaire")
*/
public function supprimerCommentaire($id)
    {
        $comment = $this->getDoctrine()
            ->getRepository(Comments::class)
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();       

        return $this->redirectToRoute('afficherCommentaire');
}

/**
* Valider un commentaire signalé
* @Route("/admin/commentaire/valider/{id}", name="validerCommentaire")
*/
public function validerCommentaire($id)
    {
        $comment = $this->getDoctrine()
            ->getRepository(Comments::class)
            ->find($id);

        $statut = $comment->setStatut(true);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($statut);
        $em->flush();    

        return $this->redirectToRoute('afficherCommentaire');
}
}