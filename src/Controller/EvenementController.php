<?php

namespace App\Controller;

use App\Form\EvenementType;
use App\Entity\Evenement;
use App\Entity\Sport;
use App\Entity\User;
use App\Entity\Niveau;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class EvenementController extends Controller
{
    /**
     * @Route("/evenements/proposer", name="proposerevenements")
     */
    public function registerEvenement(Request $request)
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();

            if (!$user) {

            return $this->redirectToRoute('connexion');

            }

            $dir = 'img/uploads';

            $file = $form['photo']->getData();
            $extension = $file->guessExtension();

            if (!$extension) {
                // extension cannot be guessed
                $extension = 'bin';
            }
            $nomPhoto = 'photoevenement'.rand(1, 99999).'.'.$extension;
            $file->move($dir, $nomPhoto);

            $evenement->setPhoto($nomPhoto);

            $username = $user->getUsername();
            $evenement->setOrganisateur($username);

            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render(
            'sitepublic/proposer.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/evenements/{id}", name="detailsEvenements")
     */
    public function showDetailsEvenement($id)
    {
        $evenement = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->find($id);

        if (!$evenement) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->render('sitepublic/details.html.twig', ['evenement' => $evenement]);
    }

    // /**
    //  * @Route("/evenements", name="evenements")
    //  */
    //     public function showEvenement()
    //     {
    //     $repository = $this->getDoctrine()->getRepository(Evenement::class);
    //     $evenement = $repository->findAll();



    //     return $this->render('sitepublic/evenements.html.twig', ['evenement' => $evenement]);
    //     }
}
