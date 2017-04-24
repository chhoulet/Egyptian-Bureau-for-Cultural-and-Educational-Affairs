<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Newsletter
 *
 * @ORM\Table(name="newsletter")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\NewsletterRepository")
 */
class Newsletter
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
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     *      maxMessage = "Your title cannot be longer than {{ limit }} characters"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     *      maxMessage = "Your title cannot be longer than {{ limit }} characters"
     * )
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="dateCreated", type="string", length=255)
     */
    private $dateCreated;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateSended", type="datetime", nullable=true)
     */
    private $dateSended;

    /**
     * @var string
     *
     * @ORM\Column(name="main1", type="string", length=4000)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 20,
     *      max = 4000,
     *      minMessage = "Your article must be at least {{ limit }} characters long",
     *      maxMessage = "Your article cannot be longer than {{ limit }} characters"
     * )
     */
    private $main1;

    /**
     * @var string
     *
     * @ORM\Column(name="main2", type="string", length=4000, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 4000,
     *      minMessage = "Your article must be at least {{ limit }} characters long",
     *      maxMessage = "Your article cannot be longer than {{ limit }} characters"
     * )
     */
    private $main2;

    /**
     * @var string
     *
     * @ORM\Column(name="main3", type="string", length=4000, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 4000,
     *      minMessage = "Your article must be at least {{ limit }} characters long",
     *      maxMessage = "Your article cannot be longer than {{ limit }} characters"
     * )
     */
    private $main3;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="ArticleBundle\Entity\Article", mappedBy="newsletter")
     */
    private $article;


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
     * @return Newsletter
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
     * Set main1
     *
     * @param string $main1
     *
     * @return Newsletter
     */
    public function setMain1($main1)
    {
        $this->main1 = $main1;

        return $this;
    }

    /**
     * Get main1
     *
     * @return string
     */
    public function getMain1()
    {
        return $this->main1;
    }

    /**
     * Set main2
     *
     * @param string $main2
     *
     * @return Newsletter
     */
    public function setMain2($main2)
    {
        $this->main2 = $main2;

        return $this;
    }

    /**
     * Get main2
     *
     * @return string
     */
    public function getMain2()
    {
        return $this->main2;
    }

    /**
     * Set main3
     *
     * @param string $main3
     *
     * @return Newsletter
     */
    public function setMain3($main3)
    {
        $this->main3 = $main3;

        return $this;
    }

    /**
     * Get main3
     *
     * @return string
     */
    public function getMain3()
    {
        return $this->main3;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->article = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set dateCreated
     *
     * @param string $dateCreated
     *
     * @return Newsletter
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return string
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateSended
     *
     * @param \DateTime $dateSended
     *
     * @return Newsletter
     */
    public function setDateSended($dateSended)
    {
        $this->dateSended = $dateSended;

        return $this;
    }

    /**
     * Get dateSended
     *
     * @return \DateTime
     */
    public function getDateSended()
    {
        return $this->dateSended;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Newsletter
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
     * Add article
     *
     * @param \ArticleBundle\Entity\Article $article
     *
     * @return Newsletter
     */
    public function addArticle(\ArticleBundle\Entity\Article $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \ArticleBundle\Entity\Article $article
     */
    public function removeArticle(\ArticleBundle\Entity\Article $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticle()
    {
        return $this->article;
    }
}
