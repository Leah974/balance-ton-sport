<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AlerteRepository")
 */
class Alerte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     * @var string $typeAlerte (nouvel inscrit, désinscription, nouveau commentaire, événement annulé)
     */
    private $typeAlerte;
    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @var boolean $statut Alerte lue (true) ou non lue (false)
     */
    private $statut;
    
    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="alertes")
     */
    private $users;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenement", inversedBy="alertes")
     * @ORM\JoinColumn(nullable=false)
     * @var string $evenement id de l'événement sur lequel l'alerte est rattachée
     */
    private $evenement;
    
    public function __construct()
    {
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
     * @return string $typeAlerte (nouvel inscrit, désinscription, nouveau commentaire, événement annulé)
     */
    public function getTypeAlerte()
    {
        return $this->typeAlerte;
    }
    /**
     * @param string $typeAlerte (nouvel inscrit, désinscription, nouveau commentaire, événement annulé) $typeAlerte
     *
     * @return self
     */
    public function setTypeAlerte($typeAlerte)
    {
        $this->typeAlerte = $typeAlerte;
        return $this;
    }
    /**
     * @return boolean $statut Alerte lue (true) ou non lue (false)
     */
    public function isStatut()
    {
        return $this->statut;
    }
    /**
     * @param boolean $statut Alerte lue (true) ou non lue (false) $statut
     *
     * @return self
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
        return $this;
    }
    public function addUser(User $user)
    {
        $this->users[] = $user;
    }
    /**
     * @return string $evenement id de l'événement sur lequel l'alerte est rattachée
     */
    public function getEvenement()
    {
        return $this->evenement;
    }
    /**
     * @param string $evenement id de l'événement sur lequel l'alerte est rattachée $evenement
     *
     * @return self
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;
        return $this;
    }
}