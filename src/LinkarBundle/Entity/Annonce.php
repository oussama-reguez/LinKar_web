<?php

namespace LinkarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce", indexes={@ORM\Index(name="id_membre", columns={"id_membre", "id_voiture"}), @ORM\Index(name="id_voiture", columns={"id_voiture"}), @ORM\Index(name="place1", columns={"place1"}), @ORM\Index(name="place2", columns={"place2"}), @ORM\Index(name="place3", columns={"place3"}), @ORM\Index(name="place4", columns={"place4"}), @ORM\Index(name="IDX_F65593E5D0834EC4", columns={"id_membre"})})
 * @ORM\Entity
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
     * @ORM\Column(name="approdep", type="string", length=50, nullable=false)
     */
    private $approdep;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=20, nullable=false)
     */
    private $destination;

    /**
     * @var string
     *
     * @ORM\Column(name="approdest", type="string", length=50, nullable=false)
     */
    private $approdest;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date_annonce", type="date", nullable=false)
     */
    private $dateAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="horaire_depart", type="string", length=5, nullable=false)
     */
    private $horaireDepart;

    /**
     * @var boolean
     *
     * @ORM\Column(name="regulier", type="boolean", nullable=false)
     */
    private $regulier;

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
     * @ORM\Column(name="description", type="string", length=100, nullable=true)
     */
    private $description;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     * })
     */
    private $idMembre;

    /**
     * @var \Voiture
     *
     * @ORM\ManyToOne(targetEntity="Voiture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_voiture", referencedColumnName="id_voiture")
     * })
     */
    private $Voiture;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="place1", referencedColumnName="id")
     * })
     */
    private $place1;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="place2", referencedColumnName="id")
     * })
     */
    private $place2;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="place3", referencedColumnName="id")
     * })
     */
    private $place3;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="place4", referencedColumnName="id")
     * })
     */
    private $place4;

    /**
     * @return int
     */
    public function getIdAnnonce()
    {
        return $this->idAnnonce;
    }

    /**
     * @param int $idAnnonce
     */
    public function setIdAnnonce($idAnnonce)
    {
        $this->idAnnonce = $idAnnonce;
    }

    /**
     * @return string
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * @param string $depart
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;
    }

    /**
     * @return string
     */
    public function getApprodep()
    {
        return $this->approdep;
    }

    /**
     * @param string $approdep
     */
    public function setApprodep($approdep)
    {
        $this->approdep = $approdep;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return string
     */
    public function getApprodest()
    {
        return $this->approdest;
    }

    /**
     * @param string $approdest
     */
    public function setApprodest($approdest)
    {
        $this->approdest = $approdest;
    }

    /**
     * @return bool
     */
    public function isFumeur()
    {
        return $this->fumeur;
    }

    /**
     * @param bool $fumeur
     */
    public function setFumeur($fumeur)
    {
        $this->fumeur = $fumeur;
    }

    /**
     * @return bool
     */
    public function isBavard()
    {
        return $this->bavard;
    }

    /**
     * @param bool $bavard
     */
    public function setBavard($bavard)
    {
        $this->bavard = $bavard;
    }

    /**
     * @return bool
     */
    public function isMenOnly()
    {
        return $this->menOnly;
    }

    /**
     * @param bool $menOnly
     */
    public function setMenOnly($menOnly)
    {
        $this->menOnly = $menOnly;
    }

    /**
     * @return bool
     */
    public function isWomenOnly()
    {
        return $this->womenOnly;
    }

    /**
     * @param bool $womenOnly
     */
    public function setWomenOnly($womenOnly)
    {
        $this->womenOnly = $womenOnly;
    }

    /**
     * @return bool
     */
    public function isAnimaux()
    {
        return $this->animaux;
    }

    /**
     * @param bool $animaux
     */
    public function setAnimaux($animaux)
    {
        $this->animaux = $animaux;
    }

    /**
     * @return \DateTime
     */
    public function getDateAnnonce()
    {
        return $this->dateAnnonce;
    }

    /**
     * @param \DateTime $dateAnnonce
     */
    public function setDateAnnonce($dateAnnonce)
    {
        $this->dateAnnonce = $dateAnnonce;
    }

    /**
     * @return string
     */
    public function getHoraireDepart()
    {
        return $this->horaireDepart;
    }

    /**
     * @param string $horaireDepart
     */
    public function setHoraireDepart($horaireDepart)
    {
        $this->horaireDepart = $horaireDepart;
    }

    /**
     * @return bool
     */
    public function isRegulier()
    {
        return $this->regulier;
    }

    /**
     * @param bool $regulier
     */
    public function setRegulier($regulier)
    {
        $this->regulier = $regulier;
    }

    /**
     * @return int
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * @param int $places
     */
    public function setPlaces($places)
    {
        $this->places = $places;
    }

    /**
     * @return int
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * @param int $tarif
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \Membre
     */
    public function getIdMembre()
    {
        return $this->idMembre;
    }

    /**
     * @param \Membre $idMembre
     */
    public function setIdMembre($idMembre)
    {
        $this->idMembre = $idMembre;
    }



    /**
     * @return \Membre
     */
    public function getPlace1()
    {
        return $this->place1;
    }

    /**
     * @param \Membre $place1
     */
    public function setPlace1($place1)
    {
        $this->place1 = $place1;
    }

    /**
     * @return \Membre
     */
    public function getPlace2()
    {
        return $this->place2;
    }

    /**
     * @param \Membre $place2
     */
    public function setPlace2($place2)
    {
        $this->place2 = $place2;
    }

    /**
     * @return \Membre
     */
    public function getPlace3()
    {
        return $this->place3;
    }

    /**
     * @param \Membre $place3
     */
    public function setPlace3($place3)
    {
        $this->place3 = $place3;
    }

    /**
     * @return \Membre
     */
    public function getPlace4()
    {
        return $this->place4;
    }

    /**
     * @param \Membre $place4
     */
    public function setPlace4($place4)
    {
        $this->place4 = $place4;
    }

    /**
     * @return \Voiture
     */
    public function getVoiture()
    {
        return $this->Voiture;
    }

    /**
     * @param \Voiture $Voiture
     */
    public function setVoiture($Voiture)
    {
        $this->Voiture = $Voiture;
    }


}

