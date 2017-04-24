<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Program
 *
 * @ORM\Table(name="program")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\ProgramRepository")
 */
class Program
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

     /**
     * @var datetime
     *
     * @ORM\Column(name="dateBeginning", type="datetime")
     */
    private $dateBeginning;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateEnding", type="datetime")
     */
    private $dateEnding;

    /**
     *
     * @ORM\OneToMany(targetEntity="ArticleBundle\Entity\Event", mappedBy="program")
     */
    private $events;


    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() 
{
    return $this->getTitle();
}

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
     * Set title
     *
     * @param string $title
     *
     * @return Program
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set dateBeginning
     *
     * @param \DateTime $dateBeginning
     *
     * @return Program
     */
    public function setDateBeginning($dateBeginning)
    {
        $this->dateBeginning = $dateBeginning;

        return $this;
    }

    /**
     * Get dateBeginning
     *
     * @return \DateTime
     */
    public function getDateBeginning()
    {
        return $this->dateBeginning;
    }

    /**
     * Set dateEnding
     *
     * @param \DateTime $dateEnding
     *
     * @return Program
     */
    public function setDateEnding($dateEnding)
    {
        $this->dateEnding = $dateEnding;

        return $this;
    }

    /**
     * Get dateEnding
     *
     * @return \DateTime
     */
    public function getDateEnding()
    {
        return $this->dateEnding;
    }

    /**
     * Add event
     *
     * @param \ArticleBundle\Entity\Event $event
     *
     * @return Program
     */
    public function addEvent(\ArticleBundle\Entity\Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \ArticleBundle\Entity\Event $event
     */
    public function removeEvent(\ArticleBundle\Entity\Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}
