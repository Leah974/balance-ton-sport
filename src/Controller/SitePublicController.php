<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// le SitePublicController gère la vue générale du site, voir le fichier base.html.twig dans le dossier templates
class SitePublicController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction()
    {
        return $this->render('sitepublic/index.html.twig', array());
    }
}
