<?php

namespace LinkarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="id_membre", columns={"id_membre"}), @ORM\Index(name="id_membre_2", columns={"id_membre"}), @ORM\Index(name="id_membre_3", columns={"id_membre"})})
 * @ORM\Entity
 */
class Demande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_demande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=50, nullable=false)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=50, nullable=false)
     */
    private $destination;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande", type="date", nullable=false)
     */
    private $dateDemande;

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
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean", nullable=true)
     */
    private $etat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat_date", type="boolean", nullable=false)
     */
    private $etatDate;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     * })
     */
    private $idMembre;


}

