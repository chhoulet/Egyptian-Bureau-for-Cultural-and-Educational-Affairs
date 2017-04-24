<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailSended
 *
 * @ORM\Table(name="mail_sended")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\MailSendedRepository")
 */
class MailSended
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
     * @ORM\Column(name="message", type="string", length=2500)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSended", type="datetime")
     */
    private $dateSended;


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
     * Set message
     *
     * @param string $message
     *
     * @return MailSended
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
     * Set dateSended
     *
     * @param \DateTime $dateSended
     *
     * @return MailSended
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
}

