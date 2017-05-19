<?php

namespace LinkarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints as CaptchaAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture", indexes={@ORM\Index(name="id_member", columns={"id_member"})})
 * @ORM\Entity
 */
class Voiture
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_voiture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVoiture;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255, nullable=false)
     */
    private $brand;

    /**
     * @return int
     */
    public function getIdVoiture()
    {
        return $this->idVoiture;
    }

    /**
     * @param int $idVoiture
     */
    public function setIdVoiture($idVoiture)
    {
        $this->idVoiture = $idVoiture;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function getIdMember()
    {
        return $this->idMember;
    }

    /**
     * @param int $idMember
     */
    public function setIdMember($idMember)
    {
        $this->idMember = $idMember;
    }

    /**
     * @return int
     */
    public function getConfort()
    {
        return $this->confort;
    }

    /**
     * @param int $confort
     */
    public function setConfort($confort)
    {
        $this->confort = $confort;
    }

    /**
     * @return int
     */
    public function getNumberPlaces()
    {
        return $this->numberPlaces;
    }

    /**
     * @param int $numberPlaces
     */
    public function setNumberPlaces($numberPlaces)
    {
        $this->numberPlaces = $numberPlaces;
    }

    /**
     * @return string
     */
    public function getUrlCarSelfie()
    {
        return $this->urlCarSelfie;
    }

    /**
     * @param string $urlCarSelfie
     */
    public function setUrlCarSelfie($urlCarSelfie)
    {
        $this->urlCarSelfie = $urlCarSelfie;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255, nullable=false)
     */
    private $model;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_member", type="integer", nullable=false)
     */
    private $idMember;

    /**
     * @var integer
     *
     * @ORM\Column(name="confort", type="integer", nullable=false)
     */
    private $confort;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_places", type="integer", nullable=false)
     */
    private $numberPlaces;

    /**
     * @var string
     *
     * @ORM\Column(name="url_car_selfie", type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank(message="Envoyer une image")
     * @Assert\File(mimeTypes={ "image/*" })
     * @Assert\File(mimeTypesMessage="Format non valide")
     */
    private $urlCarSelfie;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=50, nullable=false)
     */
    private $color;

    /**
     * @CaptchaAssert\ValidCaptcha(
     *      message = "CAPTCHA validation failed, try again."
     * )
     */

    /* protected $captchaCode;

     public function getCaptchaCode()
     {
         return $this->captchaCode;
     }

     public function setCaptchaCode($captchaCode)
     {
         $this->captchaCode = $captchaCode;
     }
 */
}

