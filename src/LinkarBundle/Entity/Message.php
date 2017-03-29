<?php

namespace LinkarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="id_annonce", columns={"id_annonce"}), @ORM\Index(name="id_sender", columns={"id_sender"}), @ORM\Index(name="id_receiver", columns={"id_receiver"})})
 * @ORM\Entity(repositoryClass="LinkarBundle\Repository\MessageRepository")
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_message", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMessage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="seen", type="boolean", nullable=false)
     */
    private $seen;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Membre"  , fetch="EAGER")
     * @ORM\JoinColumn(name="id_sender", referencedColumnName="id")
     */
    private $Sender;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre"  , fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_receiver", referencedColumnName="id")
     * })
     */
    private $Receiver;

    /**
     * @var \Annonce
     *
     * @ORM\ManyToOne(targetEntity="Annonce")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_annonce", referencedColumnName="id_annonce")
     * })
     */
    private $Annonce;

    /**
     * @return int
     */
    public function getIdMessage()
    {
        return $this->idMessage;
    }

    /**
     * @param int $idMessage
     */
    public function setIdMessage($idMessage)
    {
        $this->idMessage = $idMessage;
    }

    /**
     * @return bool
     */
    public function isSeen()
    {
        return $this->seen;
    }

    /**
     * @param bool $seen
     */
    public function setSeen($seen)
    {
        $this->seen = $seen;
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
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return \Membre
     */
    public function getSender()
    {
        return $this->Sender;
    }

    /**
     * @param \Membre $Sender
     */
    public function setSender($Sender)
    {
        $this->Sender = $Sender;
    }

    /**
     * @return \Membre
     */
    public function getReceiver()
    {
        return $this->Receiver;
    }

    /**
     * @param \Membre $Receiver
     */
    public function setReceiver($Receiver)
    {
        $this->Receiver = $Receiver;
    }

    /**
     * @return \Annonce
     */
    public function getAnnonce()
    {
        return $this->Annonce;
    }

    /**
     * @param \Annonce $Annonce
     */
    public function setAnnonce($Annonce)
    {
        $this->Annonce = $Annonce;
    }


}

