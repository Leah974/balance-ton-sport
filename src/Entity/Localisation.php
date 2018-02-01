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
    * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="localisation")
    */
    private $ville; 

    /**
     * @ORM\Column(type="string", length=5)
     * @var string $codePostal Code postal de la ville
     */
     private $codePostal; 

}
