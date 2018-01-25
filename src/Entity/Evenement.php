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
     * @ORM\Column(type="boolean")
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
     * @ORM\Column(type="date")
     * @var date $date Date de l'événement
     */
    private $date_evenement;

    /**
     * @ORM\Column(type="time")
     * @var time $heuredebut Heure de début de l'événement
     */
    private $heure_debut;

    /**
     * @ORM\Column(type="time")
     * @var time $heurefin Heure de fin de l'événement
     */
    private $heure_fin;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean $inscription Besoin de s'inscrire (true) ou non (false)
     */
    private $inscription;
    /**
     * @ORM\Column(type="integer")
     * @var int $participantmin Nombre minimum de participats requis
     */
    private $participant_min;

    /**
     * @ORM\Column(type="integer")
     * @var int $participantmax Nombre maximum de participats attendu
     */
    private $participant_max;

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
    private $date_limite;

    /**
     * @ORM\Column(type="integer")
     * @var int $prix Participation financière des participants
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     * @var int $codepostal Code postal du lieu de l'événement
     */
    private $code_postal;

    /**
     * @ORM\Column(type="integer", length=5)
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
    public function getStatut()
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
     * @return date $date Date de l'événement
     */
    public function getDateEvenement()
    {
        return $this->date_evenement;
    }

    /**
     * @param date $date Date de l'événement $date_evenement
     *
     * @return self
     */
    public function setDateEvenement($date_evenement)
    {
        $this->date_evenement = $date_evenement;

        return $this;
    }

    /**
     * @return time $heuredebut Heure de début de l'événement
     */
    public function getHeureDebut()
    {
        return $this->heure_debut;
    }

    /**
     * @param time $heuredebut Heure de début de l'événement $heure_debut
     *
     * @return self
     */
    public function setHeureDebut($heure_debut)
    {
        $this->heure_debut = $heure_debut;

        return $this;
    }

    /**
     * @return time $heurefin Heure de fin de l'événement
     */
    public function getHeureFin()
    {
        return $this->heure_fin;
    }

    /**
     * @param time $heurefin Heure de fin de l'événement $heure_fin
     *
     * @return self
     */
    public function setHeureFin($heure_fin)
    {
        $this->heure_fin = $heure_fin;

        return $this;
    }

    /**
     * @return int $participantmin Nombre minimum de participats requis
     */
    public function getParticipantMin()
    {
        return $this->participant_min;
    }

    /**
     * @param int $participantmin Nombre minimum de participats requis $participant_min
     *
     * @return self
     */
    public function setParticipantMin($participant_min)
    {
        $this->participant_min = $participant_min;

        return $this;
    }

    /**
     * @return int $participantmax Nombre maximum de participats attendu
     */
    public function getParticipantMax()
    {
        return $this->participant_max;
    }

    /**
     * @param int $participantmax Nombre maximum de participats attendu $participant_max
     *
     * @return self
     */
    public function setParticipantMax($participant_max)
    {
        $this->participant_max = $participant_max;

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
    public function getDateLimite()
    {
        return $this->date_limite;
    }

    /**
     * @param date $datelimite Date limite d'inscription à l'événement $date_limite
     *
     * @return self
     */
    public function setDateLimite($date_limite)
    {
        $this->date_limite = $date_limite;

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
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @param int $codepostal Code postal du lieu de l'événement $code_postal
     *
     * @return self
     */
    public function setCodePostal($code_postal)
    {
        $this->code_postal = $code_postal;

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

    /**
     * @return boolean $inscription Besoin de s'inscrire (true) ou non (false)
     */
    public function getInscription()
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
}
 