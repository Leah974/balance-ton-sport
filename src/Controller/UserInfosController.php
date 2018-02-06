<?php

namespace App\Controller;

use App\Form\UserInfosType;
use App\Entity\User;
use App\Entity\Evenement;
use App\Entity\Participant;
use App\Entity\Alerte;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserInfosController extends Controller
{
    /**
     * @Route("/profil", name="profil")
     */
    public function registerUserInfos(Request $request)
    {
        $user_infos = $this->getUser();
            
            // si utilisateur non connecté
            if (!$user_infos) {
            // à la validation du formulaire, renvoie vers la page de connexion
            return $this->redirectToRoute('connexion');

            }

        $form = $this->createForm(UserInfosType::class, $user_infos);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            // dossier d'enregistrement de la photo du user
            $dir = 'img/uploads/user';
                // recuperation de la photo uploadé et recuperation de l'extension
            $file = $form['photo']->getData();
            $extension = $file->guessExtension();
                // si l'extension n'est pas reconnu on affecte une extension jpeg
            if (!$extension) {
                // extension cannot be guessed
                $extension = 'jpeg';
            }
                // on renomme la photo en 'photouser(chiffre entre 1 et 99999).extension'
            $nomPhoto = 'photouser'.rand(1, 99999).'.'.$extension;
                // on deplace la photo dans le dossier
            $file->move($dir, $nomPhoto);
            $user_infos->setPhoto($nomPhoto);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user_infos);
            $em->flush();

           return $this->redirectToRoute('profil'); 
        }

        $organiseEvenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findBy(
                ['user' => $user_infos],
                ['dateEvenement' => 'ASC']
            );

            $organiseAucun = false;
            $organiseNombre = count($organiseEvenements);

            if($organiseNombre == 0)
            {
                $organiseAucun = true;
            }

         $participants = $this->getDoctrine()
            ->getRepository(Participant::class)
            ->findBy(
                ['user' => $user_infos]
            );

            $participeAucun = false;
            $participeNombre = count($participants);

            if($participeNombre == 0)
            {
                $participeAucun = true;
            }

        //Gestion des alertes

        $evenements = array();

        $alertes = $user_infos->getAlertes();
        $nbAlertes = 0;

        foreach ($alertes as $key => $alerte) {
            $statut = $alerte->isStatut();
            if ($statut == 1) {
                $evenements[] = $alerte->getEvenement();
                $nbAlertes++;
            }
        }

        return $this->render(
            'security/profil.html.twig',array(
                'form' => $form->createView(), 
                'organiseEvenements' => $organiseEvenements, 
                'organiseAucun' => $organiseAucun,
                'organiseNombre' => $organiseNombre,
                'participants' => $participants, 
                'participeAucun' => $participeAucun, 
                'participeNombre' => $participeNombre,
                'alertes' => $alertes, 
                'evenements' => $evenements, 
                'nbAlertes' => $nbAlertes
            ));
    }


}