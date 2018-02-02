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
     * @Route("/evenements/{id}/comments", name="commentaires")
     */

     public function newComment(request $request, $id)
     {
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
    	return $this->render('sitepublic/comments.html.twig', array('form' => $form->createView(), 'comments' => $comments)
    	);
     }

     // /**
     // * Affiche tous les commentaires liés à l'evenement
     // * @Route("/evenements/{id}/comments", name="commentaires")
     // */
     //    public function showComments($id)
     //    {


     //    return $this->render('sitepublic/comments.html.twig', ['comments' => $comments]);
     //    }

}
