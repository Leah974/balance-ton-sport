<?php

namespace App\Controller;

use App\Entity\Alerte;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlerteController extends Controller
{
    /**
     * Afficher les alertes dans le profil de l'utilisateur
     * @Route("/profil/alertes", name="afficherAlerte")
     */
    public function afficherAlerte(Request $request)
    {
    	$user = $this->getUser();

    	$alertes = $user->getAlertes();
    	foreach ($alertes as $key => $alerte) {
    		$evenements[] = $alerte->getEvenement();
    	}

        return $this->render('sitepublic/alerte.html.twig', ['alertes' => $alertes, 'evenements' => $evenements, 'nbAlertes' => count($alertes)]);
       
    }
}