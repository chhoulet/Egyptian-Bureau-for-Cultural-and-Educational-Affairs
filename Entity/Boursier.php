<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Bousier
 *
 * @ORM\Table(name="boursier")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\BoursierRepository")
 */
class Boursier 
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre prénom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre adresse doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre adresse ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    protected $adress;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre code postal doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre code postal ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    protected $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom de la ville doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de la ville  ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    protected $city;

     /**
     * @var int
     *
     * @ORM\Column(name="telfix", type="integer", nullable=true)    
     */
    protected $telfix;

    /**
     * @var int
     *
     * @ORM\Column(name="telpor", type="integer", nullable=true)    
     */
    protected $telpor;

    /**
     * @var int
     *
     * @ORM\Column(name="telegy", type="integer", nullable=true)    
     */
    protected $telegy;

    /**
     * @var \Date
     *
     * @ORM\Column(name="arrivalDate", type="date", nullable=true)
     *
     */
    protected $arrivalDate;

    /**
     * @var \Date
     *
     * @ORM\Column(name="birthDate", type="date", nullable=true)
     *
     */
    protected $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom du domaine d'études doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le nom du domaine d'études ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    protected $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre  sujet d'étude doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre  sujet d'étude ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    protected $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="universityEgypt", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Votre université ou corps de rattachement  doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre université ou corps de rattachement  ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    protected $universityEgypt;

    /**
     * @var string
     *
     * @ORM\Column(name="universityFrench", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Votre  université française doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre  université française ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    protected $universityFrench;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=455, nullable=true)
     * @Assert\Length(
     *      min = 20,
     *      max = 500,
     *      minMessage = "Votre  commentaire doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre  commentaire ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    protected $comment;

     /**
     * @var \boolean
     *
     * @ORM\Column(name="activated", type="boolean")
     *
     */
    protected $activated=true;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User", inversedBy="boursier")
     *    
     */
    protected $user;

    public function getFullName()
    {
        return $this->getFirstname().' '. $this->getName();
    }

    public function getFullAdress()
    {
        return $this->getAdress() .' '. $this->getPostcode() .' '. $this->getCity();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Boursier
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Boursier
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Boursier
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return Boursier
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Boursier
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return Boursier
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Boursier
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set universityEgypt
     *
     * @param string $universityEgypt
     *
     * @return Boursier
     */
    public function setUniversityEgypt($universityEgypt)
    {
        $this->universityEgypt = $universityEgypt;

        return $this;
    }

    /**
     * Get universityEgypt
     *
     * @return string
     */
    public function getUniversityEgypt()
    {
        return $this->universityEgypt;
    }

    /**
     * Set universityFrench
     *
     * @param string $universityFrench
     *
     * @return Boursier
     */
    public function setUniversityFrench($universityFrench)
    {
        $this->universityFrench = $universityFrench;

        return $this;
    }

    /**
     * Get universityFrench
     *
     * @return string
     */
    public function getUniversityFrench()
    {
        return $this->universityFrench;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Boursier
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }


    /**
     * Set arrivalDate
     *
     * @param \DateTime $arrivalDate
     *
     * @return Boursier
     */
    public function setArrivalDate($arrivalDate)
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    /**
     * Get arrivalDate
     *
     * @return \DateTime
     */
    public function getArrivalDate()
    {
        return $this->arrivalDate;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return Boursier
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set activated
     *
     * @param boolean $activated
     *
     * @return Boursier
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;

        return $this;
    }

    /**
     * Get activated
     *
     * @return boolean
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Boursier
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set telfix
     *
     * @param integer $telfix
     *
     * @return Boursier
     */
    public function setTelfix($telfix)
    {
        $this->telfix = $telfix;

        return $this;
    }

    /**
     * Get telfix
     *
     * @return integer
     */
    public function getTelfix()
    {
        return $this->telfix;
    }

    /**
     * Set telpor
     *
     * @param integer $telpor
     *
     * @return Boursier
     */
    public function setTelpor($telpor)
    {
        $this->telpor = $telpor;

        return $this;
    }

    /**
     * Get telpor
     *
     * @return integer
     */
    public function getTelpor()
    {
        return $this->telpor;
    }

    /**
     * Set telegy
     *
     * @param integer $telegy
     *
     * @return Boursier
     */
    public function setTelegy($telegy)
    {
        $this->telegy = $telegy;

        return $this;
    }

    /**
     * Get telegy
     *
     * @return integer
     */
    public function getTelegy()
    {
        return $this->telegy;
    }
}
