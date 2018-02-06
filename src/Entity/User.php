<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

// Entity User.php est le modèle qui s'occupe des requêtes avec la base de données pour les infor utilisateur
// Les annotations commençant par @ORM sont importantes car elles permettent de spéficier des informations sur les propriétés et méthodes en bdd
// Les annotations en @Assert sont des contrôles sur les informations voulues dans le formulaire (champ obligatoire, longueur, etc,.)

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * Unique Entiy permet de spécifier que l'email et le pseudo doivent être uniques
 * @UniqueEntity("email", message="Cet e-mail existe déjà")
 * @UniqueEntity("username", message="Ce pseudo est déjà existant")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\Length(
     *      min = 3,
     *      max = 25,
     *      minMessage = "Votre pseudo doit avoir au minimum {{ limit }} caractères",
     *      maxMessage = "Votre pseudo doit avoir au maximum {{ limit }} caractères"
     * )
     * @Assert\NotBlank()(groups={"inscription"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\Length(
     *      min = 8,
     *      max = 14,
     *      minMessage = "Votre mot de passe doit avoir au minimum {{ limit }} caractères",
     *      maxMessage = "Votre mot de passe doit avoir au maximum {{ limit }} caractères"
     * )(groups={"inscription"})
     * @Assert\NotBlank()(groups={"inscription"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas correct.",
     *     checkMX = true
     * )(groups={"inscription"})
     */
    private $email;

    /**
     * Permet de rendre un compte est accessible ou inaccessible à son utilisateur (on peut bannir)
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="user")
    */
    private $comments; 

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $sport_favori;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dte_naissance;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="text", length=30, nullable=true)
     */
    private $mini_bio;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="user")
    */
    private $participant; 


    public function __construct()
    {
        $this->setIsActive(true);
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
        $this->photo='avatar.png';

        $this->setRoles(array ('ROLE_SUPER_ADMIN'));
    }

    /**
     * salt permet de hacher le mot de passe
     * Ici retourne null car nous n'utilisons pas le hachage mais l'encodage
     * La méthode est tout de même obligatoire
     * @return null|string
     */
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
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
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }
   /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     *
     * @return self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     *
     * @return self
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSportFavori()
    {
        return $this->sport_favori;
    }

    /**
     * @param mixed $sport_favori
     *
     * @return self
     */
    public function setSportFavori($sport_favori)
    {
        $this->sport_favori = $sport_favori;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     *
     * @return self
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     *
     * @return self
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDteNaissance()
    {
        return $this->dte_naissance;
    }

    /**
     * @param mixed $dte_naissance
     *
     * @return self
     */
    public function setDteNaissance($dte_naissance)
    {
        $this->dte_naissance = $dte_naissance;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
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
    public function getMiniBio()
    {
        return $this->mini_bio;
    }

    /**
     * @param mixed $mini_bio
     *
     * @return self
     */
    public function setMiniBio($mini_bio)
    {
        $this->mini_bio = $mini_bio;

        return $this;
    }

}
