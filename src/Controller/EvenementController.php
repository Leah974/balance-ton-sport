<?php

namespace App\Controller;

use App\Form\EvenementType;
use App\Entity\Evenement;
use App\Entity\Sport;
use App\Entity\Participant;
use App\Entity\User;
use App\Entity\Niveau;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class EvenementController extends Controller
{
    /**
     * Enregistre les informations de l'événement en bdd
     * @Route("/evenements/proposer", name="proposerevenements")
     */
    public function registerEvenement(Request $request)
    {
        $evenement = new Evenement();
            // création du formulaire
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

            // vérifie si l'utilisateur est connecté
        $user = $this->getUser();
               // si utilisateur non connecté
        if (!$user) {
            // renvoie vers la page de connexion
            return $this->redirectToRoute('connexion');
        }

        else{
                // si le formulaire est rempli et valide
            if ($form->isSubmitted() && $form->isValid()) {
                    // dossier d'enregistrement de la photo evenement
                $dir = 'img/uploads';
                    // recuperation de la photo uploadé et recuperation de l'extension
                $file = $form['photo']->getData();
                $extension = $file->guessExtension();
                    // si l'extension n'est pas reconnu on affecte une extension jpeg
                if (!$extension) {
                    // extension cannot be guessed
                    $extension = 'jpeg';
                }
                    // on renomme la photo en 'photoevenement(chiffre entre 1 et 99999).extension'
                $nomPhoto = 'photoevenement'.rand(1, 99999).'.'.$extension;
                    // on deplace la photo dans le dossier
                $file->move($dir, $nomPhoto);
                    // on enregistre le nom de la photo en bdd
                $evenement->setPhoto($nomPhoto);
                    //récupération du nom utilisateur
                $username = $user->getUsername();
                    // on enregistre le nom utilisateur comme organisateur de l'événement
                $evenement->setOrganisateur($username);
                    // enregistrement des infos en bdd
                $em = $this->getDoctrine()->getManager();
                $em->persist($evenement);
                $em->flush();
                    // redirection vers la page profil
                return $this->redirectToRoute('profil');
            }

            return $this->render(
                'sitepublic/proposer.html.twig',
                array('form' => $form->createView())
            );
        }
    }

    /**
     * Affiche toutes les informations de l'événement dont l'id = $id
     * @Route("/evenements/{id}", name="detailsEvenements")
     */
    public function showDetailsEvenement($id)
    {
        $evenement = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->find($id);

            // si il n'y a pas d'événement ou si l'événement id = $id n'existe pas
        if (!$evenement || !$id)
        {
                // renvoie vers une page d'erreur
            return $this->render('sitepublic/erreurEvenements.html.twig');
        }

            // recuperation des inscrits à l'événement
        $participants = $this->getDoctrine()
            ->getRepository(Participant::class)
            ->findBy(
                ['evenement' => $id]
            );

            // recuperation de l'utilisateur
        $user = $this->getUser();

            // utilisateur déjà inscrit ou non 
        $dejaInscrit = false;

        foreach($participants as $participant)
            {

                if($user === $participant->getUser())
                {
                    $dejaInscrit = true;
                }
            }

            // nombre d' inscrits à l'événement
        $nombre = count($participants);

            // événement complet ou non
        $nombreMax = $evenement->getParticipantMax();
        $complet = false;
        $vide = false;
            if($nombre === $nombreMax)
                {
                    $complet = true;
                }
            elseif($nombre === 0)
                {
                    $vide = true;
                }

        return $this->render('sitepublic/details.html.twig', 
            [
            'evenement' => $evenement, 
            'participants' => $participants, 
            'nombre' => $nombre,
            'complet' => $complet,
            'vide' => $vide,
            'user' => $user, 
            'dejaInscrit' => $dejaInscrit
            ]
        );
    }

    /**
     * Affiche tous les événements publics (statut = false) rangés par ordre chronologique
     * @Route("/evenements", name="evenements")
     */
        public function showEvenement()
        {
                $evenements = $this->getDoctrine()
                ->getRepository(Evenement::class)
                ->findBy(
                    ['statut' => false],
                    ['dateEvenement' => 'ASC']
                );

        return $this->render('sitepublic/evenements.html.twig', ['evenements' => $evenements]);
        }

    /**
     * Inscription à un événement
     * @Route("/evenements/inscription/{id}", name="inscriptionEvenement")
     */
        public function participerEvenement($id)
        {
            $evenement = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->find($id);

            $user = $this->getUser();

            if(!$user)
            {
                return $this->render('security/login.html.twig');
            }
            
            $participant = new Participant();
            $participant->setUser($user);
            $participant->setEvenement($evenement);

            $em = $this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();

                // à l'enregistrement redirection vers la page profil
            return $this->redirectToRoute('profil');
        }

    /**
     * Désinscription à un événement
     * @Route("/evenements/desinscription/{id}", name="desinscriptionEvenement")
     */
        public function desinscrireEvenement($id)
        {
            $user = $this->getUser();

            $participants = $this->getDoctrine()
            ->getRepository(Participant::class)
            ->findBy(
                ['evenement' => $id]
            );

             foreach($participants as $participant)
            {

                if($user === $participant->getUser())
                {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($participant);
                    $em->flush();
                }
            }
                // à la suppresion redirection vers la page profil
            return $this->redirectToRoute('profil');
        }

    /**
     * Liste des événements organisés par l'utilisateur
     * @Route("/profil/evenements/organise", name="profilOrganise")
     */
        public function listeEvenementsOrganisés()
        {
            $user = $this->getUser();
            $username = $user->getUsername();

            $evenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findBy(
                ['organisateur' => $username],
                ['dateEvenement' => 'ASC']
            );

            $aucun = false;
            $nombre = count($evenements);

            if($nombre = 0)
            {
                $aucun = true;
            }

            return $this->render('sitepublic/desinscriptionEvenement.html.twig', ['user' => $user, 'evenements' => $evenements, 'aucun' => $aucun]);
        }

    /**
     * Liste des événements auxquels participe l'utilisateur
     * @Route("/profil/evenements/participe", name="profilParticipe")
     */
        public function listeEvenementsParticipe()
        {
            $user = $this->getUser();

            $participants = $this->getDoctrine()
            ->getRepository(Participant::class)
            ->findBy(
                ['user' => $user]
            );

            $aucun = false;
            $nombre = count($participants);

            if($nombre == 0)
            {
                $aucun = true;
            }

            return $this->render('sitepublic/inscriptionEvenement.html.twig', ['user' => $user, 'participants' => $participants, 'aucun' => $aucun, 'nombre' => $nombre]);
        }

}
