<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\EventRepository")
 */
class Event
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
     *      minMessage = "Le nom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le nom ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateEvent", type="date")
     * @Assert\NotBlank()
     */
    private $dateEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=3500)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 3500,
     *      minMessage = " La description ne peut contenir moins de {{ limit }} caractères",
     *      maxMessage = " La description ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 500,
     *      minMessage = " Le lieu ne peut contenir moins de {{ limit }} caractères",
     *      maxMessage = " Le lieu ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $place;

     /**
     *
     * @ORM\ManyToOne(targetEntity="ArticleBundle\Entity\Program", inversedBy="events", cascade={"persist"})
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id", nullable=true)
     */
    private $program;

    /**
     * @var boolean
     *
     * @ORM\Column(name="boursier", type="boolean", length=255)
     */
    private $boursier;


    /**
     * Get id
     *
     * @return integer
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
     * @return Event
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
     * Set description
     *
     * @param string $description
     *
     * @return Event
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
     * Set place
     *
     * @param string $place
     *
     * @return Event
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set program
     *
     * @param \ArticleBundle\Entity\Program $program
     *
     * @return Event
     */
    public function setProgram(\ArticleBundle\Entity\Program $program = null)
    {
        $this->program = $program;

        return $this;
    }

    /**
     * Get program
     *
     * @return \ArticleBundle\Entity\Program
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * Set boursier
     *
     * @param boolean $boursier
     *
     * @return Event
     */
    public function setBoursier($boursier)
    {
        $this->boursier = $boursier;

        return $this;
    }

    /**
     * Get boursier
     *
     * @return boolean
     */
    public function getBoursier()
    {
        return $this->boursier;
    }

    /**
     * Set dateEvent
     *
     * @param \DateTime $dateEvent
     *
     * @return Event
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    /**
     * Get dateEvent
     *
     * @return \DateTime
     */
    public function getDateEvent()
    {
        return $this->dateEvent;
    }
}
