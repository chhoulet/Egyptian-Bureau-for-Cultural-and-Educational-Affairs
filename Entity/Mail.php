<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Mail
 *
 * @ORM\Table(name="mail")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\MailRepository")
 * @UniqueEntity("mail")
 */
class Mail
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
     * @ORM\Column(name="mail", type="string", length=255, unique=true)     
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * 
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)       
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters"
     * )
     * 
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)        
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"     
     * )
     * 
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=255, nullable=true)    
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your job must be at least {{ limit }} characters long",
     *      maxMessage = "Your job cannot be longer than {{ limit }} characters"  
     * )
     * 
     */
    private $job;

    /**
     * @var integer
     *
     * @ORM\Column(name="event", type="integer", nullable=true)     
     * 
     */
    private $event;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer")     
     * 
     */
    private $active=2;


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
     * Set mail
     *
     * @param string $mail
     *
     * @return Mail
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
     * Set name
     *
     * @param string $name
     *
     * @return Mail
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
     * @return Mail
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
     * Set job
     *
     * @param string $job
     *
     * @return Mail
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
     * Set event
     *
     * @param integer $event
     *
     * @return Mail
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return integer
     */
    public function getEvent()
    {
        return $this->event;
    }

     /**
     * Set active
     *
     * @param integer $active
     *
     * @return Mail
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }
}
