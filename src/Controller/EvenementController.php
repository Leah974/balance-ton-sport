<?php
namespace App\Controller;
use App\Form\EvenementType;
use App\Entity\Evenement;
use App\Entity\Sport;
use App\Entity\Participant;
use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\Niveau;
use App\Form\CommentType;
use App\Entity\Comments;
use App\Entity\Alerte;
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
                $dir = 'img/uploads/evenement';
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

                $sport = $form['sport']->getData();

                $categorie = $sport->getCategorie();

                $evenement->setCategorie($categorie);

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
    public function showDetailsEvenement(request $request, $id)
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
        $comment = new Comments();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
         $user = $this->getUser();
         $evenement = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->find($id);
         $comment->setUser($user);
         $comment->setEvenement($evenement);
         $em = $this->getDoctrine()->getManager();
         $em->persist($comment);
         $em->flush();
            return $this->redirectToRoute('evenements');
        }
        $comments = $this->getDoctrine()
            ->getRepository(Comments::class)
            ->findBy(
               ['evenement' => $id]
            );
        return $this->render('sitepublic/details.html.twig', array(
            'form' => $form->createView(),
            'comments' => $comments,
            'evenement' => $evenement, 
            'participants' => $participants, 
            'nombre' => $nombre,
            'complet' => $complet,
            'vide' => $vide,
            'user' => $user, 
            'dejaInscrit' => $dejaInscrit
        )
        );
    }
    /**
     * Affiche tous les événements publics (statut = false) rangés par ordre chronologique
     * @Route("/evenements", name="evenements")
     */
        public function showEvenement()
        {
                $aucunEvenement = false;

                $evenements = $this->getDoctrine()
                ->getRepository(Evenement::class)
                ->findBy(
                    ['statut' => false],
                    ['dateEvenement' => 'ASC']
                );

                if(count($evenements) == 0)
                {
                    $aucunEvenement = true;
                }
                    // recuperation du nombre de places restantes $placesRestantes
                foreach($evenements as $evenement)
                {
                    $placesDispos = $evenement->getParticipantMax();
                    $participants = $this->getDoctrine()
                        ->getRepository(Participant::class)
                        ->findBy(
                    ['evenement' => $evenement]
                    );
                    $placesPrises = count($participants);
                    $placesRestantes = $placesDispos - $placesPrises;

                }
                
        return $this->render('sitepublic/evenements.html.twig', ['aucunEvenement' => $aucunEvenement,'evenements' => $evenements, 'placesRestantes' => $placesRestantes]);
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

            //ajout d'une l'alerte inscription
            $alerte = new Alerte();
            $alerte->setTypeAlerte('Inscription');
            $alerte->setEvenement($evenement);
            $alerte->setStatut('false');
            
            //récupération user organisateur
            $pseudo_organisateur = $evenement->getOrganisateur();
            $user_organisateur = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $pseudo_organisateur]);
            $user_organisateur->addAlerte($alerte);
            $am = $this->getDoctrine()->getManager();
            $am->persist($alerte);
            $am->flush();

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

            //ajout d'une l'alerte désinscription
            $evenement = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->find($id);

            $alerte = new Alerte();
            $alerte->setTypeAlerte('Désinscription');
            $alerte->setEvenement($evenement);
            $alerte->setStatut('false');
            
            //récupération user organisateur
            $pseudo_organisateur = $evenement->getOrganisateur();
            $user_organisateur = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $pseudo_organisateur]);
            $user_organisateur->addAlerte($alerte);
            $am = $this->getDoctrine()->getManager();
            $am->persist($alerte);
            $am->flush();
            
                // à la suppresion redirection vers la page profil
            return $this->redirectToRoute('profil');
        }
/**
* Signaler un commentaire
* @Route("/evenements/{evenement}/signaler/commentaire/{id}", name="signalerCommentaire")
*/
public function signalerCommentaire($id)
    {
        $comment = $this->getDoctrine()
            ->getRepository(Comments::class)
            ->find($id);
        $statut = $comment->setStatut(false);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($statut);
        $em->flush();
            // à la suppresion retour vers la page ajouterCategorie
        return $this->redirectToRoute('evenements');
}
/**
* Annuler un événement
* @Route("/profil/annuler/{id}", name="annulerEvenement")
*/
public function annulerEvenement($id)
    {
        $evenement = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->find($id);
        $comments = $this->getDoctrine()
            ->getRepository(Comments::class)
            ->findBy(
                ['evenement' => $evenement]
            );
        $participants = $this->getDoctrine()
            ->getRepository(Participant::class)
            ->findBy(
                ['evenement' => $evenement]
            );
                // suppression des participantsen bdd
            foreach($participants as $participant)
            {
            $em = $this->getDoctrine()->getManager();
            $em->remove($participant);
            $em->flush();
            }
                // suppression des commentaires en bdd
            foreach($comments as $comment)
            {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
            }
                // suppression de l'événement en bdd
        $em = $this->getDoctrine()->getManager();
        $em->remove($evenement);
        $em->flush();
            // à la suppresion retour vers la page ajouterCategorie
        return $this->redirectToRoute('profil');
}
}