<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser; use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="membre")
 */

class User extends BaseUser {
    /**      * @ORM\Id
     * @ORM\Column(type="integer")
     *  * @ORM\GeneratedValue(strategy="AUTO")      */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=false)
     */
    private $firstName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth", type="date", nullable=false)
     */
    private $birth;






    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", length=65535, nullable=false)
     */
    private $address;

    /**
     * @var float
     *
     * @ORM\Column(name="phone_number", type="float", precision=10, scale=0, nullable=false)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=10, nullable=false)
     */
    private $gender;

    /**
     * @var boolean
     *
     * @ORM\Column(name="verif_number", type="boolean", nullable=false)
     */
    private $verifNumber = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="verif_cin", type="boolean", nullable=false)
     */
    private $verifCin = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="verif_email", type="boolean", nullable=false)
     */
    private $verifEmail = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="role", type="boolean", nullable=true)
     */
    private $role = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="url_cin", type="string", length=255, nullable=true)
     */
    private $urlCin = 'http://localhost/upload/uploads/user.png';

    /**
     * @var string
     *
     * @ORM\Column(name="url_picture", type="string", length=255, nullable=true)
     */
    private $urlPicture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreatedTime", type="datetime", nullable=true)
     */
    private $createdtime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="statut", type="boolean", nullable=false)
     */
    private $statut = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="sms_code", type="integer", nullable=false)
     */
    private $smsCode;

    /**
     * @return \DateTime
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @param \DateTime $birth
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedtime()
    {
        return $this->createdtime;
    }

    /**
     * @param \DateTime $createdtime
     */
    public function setCreatedtime($createdtime)
    {
        $this->createdtime = $createdtime;
    }

    /**
     * @return float
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param float $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return bool
     */
    public function isVerifNumber()
    {
        return $this->verifNumber;
    }

    /**
     * @param bool $verifNumber
     */
    public function setVerifNumber($verifNumber)
    {
        $this->verifNumber = $verifNumber;
    }

    /**
     * @return bool
     */
    public function isVerifCin()
    {
        return $this->verifCin;
    }

    /**
     * @param bool $verifCin
     */
    public function setVerifCin($verifCin)
    {
        $this->verifCin = $verifCin;
    }

    /**
     * @return bool
     */
    public function isRole()
    {
        return $this->role;
    }

    /**
     * @param bool $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return bool
     */
    public function isVerifEmail()
    {
        return $this->verifEmail;
    }

    /**
     * @param bool $verifEmail
     */
    public function setVerifEmail($verifEmail)
    {
        $this->verifEmail = $verifEmail;
    }

    /**
     * @return string
     */
    public function getUrlCin()
    {
        return $this->urlCin;
    }

    /**
     * @param string $urlCin
     */
    public function setUrlCin($urlCin)
    {
        $this->urlCin = $urlCin;
    }

    /**
     * @return string
     */
    public function getUrlPicture()
    {
        return $this->urlPicture;
    }

    /**
     * @param string $urlPicture
     */
    public function setUrlPicture($urlPicture)
    {
        $this->urlPicture = $urlPicture;
    }

    /**
     * @return bool
     */
    public function isStatut()
    {
        return $this->statut;
    }

    /**
     * @param bool $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return int
     */
    public function getSmsCode()
    {
        return $this->smsCode;
    }

    /**
     * @param int $smsCode
     */
    public function setSmsCode($smsCode)
    {
        $this->smsCode = $smsCode;
    }



}