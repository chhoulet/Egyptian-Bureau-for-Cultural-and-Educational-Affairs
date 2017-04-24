<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\AnswerRepository")
 */
class Answer
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
     * @Assert\Length(
     *      min = 50,
     *      max = 255,
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     *      maxMessage = "Your title cannot be longer than {{ limit }} characters"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=3555)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 50,
     *      max = 3555,
     *      minMessage = "Your article must be at least {{ limit }} characters long",
     *      maxMessage = "Your article cannot be longer than {{ limit }} characters"
     * )
     */
    private $message;   

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="ArticleBundle\Entity\Message", inversedBy="answer")
     * @ORM\JoinColumn(name="message_id", referencedColumnName="id")
     */
    private $messageUser;


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
     * @return Answer
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
     * Set message
     *
     * @param string $message
     *
     * @return Answer
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Answer
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
     * Set messageUser
     *
     * @param \ArticleBundle\Entity\Message $messageUser
     *
     * @return Answer
     */
    public function setMessageUser(\ArticleBundle\Entity\Message $messageUser = null)
    {
        $this->messageUser = $messageUser;

        return $this;
    }

    /**
     * Get messageUser
     *
     * @return \ArticleBundle\Entity\Message
     */
    public function getMessageUser()
    {
        return $this->messageUser;
    }
}
