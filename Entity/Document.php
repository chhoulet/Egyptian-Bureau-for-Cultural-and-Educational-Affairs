<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document
 *
 * @ORM\Table(name="document")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\DocumentRepository")
 *
 */
class Document
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
     *      max = 255,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1550)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 1550,
     *      minMessage = "Your description must be at least {{ limit }} characters long",
     *      maxMessage = "Your description cannot be longer than {{ limit }} characters"
     * )
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="publicDoc", type="string", length=4)
     */
    private $publicDoc=1;//1=doc pour tous les boursiers    2=sentToAScholar   3=docForSchool

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=450)
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(
            mimeTypes={ "application/pdf" },
            maxSize = "4000k"),
            uploadFormSizeErrorMessage={"حجم الملف أكبر من القدر المسموح!"}
     */
    private $file;

    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", inversedBy="document")
     * @ORM\JoinTable(name="user_document")
     */
    private $user;


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
     * @return Document
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
     * @return Document
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
     * Set file
     *
     * @param string $file
     *
     * @return Document
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Document
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set publicDoc
     *
     * @param string $publicDoc
     *
     * @return Document
     */
    public function setPublicDoc($publicDoc)
    {
        $this->publicDoc = $publicDoc;

        return $this;
    }

    /**
     * Get publicDoc
     *
     * @return string
     */
    public function getPublicDoc()
    {
        return $this->publicDoc;
    }
}
