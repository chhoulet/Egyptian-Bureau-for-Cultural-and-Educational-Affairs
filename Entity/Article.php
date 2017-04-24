<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\ArticleRepository")
 */
class Article
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
     *      min = 10,
     *      max = 255,
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     *      maxMessage = "Your title cannot be longer than {{ limit }} characters"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=500, nullable=true)
     * @Assert\Length(
     *      min = 5,
     *      max = 500,
     *      minMessage = "Your subject must be at least {{ limit }} characters long",
     *      maxMessage = "Your subject cannot be longer than {{ limit }} characters"
     * )
     */
    private $subject;

     /**
     * @var integer
     *
     * @ORM\Column(name="origin", type="integer")
     *
     */
    private $origin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetimetz")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @var text
     *
     * @ORM\Column(name="main", type="text", length=15500)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 50,
     *      max = 15500,
     *      minMessage = "Your article must be at least {{ limit }} characters long",
     *      maxMessage = "Your article cannot be longer than {{ limit }} characters"
     * )
     */
    private $main;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 15500,
     *      minMessage = "The author must be at least {{ limit }} characters long",
     *      maxMessage = "The author cannot be longer than {{ limit }} characters"
     * )
     */
    private $author;

    /**
     * @var bool
     *
     * @ORM\Column(name="selected", type="boolean", nullable=true)
     */
    private $selected;   

     /**
     * @var string
     *
     * @ORM\Column(name="titleArab", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     *      maxMessage = "Your title cannot be longer than {{ limit }} characters"
     * )
     */
    private $titleArab;

    /**
     * @var string
     *
     * @ORM\Column(name="subjectArab", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 5,
     *      max = 500,
     *      minMessage = "Your subject must be at least {{ limit }} characters long",
     *      maxMessage = "Your subject cannot be longer than {{ limit }} characters"
     * )
     */
    private $subjectArab;

    /**
     * @var text
     *
     * @ORM\Column(name="mainArab", type="text", length=15500)
     * @Assert\Length(
     *      min = 10,
     *      max = 15500,
     *      minMessage = "Your article must be at least {{ limit }} characters long",
     *      maxMessage = "Your article cannot be longer than {{ limit }} characters"
     * )
     */
    private $mainArab;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=155, nullable=true)    
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=155, nullable=true)     
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="ArticleBundle\Entity\Newsletter", inversedBy="article")
     * @ORM\JoinTable(name="newsletter_article")
     */
    private $newsletter;    


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
     * @return Article
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Article
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
     * Set main
     *
     * @param string $main
     *
     * @return Article
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return string
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Article
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
     * Set selected
     *
     * @param boolean $selected
     *
     * @return Article
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;

        return $this;
    }

    /**
     * Get selected
     *
     * @return bool
     */
    public function getSelected()
    {
        return $this->selected;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Article
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
     * Set origin
     *
     * @param integer $origin
     *
     * @return Article
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return integer
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->newsletter = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add newsletter
     *
     * @param \ArticleBundle\Entity\Newsletter $newsletter
     *
     * @return Article
     */
    public function addNewsletter(\ArticleBundle\Entity\Newsletter $newsletter)
    {
        $this->newsletter[] = $newsletter;

        return $this;
    }

    /**
     * Remove newsletter
     *
     * @param \ArticleBundle\Entity\Newsletter $newsletter
     */
    public function removeNewsletter(\ArticleBundle\Entity\Newsletter $newsletter)
    {
        $this->newsletter->removeElement($newsletter);
    }

    /**
     * Get newsletter
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set titleArab
     *
     * @param string $titleArab
     *
     * @return Article
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
     * Set subjectArab
     *
     * @param string $subjectArab
     *
     * @return Article
     */
    public function setSubjectArab($subjectArab)
    {
        $this->subjectArab = $subjectArab;

        return $this;
    }

    /**
     * Get subjectArab
     *
     * @return string
     */
    public function getSubjectArab()
    {
        return $this->subjectArab;
    }

    /**
     * Set mainArab
     *
     * @param string $mainArab
     *
     * @return Article
     */
    public function setMainArab($mainArab)
    {
        $this->mainArab = $mainArab;

        return $this;
    }

    /**
     * Get mainArab
     *
     * @return string
     */
    public function getMainArab()
    {
        return $this->mainArab;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Article
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Article
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }
}
