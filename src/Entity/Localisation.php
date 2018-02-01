<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocalisationsRepository")
 */
class Localisation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @var integer $departement Numéro de département
     */
     private $departement; 

    /**
     * @ORM\Column(type="string")
     * @var string $ville nom de la ville
     */
    private $ville; 

    /**
     * @ORM\Column(type="string", length=5)
     * @var string $codePostal Code postal de la ville
     */
     private $codePostal; 

    /**
   * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="localisation")
   */
    private $evenement; 

    public function __toString()
    {
        return $this->getVille();
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
     * @return integer $departement Numéro de département
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * @param integer $departement Numéro de département $departement
     *
     * @return self
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return string $ville nom de la ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville nom de la ville $ville
     *
     * @return self
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return string $codePostal Code postal de la ville
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param string $codePostal Code postal de la ville $codePostal
     *
     * @return self
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

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
}
