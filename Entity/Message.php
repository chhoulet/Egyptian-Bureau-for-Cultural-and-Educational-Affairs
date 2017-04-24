<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\MessageRepository")
 */
class Message
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)    
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     *      maxMessage = "Your title cannot be longer than {{ limit }} characters"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your name be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetimetz")
     */
    private $dateCreated;

    /**
     * @var text
     *
     * @ORM\Column(name="message", type="text", length=900)
     * @Assert\Length(
     *      min = 20,
     *      max = 900,
     *      minMessage = "Your message be at least {{ limit }} characters long",
     *      maxMessage = "Your message cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank()
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email(message = "This mail '{{ value }}' is not valid !")
     */
    private $mail;

    /**
     * @var integer
     *
     * @ORM\Column(name="receiver", type="integer")
     */
    private $receiver;

    /**
     * @var boolean
     *
     * @ORM\Column(name="readMessage", type="boolean")
     */
    private $readMessage=0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="answeredMessage", type="boolean")
     */
    private $answeredMessage=0;

    /**     
     *
     * @ORM\OneToMany(targetEntity="ArticleBundle\Entity\Answer", mappedBy="messageUser", cascade={"remove"})
     */
    private $answer;


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
     * Set title
     *
     * @param string $title
     *
     * @return Message
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
     * Set name
     *
     * @param string $name
     *
     * @return Message
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Message
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Message
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
     * Set readMessage
     *
     * @param boolean $readMessage
     *
     * @return Message
     */
    public function setReadMessage($readMessage)
    {
        $this->readMessage = $readMessage;

        return $this;
    }

    /**
     * Get readMessage
     *
     * @return boolean
     */
    public function getReadMessage()
    {
        return $this->readMessage;
    }

    /**
     * Set receiver
     *
     * @param integer $receiver
     *
     * @return Message
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return integer
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set answeredMessage
     *
     * @param boolean $answeredMessage
     *
     * @return Message
     */
    public function setAnsweredMessage($answeredMessage)
    {
        $this->answeredMessage = $answeredMessage;

        return $this;
    }

    /**
     * Get answeredMessage
     *
     * @return boolean
     */
    public function getAnsweredMessage()
    {
        return $this->answeredMessage;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answer = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add answer
     *
     * @param \ArticleBundle\Entity\Answer $answer
     *
     * @return Message
     */
    public function addAnswer(\ArticleBundle\Entity\Answer $answer)
    {
        $this->answer[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \ArticleBundle\Entity\Answer $answer
     */
    public function removeAnswer(\ArticleBundle\Entity\Answer $answer)
    {
        $this->answer->removeElement($answer);
    }

    /**
     * Get answer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
