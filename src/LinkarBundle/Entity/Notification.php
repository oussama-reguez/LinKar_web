<?php

namespace LinkarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification", indexes={@ORM\Index(name="id_member", columns={"id_member"}), @ORM\Index(name="id_sender", columns={"id_sender"})})
 * @ORM\Entity(repositoryClass="LinkarBundle\Repository\NotificationRepository")
 */
class Notification
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_notification", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNotification;

    /**
     * @var string
     *
     * @ORM\Column(name="text_notification", type="text", length=65535, nullable=false)
     */
    private $textNotification;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notification_seen", type="boolean", nullable=false)
     */
    private $notificationSeen = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre" , fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_member", referencedColumnName="id")
     * })
     */
    private $Member;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre" , fetch="EAGER" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sender", referencedColumnName="id")
     * })
     */
    private $Sender;

    /**
     * @return int
     */
    public function getIdNotification()
    {
        return $this->idNotification;
    }

    /**
     * @param int $idNotification
     */
    public function setIdNotification($idNotification)
    {
        $this->idNotification = $idNotification;
    }

    /**
     * @return string
     */
    public function getTextNotification()
    {
        return $this->textNotification;
    }

    /**
     * @param string $textNotification
     */
    public function setTextNotification($textNotification)
    {
        $this->textNotification = $textNotification;
    }

    /**
     * @return bool
     */
    public function isNotificationSeen()
    {
        return $this->notificationSeen;
    }

    /**
     * @param bool $notificationSeen
     */
    public function setNotificationSeen($notificationSeen)
    {
        $this->notificationSeen = $notificationSeen;
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
     * @return \Membre
     */
    public function getMember()
    {
        return $this->Member;
    }

    /**
     * @param \Membre $Member
     */
    public function setMember($Member)
    {
        $this->Member = $Member;
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


}

