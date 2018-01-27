<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     * @var string $titre Titre de l'événement
     */
    private $titre;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     * @var string $description Description de l'événement
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @var boolean $statut Evenement privé (true) ou public (false)
     */
    private $statut;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="username")
     * @ORM\Column(type="string")
     * @var string $organisateur Pseudo de l'organisateur
     */
    private $organisateur;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var date $dateEvenement Date de l'événement
     */
    private $dateEvenement;

    /**
     * @ORM\Column(type="time", nullable=true)
     * @var time $heureDebut Heure de début de l'événement
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="time", nullable=true)
     * @var time $heureFin Heure de fin de l'événement
     */
    private $heureFin;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @var boolean $inscription Besoin de s'inscrire (true) ou non (false)
     */
    private $inscription;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int $participantMin Nombre minimum de participats requis
     */
    private $participantMin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int $participantMax Nombre maximum de participats attendu
     */
    private $participantMax;

    /**
      * @ORM\ManyToOne(targetEntity="App\Entity\Sport", inversedBy="evenement")
      * @ORM\JoinColumn(nullable=false) // si la relation est obligatoire
      */
     private $sport; 

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau", inversedBy="evenement")
     * @ORM\JoinColumn(nullable=false) // si la relation est obligatoire
     * @var string $niveau Niveau attendu des participants
     */
    private $niveau;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var date $dateLimite Date limite d'inscription à l'événement
     */
    private $dateLimite;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @var statut $statut_prix Gratuit (false) ou Payant (true)
     */
    private $statut_prix;

    /**
     * @ORM\Column(type="integer")
     * @var int $prix Participation financière des participants
     */
    private $prix;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int $codePostal Code postal du lieu de l'événement
     */
    private $codePostal;

    /**
     * @ORM\Column(type="integer", length=5, nullable=true)
     * @var string $ville Ville dans laquelle se déroule l'événement
     */
    private $ville;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string $adresse Quartier où à lieu l'événement
     */
    private $quartier;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string $photo Photo associée à l'événement
     */
    private $photo;

    /**
     * @ORM\Column(type="object")
	 * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="username")
     * @var array $participant Liste des participants à l'événement
     */
    private $participant;

    public function __construct()
    {
            // par défaut un evenement est public
        $this->setStatut(false);
    }

  

    
}
 