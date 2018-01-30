<?php

namespace App\Controller;

use App\Form\EvenementType;
use App\Entity\Evenement;
<<<<<<< HEAD
use App\Entity\Comments;
=======
use App\Entity\Sport;
use App\Entity\Participant;
use App\Entity\User;
use App\Entity\Niveau;
>>>>>>> 544324ed0f0ed72ce0855b541e5150ac3226ebfc
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

            // si le formulaire est rempli et valide
        if ($form->isSubmitted() && $form->isValid()) {
                // vérifie si l'utilisateur est connecté
            $user = $this->getUser();
                // si utilisateur non connecté
            if (!$user) {
                // à la validation du formulaire, renvoie vers la page de connexion
            return $this->redirectToRoute('connexion');

            }
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
        //création commentaire à lier avec form cc lien dans comments
        return $this->render(
            'sitepublic/proposer.html.twig',
            array('form' => $form->createView())
        );
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

        return $this->render('sitepublic/details.html.twig', ['evenement' => $evenement]);
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
            $userId = $user->getId();

            $participant = new Participant();
            $participant->setNom($evenement->getTitre());
            $participant->setUser($userId);
            $participant->setEvenement($id);

            $em = $this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();

            return $this->render('sitepublic/inscriptionEvenement.html.twig', ['evenement' => $evenement, 'user' => $user, 'participant' => $participant]);
        }
}
