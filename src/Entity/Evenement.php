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
     * @var statut $statutPrix Gratuit (false) ou Payant (true)
     */
    private $statutPrix;

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
     * @var string $photo Lien de la photo associée à l'événement
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
     * @return time $heureDebut Heure de début de l'événement
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * @param time $heureDebut Heure de début de l'événement $heureDebut
     *
     * @return self
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * @return time $heureFin Heure de fin de l'événement
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * @param time $heureFin Heure de fin de l'événement $heureFin
     *
     * @return self
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

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
     * @return date $dateLimite Date limite d'inscription à l'événement
     */
    public function getDateLimite()
    {
        return $this->dateLimite;
    }

    /**
     * @param date $dateLimite Date limite d'inscription à l'événement $dateLimite
     *
     * @return self
     */
    public function setDateLimite($dateLimite)
    {
        $this->dateLimite = $dateLimite;

        return $this;
    }

    /**
     * @return statut $statutPrix Gratuit (false) ou Payant (true)
     */
    public function getStatutPrix()
    {
        return $this->statutPrix;
    }

    /**
     * @param statut $statutPrix Gratuit (false) ou Payant (true) $statutPrix
     *
     * @return self
     */
    public function setStatutPrix($statutPrix)
    {
        $this->statutPrix = $statutPrix;

        return $this;
    }

    /**
     * @return int $prix Participation financière des participants
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix Participation financière des participants $prix
     *
     * @return self
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

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
     * @return array $participant Liste des participants à l'événement
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param array $participant Liste des participants à l'événement $participant
     *
     * @return self
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;

        return $this;
    }
}
 