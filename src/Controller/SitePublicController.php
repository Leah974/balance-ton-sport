<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Sport;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// le SitePublicController gère la vue générale du site, voir le fichier base.html.twig dans le dossier templates
class SitePublicController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction(Request $request, $acunresultat = false)
    {
        $evenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findBy(
                ['statut' => false],
                ['dateEvenement' => 'ASC']
            );

    	$sports = $this->getDoctrine()
                	   ->getRepository(Sport::class)
                       ->findAll(); 

            if(isset($_POST['sport']) || isset($_POST['ville']))
            {

                if(empty($_POST['sport']))

                    {$recupSport = null; }
                else{

                    $sport = $request->request->get('sport');

                        $recupSport = $this->getDoctrine()
                        ->getRepository(Sport::class)
                        ->findOneBy(
                            ['nom' => $sport]
                        );
                }

                if(empty($_POST['ville']))

                    {$ville = null; }

                else{

                    $ville = ucfirst($request->request->get('ville'));

                }

            $evenements = $this->getDoctrine()
                ->getRepository(Evenement::class)
                ->findEvenementAccueil($recupSport, $ville);

            if(count($evenements) == 0){
  
                $aucunResultat = true;   
            }

            }

        return $this->render('sitepublic/index.html.twig', ['sports' => $sports]);
    }
}
