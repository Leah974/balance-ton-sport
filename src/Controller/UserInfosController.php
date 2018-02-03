<?php

namespace App\Controller;

use App\Form\UserInfosType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserInfosController extends Controller
{
    /**
     * @Route("/profil/infos", name="infos_profil")
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

        return $this->render(
            'security/profilinfos.html.twig',
            array('form' => $form->createView())
        );
    }
}