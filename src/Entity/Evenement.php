<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\Column(type="string", nullable=true, length=20)
     * @Assert\NotBlank()
     * @Assert\Length(
     *   min = 5,
     *   max = 20,
     *   minMessage = "Le titre de l'événement doit contenir au minimum 5 caractères...",
     *   maxMessage = "Le titre de l'événement doit contenir moins de 20 carcatères..."
     * )
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
      * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="evenement")
      * @ORM\JoinColumn(nullable=false)
      */
    private $user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\GreaterThan("+6 days", message="Cette date est trop proche. Vous pouvez créer un événement une semaine à l'avance minimum")
     * @var datetime $dateEvenement Date de l'événement
     */
    private $dateEvenement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int $participantMax Nombre maximum de participats attendu
     */
    private $participantMax;

    /**
      * @ORM\ManyToOne(targetEntity="App\Entity\Sport", inversedBy="evenement")
      * @ORM\JoinColumn(nullable=false)
      */
     private $sport; 

    /**
      * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="evenement")
      * @ORM\JoinColumn(nullable=false)
      */
     private $categorie;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau", inversedBy="evenement")
     * @ORM\JoinColumn(nullable=false) 
     * @var string $niveau Niveau attendu des participants
     */
    private $niveau;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string $adresse Adresse de l'événement
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", nullable=true, length=5)
     * @Assert\Length(
     *      min = 5,
     *      max = 5
     *      )
    */
    private $codePostal;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string $ville Ville dans laquelle se déroule l'événement
     */
    private $ville;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string $photo Lien de la photo associée à l'événement
     */
    private $photo;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="evenement")
    */
    private $comments; 

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="evenement")
    */
    private $participant; 

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var string $placesRestantes Places Restantes
     */
    private $placesRestantes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Alerte", mappedBy="evenement")
     */
    private $alertes;

    public function __construct()
    {
            // par défaut un evenement est public
        $this->setStatut(false);
            // par défaut la date de l'événement est 7 jours après la date du jour
        $this->dateEvenement = new \DateTime('+6 day');
    
        $this->alertes = new ArrayCollection();
    } 

    public function verifierDate($dateEvenement)
    {
        $date = new \DateTime('+6 day');
            if($dateEvenement<$date)
            {
               return false;
            }
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
     * @return string $titre Titre de l'événement
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre Titre de l'événement $titre
     *
     * @return self
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return string $description Description de l'événement
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description Description de l'événement $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return boolean $statut Evenement privé (true) ou public (false)
     */
    public function isStatut()
    {
        return $this->statut;
    }

    /**
     * @param boolean $statut Evenement privé (true) ou public (false) $statut
     *
     * @return self
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return string $organisateur Pseudo de l'organisateur
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $organisateur Pseudo de l'organisateur $organisateur
     *
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return date $dateEvenement Date de l'événement
     */
    public function getDateEvenement()
    {
        return $this->dateEvenement;
    }

    /**
     * @param date $dateEvenement Date de l'événement $dateEvenement
     *
     * @return self
     */
    public function setDateEvenement($dateEvenement)
    {

            $this->dateEvenement = $dateEvenement;

        return $this;
    }

    /**
     * @return int $participantMax Nombre maximum de participats attendu
     */
    public function getParticipantMax()
    {
        return $this->participantMax;
    }

    /**
     * @param int $participantMax Nombre maximum de participats attendu $participantMax
     *
     * @return self
     */
    public function setParticipantMax($participantMax)
    {
        $this->participantMax = $participantMax;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * @param mixed $sport
     *
     * @return self
     */
    public function setSport($sport)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * @return string $niveau Niveau attendu des participants
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param string $niveau Niveau attendu des participants $niveau
     *
     * @return self
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return string $photo Photo associée à l'événement
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo Photo associée à l'événement $photo
     *
     * @return self
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return string $adresse Adresse de l'événement
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse Adresse de l'événement $adresse
     *
     * @return self
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param mixed $codePostal
     *
     * @return self
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return string $ville Ville dans laquelle se déroule l'événement
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville Ville dans laquelle se déroule l'événement $ville
     *
     * @return self
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlertes()
    {
        return $this->alertes;
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

    /**
     * @return string $placesRestantes Places Restantes
     */
    public function getPlacesRestantes()
    {
        return $this->placesRestantes;
    }

    /**
     * @param string $placesRestantes Places Restantes $placesRestantes
     *
     * @return self
     */
    public function setPlacesRestantes($placesRestantes)
    {
        $this->placesRestantes = $placesRestantes;

        return $this;
    }
}
 