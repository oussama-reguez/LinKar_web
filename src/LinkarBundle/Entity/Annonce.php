<?php

namespace LinkarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce", indexes={@ORM\Index(name="id_membre", columns={"id_membre", "id_voiture"}), @ORM\Index(name="id_voiture", columns={"id_voiture"}), @ORM\Index(name="IDX_F65593E5D0834EC4", columns={"id_membre"})})
 * @ORM\Entity(repositoryClass="LinkarBundle\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_annonce", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=20, nullable=false)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=20, nullable=false)
     */
    private $destination;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fumeur", type="boolean", nullable=false)
     */
    private $fumeur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bavard", type="boolean", nullable=false)
     */
    private $bavard;

    /**
     * @var boolean
     *
     * @ORM\Column(name="men_only", type="boolean", nullable=false)
     */
    private $menOnly;

    /**
     * @var boolean
     *
     * @ORM\Column(name="women_only", type="boolean", nullable=false)
     */
    private $womenOnly;

    /**
     * @var boolean
     *
     * @ORM\Column(name="animaux", type="boolean", nullable=false)
     */
    private $animaux;

    /**
     * @var string
     *
     * @ORM\Column(name="date_annonce", type="string", length=10, nullable=false)
     */
    private $dateAnnonce;

    /**
     * @var boolean
     *
     * @ORM\Column(name="regulier", type="boolean", nullable=false)
     */
    private $regulier;

    /**
     * @var string
     *
     * @ORM\Column(name="horaire_depart", type="string", length=10, nullable=false)
     */
    private $horaireDepart;

    /**
     * @var integer
     *
     * @ORM\Column(name="places", type="integer", nullable=false)
     */
    private $places;

    /**
     * @var integer
     *
     * @ORM\Column(name="tarif", type="integer", nullable=false)
     */
    private $tarif;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_voiture", type="integer", nullable=true)
     */
    private $idVoiture;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     * })
     */
    private $Membre;


}

