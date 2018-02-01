<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommentType;
use App\Entity\Comments;
use App\Entity\User;
use App\Entity\Evenement;

class CommentsController extends Controller
{
    /**
     * @Route("/comments", name="comments")
     */

     public function newComment(request $request)
     {
    	$comment = new Comments();
    	$form = $this->createForm(CommentType::class, $comment);
    	 $form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid())
    	{
    	 $user = $this->getUser();
    	 $user_id = $user->getId();
    	 $comment->setUser($user_id);

    	 $evenement_id = $evenement->getId();
    	 $comment->setEvenement($evenement_id);

    	 $em = $this->getDoctrine()->getManager();
         $em->persist($comment);
         $em->flush();

            return $this->redirectToRoute('evenement');
        }
    	return $this->render('sitepublic/comments.html.twig', array('form' => $form->createView())
    );
     }
     /**
     * Affiche tous les événements publics (statut = false) rangés par ordre chronologique
     * @Route("/evenements/{id}/comments", name="commentaires")
     */
        public function showComments($id)
        {
                $comments = $this->getDoctrine()
                ->getRepository(Comments::class)
                ->find('$evenement_'.$id)
                ;

        return $this->render('sitepublic/comments.html.twig', ['comments' => $comments]);
        }

}
