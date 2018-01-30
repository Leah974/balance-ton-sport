<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SportRepository")
 */
class Sport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string $nom Nom du sport
     */
    private $nom;

	/**
   * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="sport")
   */
 	private $evenement; 

    /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="sport")
   */
    private $categorie; 

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
     * @return string $nom Nom du sport
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom Nom du sport $nom
     *
     * @return self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

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
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     *
     * @return self
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }
}
