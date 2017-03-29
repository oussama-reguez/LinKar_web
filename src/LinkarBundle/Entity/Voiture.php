<?php

namespace LinkarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $urlCarSelfie;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=50, nullable=false)
     */
    private $color;


}

