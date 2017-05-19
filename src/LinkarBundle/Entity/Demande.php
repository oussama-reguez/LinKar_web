<?php

namespace LinkarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="id_membre", columns={"id_membre"}), @ORM\Index(name="idrep", columns={"idrep"})})
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
     * @ORM\Column(name="approdep", type="string", length=50, nullable=true)
     */
    private $approdep;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=50, nullable=false)
     */
    private $destination;

    /**
     * @var string
     *
     * @ORM\Column(name="approdest", type="string", length=50, nullable=true)
     */
    private $approdest;

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
     * @var float
     *
     * @ORM\Column(name="Latitudes", type="float", precision=10, scale=0, nullable=true)
     */
    private $latitudes;

    /**
     * @var float
     *
     * @ORM\Column(name="Longitudes", type="float", precision=10, scale=0, nullable=true)
     */
    private $longitudes;

    /**
     * @var integer
     *
     * @ORM\Column(name="tarif", type="integer", nullable=true)
     */
    private $tarif;

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
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idrep", referencedColumnName="id")
     * })
     */
    private $idrep;

    /**
     * @return int
     */
    public function getIdDemande()
    {
        return $this->idDemande;
    }

    /**
     * @param int $idDemande
     */
    public function setIdDemande($idDemande)
    {
        $this->idDemande = $idDemande;
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
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * @param \DateTime $dateDemande
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;
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
     * @return bool
     */
    public function isEtat()
    {
        return $this->etat;
    }

    /**
     * @param bool $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return bool
     */
    public function isEtatDate()
    {
        return $this->etatDate;
    }

    /**
     * @param bool $etatDate
     */
    public function setEtatDate($etatDate)
    {
        $this->etatDate = $etatDate;
    }

    /**
     * @return float
     */
    public function getLatitudes()
    {
        return $this->latitudes;
    }

    /**
     * @param float $latitudes
     */
    public function setLatitudes($latitudes)
    {
        $this->latitudes = $latitudes;
    }

    /**
     * @return float
     */
    public function getLongitudes()
    {
        return $this->longitudes;
    }

    /**
     * @param float $longitudes
     */
    public function setLongitudes($longitudes)
    {
        $this->longitudes = $longitudes;
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
    public function getIdrep()
    {
        return $this->idrep;
    }

    /**
     * @param \Membre $idrep
     */
    public function setIdrep($idrep)
    {
        $this->idrep = $idrep;
    }


}

