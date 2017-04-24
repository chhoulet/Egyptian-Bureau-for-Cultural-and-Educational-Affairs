<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\BookRepository")
 */
class Book
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
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "La taille minimum est de 2 caractères",
     *      maxMessage = "La taille maximum est de 200  caractères"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="titleArab", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "La taille minimum est de 2 caractères",
     *      maxMessage = "La taille maximum est de 200  caractères"
     * )
     */
    private $titleArab;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "La taille minimum est de 2 caractères",
     *      maxMessage = "La taille maximum est de 15  caractères"
     * )
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "La taille minimum est de 2 caractères",
     *      maxMessage = "La taille maximum est de 100  caractères"
     * )
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="authorArab", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "La taille minimum est de 2 caractères",
     *      maxMessage = "La taille maximum est de 100  caractères"
     * )
     */
    private $authorArab;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $publisher;

    /**
     * @var \Date
     *
     * @ORM\Column(name="yearPublication", type="date", nullable=true)
     *
     */
    private $yearPublication;

    /**
     * @var int
     *
     * @ORM\Column(name="pagesNumber", type="integer", nullable=true)   
     */
    private $pagesNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="copy", type="integer", nullable=true)     
     */
    private $copy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="available", type="boolean", nullable=true)
     */
    private $available=true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="desk", type="boolean", nullable=true)
     */
    private $desk=true;


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
     * @return Book
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
     * Set reference
     *
     * @param string $reference
     *
     * @return Book
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     *
     * @return Book
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

   
    /**
     * Set pagesNumber
     *
     * @param integer $pagesNumber
     *
     * @return Book
     */
    public function setPagesNumber($pagesNumber)
    {
        $this->pagesNumber = $pagesNumber;

        return $this;
    }

    /**
     * Get pagesNumber
     *
     * @return int
     */
    public function getPagesNumber()
    {
        return $this->pagesNumber;
    }

    /**
     * Set copy
     *
     * @param integer $copy
     *
     * @return Book
     */
    public function setCopy($copy)
    {
        $this->copy = $copy;

        return $this;
    }

    /**
     * Get copy
     *
     * @return int
     */
    public function getCopy()
    {
        return $this->copy;
    }

    /**
     * Set available
     *
     * @param boolean $available
     *
     * @return Book
     */
    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available
     *
     * @return boolean
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set desk
     *
     * @param boolean $desk
     *
     * @return Book
     */
    public function setDesk($desk)
    {
        $this->desk = $desk;

        return $this;
    }

    /**
     * Get desk
     *
     * @return boolean
     */
    public function getDesk()
    {
        return $this->desk;
    }

    /**
     * Set yearPublication
     *
     * @param \DateTime $yearPublication
     *
     * @return Book
     */
    public function setYearPublication($yearPublication)
    {
        $this->yearPublication = $yearPublication;

        return $this;
    }

    /**
     * Get yearPublication
     *
     * @return \DateTime
     */
    public function getYearPublication()
    {
        return $this->yearPublication;
    }

    /**
     * Set titleArab
     *
     * @param string $titleArab
     *
     * @return Book
     */
    public function setTitleArab($titleArab)
    {
        $this->titleArab = $titleArab;

        return $this;
    }

    /**
     * Get titleArab
     *
     * @return string
     */
    public function getTitleArab()
    {
        return $this->titleArab;
    }

    /**
     * Set authorArab
     *
     * @param string $authorArab
     *
     * @return Book
     */
    public function setAuthorArab($authorArab)
    {
        $this->authorArab = $authorArab;

        return $this;
    }

    /**
     * Get authorArab
     *
     * @return string
     */
    public function getAuthorArab()
    {
        return $this->authorArab;
    }
}
