<?php

namespace LinkarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints as CaptchaAssert;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReclamation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reclamation", type="datetime", nullable=false)
     */
    private $dateReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=100, nullable=false)
     */
    private $subject;

    /**
     * @var boolean
     *
     * @ORM\Column(name="marked", type="boolean", nullable=false)
     */
    private $marked = '0';

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     * })
     */


    private $Membre;

    /**
     * @return int
     */
    public function getIdReclamation()
    {
        return $this->idReclamation;
    }

    /**
     * @param int $idReclamation
     */
    public function setIdReclamation($idReclamation)
    {
        $this->idReclamation = $idReclamation;
    }

    /**
     * @return \DateTime
     */
    public function getDateReclamation()
    {
        return $this->dateReclamation;
    }

    /**
     * @param \DateTime $dateReclamation
     */
    public function setDateReclamation($dateReclamation)
    {
        $this->dateReclamation = $dateReclamation;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return bool
     */
    public function isMarked()
    {
        return $this->marked;
    }

    /**
     * @param bool $marked
     */
    public function setMarked($marked)
    {
        $this->marked = $marked;
    }

    /**
     * @return \Membre
     */
    public function getMembre()
    {
        return $this->Membre;
    }

    /**
     * @param \Membre $Membre
     */
    public function setMembre($Membre)
    {
        $this->Membre = $Membre;
    }

    /**
     * @return \Membre
     */

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="string", length=250, nullable=false)
     */
    private $reponse;

    /**
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * @param string $reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }

    /**
     * @CaptchaAssert\ValidCaptcha(
     *      message = "CAPTCHA validation failed, try again."
     * )
     */
    protected $captchaCode;

    /**
     * @return mixed
     */
    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    /**
     * @param mixed $captchaCode
     */
    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }


}

