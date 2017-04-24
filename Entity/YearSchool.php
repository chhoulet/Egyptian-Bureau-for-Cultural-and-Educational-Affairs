<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * YearSchool
 *
 * @ORM\Table(name="year_school")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\YearSchoolRepository")
 * @UniqueEntity("yearOfStudy")
 */
class YearSchool
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
     * @ORM\Column(name="yearOfStudy", type="string", length=20)
     */
    private $yearOfStudy;

    

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
     * Set yearOfStudy
     *
     * @param string $yearOfStudy
     *
     * @return YearSchool
     */
    public function setYearOfStudy($yearOfStudy)
    {
        $this->yearOfStudy = $yearOfStudy;

        return $this;
    }

    /**
     * Get yearOfStudy
     *
     * @return string
     */
    public function getYearOfStudy()
    {
        return $this->yearOfStudy;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->student = new \Doctrine\Common\Collections\ArrayCollection();
    }

   
}
