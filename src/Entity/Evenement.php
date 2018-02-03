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
     * @ORM\Column(type="string")
     * @var string $organisateur Pseudo de l'organisateur
     */
    private $organisateur;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\GreaterThan("+6 days", message="Cette date est trop proche. Vous pouvez créer un événement une semaine à l'avance minimum")
     * @var date $dateEvenement Date de l'événement
     */
    private $dateEvenement;

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
     * @ORM\Column(type="string", nullable=false, length=5)
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      minMessage = "Code postal invalide",
     *      maxMessage = "Code postal invalide"
     * )
     * @Assert\Regex(
     *      pattern="/\d/",
     * )
     * @var int $codePostal Code postal du lieu de l'événement
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", nullable=false)
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

    public function __construct()
    {
            // par défaut un evenement est public
        $this->setStatut(false);
            // par défaut la date de l'événement est 7 jours après la date du jour
        $this->dateEvenement = new \DateTime('+6 day');
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
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param string $organisateur Pseudo de l'organisateur $organisateur
     *
     * @return self
     */
    public function setOrganisateur($organisateur)
    {
        $this->organisateur = $organisateur;

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
     * @return boolean $inscription Besoin de s'inscrire (true) ou non (false)
     */
    public function isInscription()
    {
        return $this->inscription;
    }

    /**
     * @param boolean $inscription Besoin de s'inscrire (true) ou non (false) $inscription
     *
     * @return self
     */
    public function setInscription($inscription)
    {
        $this->inscription = $inscription;

        return $this;
    }

    /**
     * @return int $participantMin Nombre minimum de participats requis
     */
    public function getParticipantMin()
    {
        return $this->participantMin;
    }

    /**
     * @param int $participantMin Nombre minimum de participats requis $participantMin
     *
     * @return self
     */
    public function setParticipantMin($participantMin)
    {
        $this->participantMin = $participantMin;

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
     * @return int $codePostal Code postal du lieu de l'événement
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param int $codePostal Code postal du lieu de l'événement $codePostal
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
     * @return string $adresse Quartier où à lieu l'événement
     */
    public function getQuartier()
    {
        return $this->quartier;
    }

    /**
     * @param string $adresse Quartier où à lieu l'événement $quartier
     *
     * @return self
     */
    public function setQuartier($quartier)
    {
        $this->quartier = $quartier;

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
     * @return string $numero Numero de l'adresse de l'événement
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param string $numero Numero de l'adresse de l'événement $numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return string $rue Rue de l'événement
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param string $rue Rue de l'événement $rue
     *
     * @return self
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

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
}
 