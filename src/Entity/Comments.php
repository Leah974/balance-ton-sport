<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
	 * @ORM\ManyToOne(targetEntity="App\Entity\User")
	 * @ORM\JoinColumn(nullable=false)
	 */
    private $user;

//https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony/les-relations-entre-entites-avec-doctrine2-1

     /**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Evenement")
	 * @ORM\JoinColumn(nullable=false)
	 */
  	private $evenement;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaire;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    // add your own fields
     public function __construct()
     {
     	$this->date = new \Datetime();
     }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $id_user
     *
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * @param mixed $evenement
     *
     * @return self
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     *
     * @return self
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCommentaire()
    {
        return $this->date_commentaire;
    }

    /**
     * @param mixed $date_commentaire
     *
     * @return self
     */
    public function setDateCommentaire($date_commentaire)
    {
        $this->date_commentaire = $date_commentaire;

        return $this;
    }
}

 
    
   