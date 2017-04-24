<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="ArticleBundle\Entity\Boursier", mappedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)    
     */
    protected $boursier;

     /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="ArticleBundle\Entity\Document", mappedBy="user")        
     */
    protected $document;  

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
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->document = new \Doctrine\Common\Collections\ArrayCollection();
    }

     /**
     * Add Document
     *
     * @param \ArticleBundle\Entity\Document $document
     *
     * @return Document
     */
    public function addDocument(\ArticleBundle\Entity\Document $document)
    {
        $this->document[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \ArticleBundle\Entity\Document $document
     */
    public function removeDocument(\ArticleBundle\Entity\Document $document)
    {
        $this->document->removeElement($document);
    }

    /**
     * Get document
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocument()
    {
        return $this->document;
    }


    /**
     * Set boursier
     *
     * @param \ArticleBundle\Entity\Boursier $boursier
     *
     * @return User
     */
    public function setBoursier(\ArticleBundle\Entity\Boursier $boursier = null)
    {
        $this->boursier = $boursier;

        return $this;
    }

    /**
     * Get boursier
     *
     * @return \ArticleBundle\Entity\Boursier
     */
    public function getBoursier()
    {
        return $this->boursier;
    }
}
