<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Partner
 *
 * @ORM\Table(name="partner")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\PartnerRepository")
 */
class Partner
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
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 2000,
     *      minMessage = "Le nom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le nom ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="nameArab", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 2000,
     *      minMessage = "Le nom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le nom ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $nameArab;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=4000, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 4000,
     *      minMessage = "La description doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "La description ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionArab", type="string", length=4000, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 4000,
     *      minMessage = "La description doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "La description ne peut contenir plus de {{ limit }} caractères"
     * )
     */
    private $descriptionArab;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * @var string
     *     
     *
     * @ORM\Column(name="brochure", type="string", length=255, nullable=true)
     */
    private $brochure;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active=1;


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
     * @return Partner
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
     * @return Partner
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
     * Set lien
     *
     * @param string $lien
     *
     * @return Partner
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set nameArab
     *
     * @param string $nameArab
     *
     * @return Partner
     */
    public function setNameArab($nameArab)
    {
        $this->nameArab = $nameArab;

        return $this;
    }

    /**
     * Get nameArab
     *
     * @return string
     */
    public function getNameArab()
    {
        return $this->nameArab;
    }

    /**
     * Set descriptionArab
     *
     * @param string $descriptionArab
     *
     * @return Partner
     */
    public function setDescriptionArab($descriptionArab)
    {
        $this->descriptionArab = $descriptionArab;

        return $this;
    }

    /**
     * Get descriptionArab
     *
     * @return string
     */
    public function getDescriptionArab()
    {
        return $this->descriptionArab;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return Partner
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

    /**
     * Set brochure
     *
     * @param string $brochure
     *
     * @return Partner
     */
    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

        return $this;
    }

    /**
     * Get brochure
     *
     * @return string
     */
    public function getBrochure()
    {
        return $this->brochure;
    }
}
