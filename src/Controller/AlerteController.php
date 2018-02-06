<?php

namespace App\Controller;

use App\Entity\Alerte;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AlerteController extends Controller
{
    /**
 	* @Route("/alertestatut", name="statut")
 	*/
    public function changeStatutAlerte(Request $request)
    {

    	if ($request->isXmlHttpRequest()) {

    		$id = $request->request->get('id_alerte');

    		$alerte = $this->getDoctrine()
        		->getRepository(Alerte::class)
        		->find($id);

        	$alerte->setStatut(false);

        	$em = $this->getDoctrine()->getManager();
        	$em->persist($alerte);
        	$em->flush();

        }
        
        return $this->redirectToRoute('profil');
    }

}
