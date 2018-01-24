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
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @var string $titre Titre de l'événement
     */
    private $titre;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @var string $description Description de l'événement
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @var string $statut Evenement privé ou public
     */
    private $statut;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="username")
     * @ORM\Column(type="string")
     * @var string $organisateur Pseudo de l'organisateur
     */
    private $organisateur;

    /**
     * @ORM\Column(type="date")
     * @var date $date Date de l'événement
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     * @var time $heuredebut Heure de début de l'événement
     */
    private $heuredebut;

    /**
     * @ORM\Column(type="integer")
     * @var time $heurefin Heure de fin de l'événement
     */
    private $heurefin;

    /**
     * @ORM\Column(type="integer")
     * @var int $participantmin Nombre minimum de participats requis
     */
    private $participantmin;

    /**
     * @ORM\Column(type="integer")
     * @var int $participantmax Nombre maximum de participats attendu
     */
    private $participantmax;

    /**
     * @ORM\Column(type="string")
     * @var string $sport Type de sport de l'événement
     */
    private $sport;

    /**
     * @ORM\Column(type="string")
     * @var string $niveau Niveau attendu des participants
     */
    private $niveau;

    /**
     * @ORM\Column(type="date")
     * @var date $datelimite Date limite d'inscription à l'événement
     */
    private $datelimite;

    /**
     * @ORM\Column(type="integer")
     * @var int $prix Participation financière des participants
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     * @var int $codepostal Code postal du lieu de l'événement
     */
    private $codepostal;

    /**
     * @ORM\Column(type="string")
     * @var string $ville Ville dans laquelle se déroule l'événement
     */
    private $ville;

    /**
     * @ORM\Column(type="string")
     * @var string $adresse Quartier où à lieu l'événement
     */
    private $quartier;

    /**
     * @ORM\Column(type="string")
     * @var string $photo Photo associée à l'événement
     */
    private $photo;

    /**
     * @ORM\Column(type="object")
	 * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="username")
     * @var array $participant Liste des participants à l'événement
     */
    private $participant;

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
     * @return string $statut Evenement privé ou public
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param string $statut Evenement privé ou public $statut
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
     * @return date $date Date de l'événement
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param date $date Date de l'événement $date
     *
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return time $heuredebut Heure de début de l'événement
     */
    public function getHeuredebut()
    {
        return $this->heuredebut;
    }

    /**
     * @param time $heuredebut Heure de début de l'événement $heuredebut
     *
     * @return self
     */
    public function setHeuredebut($heuredebut)
    {
        $this->heuredebut = $heuredebut;

        return $this;
    }

    /**
     * @return time $heurefin Heure de fin de l'événement
     */
    public function getHeurefin()
    {
        return $this->heurefin;
    }

    /**
     * @param time $heurefin Heure de fin de l'événement $heurefin
     *
     * @return self
     */
    public function setHeurefin($heurefin)
    {
        $this->heurefin = $heurefin;

        return $this;
    }

    /**
     * @return int $participantmin Nombre minimum de participats requis
     */
    public function getParticipantmin()
    {
        return $this->participantmin;
    }

    /**
     * @param int $participantmin Nombre minimum de participats requis $participantmin
     *
     * @return self
     */
    public function setParticipantmin($participantmin)
    {
        $this->participantmin = $participantmin;

        return $this;
    }

    /**
     * @return int $participantmax Nombre maximum de participats attendu
     */
    public function getParticipantmax()
    {
        return $this->participantmax;
    }

    /**
     * @param int $participantmax Nombre maximum de participats attendu $participantmax
     *
     * @return self
     */
    public function setParticipantmax($participantmax)
    {
        $this->participantmax = $participantmax;

        return $this;
    }

    /**
     * @return string $sport Type de sport de l'événement
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * @param string $sport Type de sport de l'événement $sport
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
     * @return date $datelimite Date limite d'inscription à l'événement
     */
    public function getDatelimite()
    {
        return $this->datelimite;
    }

    /**
     * @param date $datelimite Date limite d'inscription à l'événement $datelimite
     *
     * @return self
     */
    public function setDatelimite($datelimite)
    {
        $this->datelimite = $datelimite;

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
     * @return int $codepostal Code postal du lieu de l'événement
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * @param int $codepostal Code postal du lieu de l'événement $codepostal
     *
     * @return self
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

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
     * @return objects $participant Liste des participants à l'événement
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param objects $participant Liste des participants à l'événement $participant
     *
     * @return self
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;

        return $this;
    }
}
