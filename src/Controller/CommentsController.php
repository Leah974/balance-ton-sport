<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CommentsController extends Controller
{
    /**
     * @Route("/comments", name="comments")
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('comments.html.twig');
    }
}
