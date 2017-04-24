<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Counseillor
 *
 * @ORM\Table(name="counseillor")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\CounseillorRepository")
 * @Vich\Uploadable
 */
class Counseillor
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()      
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="nameArab", type="string", length=255)
     * @Assert\NotBlank()      
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $nameArab;     

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre prénom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstNameArab", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre prénom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $firstNameArab;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "La fonction de cette personne ne peut contenir moins de {{ limit }} caractères",
     *      maxMessage = "La fonction de cette personne ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="jobArab", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "La fonction de cette personne ne peut contenir moins de {{ limit }} caractères",
     *      maxMessage = "La fonction de cette personne ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $jobArab;

    /**
     * @var int
     *
     * @ORM\Column(name="phone", type="integer", nullable=true)
     */
    private $phone;

    /**
     * @var int
     *
     * @ORM\Column(name="fax", type="integer", nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)      
     */
    private $mail;    

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2555, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 2555,
     *      minMessage = " La description de cette personne ne peut contenir moins de {{ limit }} caractères",
     *      maxMessage = " La description de cette personne ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionArab", type="string", length=2555, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 2555,
     *      minMessage = " La description de cette personne ne peut contenir moins de {{ limit }} caractères",
     *      maxMessage = " La description de cette personne ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $descriptionArab;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active=true;

     /**
     * @var int
     *
     * @ORM\Column(name="hierarchicLevel", type="integer")
     * @Assert\Type("integer")
     */
    private $hierarchicLevel;

    /**
     *
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $image;

     /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;


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
     * @return Counseillor
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
     * Set job
     *
     * @param string $job
     *
     * @return Counseillor
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return Counseillor
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     *
     * @return Counseillor
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return int
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Counseillor
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Counseillor
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Counseillor
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Counseillor
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set nameArab
     *
     * @param string $nameArab
     *
     * @return Counseillor
     */
    public function setNameArab($nameArab)
    {
        $this->nameArab = $nameArab;

        return $this;
    }

    /**
     * Get nameArab
     *
     * @return string
     */
    public function getNameArab()
    {
        return $this->nameArab;
    }

    /**
     * Set firstNameArab
     *
     * @param string $firstNameArab
     *
     * @return Counseillor
     */
    public function setFirstNameArab($firstNameArab)
    {
        $this->firstNameArab = $firstNameArab;

        return $this;
    }

    /**
     * Get firstNameArab
     *
     * @return string
     */
    public function getFirstNameArab()
    {
        return $this->firstNameArab;
    }

    /**
     * Set jobArab
     *
     * @param string $jobArab
     *
     * @return Counseillor
     */
    public function setJobArab($jobArab)
    {
        $this->jobArab = $jobArab;

        return $this;
    }

    /**
     * Get jobArab
     *
     * @return string
     */
    public function getJobArab()
    {
        return $this->jobArab;
    }

    /**
     * Set descriptionArab
     *
     * @param string $descriptionArab
     *
     * @return Counseillor
     */
    public function setDescriptionArab($descriptionArab)
    {
        $this->descriptionArab = $descriptionArab;

        return $this;
    }

    /**
     * Get descriptionArab
     *
     * @return string
     */
    public function getDescriptionArab()
    {
        return $this->descriptionArab;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Counseillor
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Counseillor
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set hierarchicLevel
     *
     * @param integer $hierarchicLevel
     *
     * @return Counseillor
     */
    public function setHierarchicLevel($hierarchicLevel)
    {
        $this->hierarchicLevel = $hierarchicLevel;

        return $this;
    }

    /**
     * Get hierarchicLevel
     *
     * @return integer
     */
    public function getHierarchicLevel()
    {
        return $this->hierarchicLevel;
    }
}
