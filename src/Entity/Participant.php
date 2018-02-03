<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
      * @ORM\ManyToOne(targetEntity="App\Entity\Evenement", inversedBy="participant")
      * @ORM\JoinColumn(nullable=false) // si la relation est obligatoire
      */
     private $evenement; 

    /**
      * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="participant")
      * @ORM\JoinColumn(nullable=false) // si la relation est obligatoire
      */
    private $user; 

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
     * @return string $nom Nom de l'événement auquel les participants sont inscrits
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom Nom de l'événement auquel les participants sont inscrits $nom
     *
     * @return self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return string $evenement Id de l'événement concerné
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * @param string $evenement Id de l'événement concerné $evenement
     *
     * @return self
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * @return string $user Id de l'utilisateur inscrit à l'événement
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user Id de l'utilisateur inscrit à l'événement $user
     *
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}
