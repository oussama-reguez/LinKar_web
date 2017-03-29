<?php

namespace LinkarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Membre
 *
 * @ORM\Table(name="membre")
 * @ORM\Entity(repositoryClass="LinkarBundle\Repository\MembreRepository")
 */
class Membre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=true)
     */
    private $firstName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth", type="date", nullable=true)
     */
    private $birth;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=180, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", length=65535, nullable=true)
     */
    private $address;

    /**
     * @var float
     *
     * @ORM\Column(name="phone_number", type="float", precision=10, scale=0, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=10, nullable=true)
     */
    private $gender;

    /**
     * @var boolean
     *
     * @ORM\Column(name="verif_number", type="boolean", nullable=true)
     */
    private $verifNumber = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="verif_cin", type="boolean", nullable=true)
     */
    private $verifCin = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="verif_email", type="boolean", nullable=true)
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
     * @ORM\Column(name="statut", type="boolean", nullable=true)
     */
    private $statut = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="sms_code", type="integer", nullable=true)
     */
    private $smsCode;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=180, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="username_canonical", type="string", length=180, nullable=true)
     */
    private $usernameCanonical;

    /**
     * @var string
     *
     * @ORM\Column(name="email_canonical", type="string", length=180, nullable=true)
     */
    private $emailCanonical;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="confirmation_token", type="string", length=180, nullable=true)
     */
    private $confirmationToken;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="password_requested_at", type="datetime", nullable=true)
     */
    private $passwordRequestedAt;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", nullable=true)
     */
    private $roles;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsernameCanonical()
    {
        return $this->usernameCanonical;
    }

    /**
     * @param string $usernameCanonical
     */
    public function setUsernameCanonical($usernameCanonical)
    {
        $this->usernameCanonical = $usernameCanonical;
    }

    /**
     * @return string
     */
    public function getEmailCanonical()
    {
        return $this->emailCanonical;
    }

    /**
     * @param string $emailCanonical
     */
    public function setEmailCanonical($emailCanonical)
    {
        $this->emailCanonical = $emailCanonical;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime $lastLogin
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * @param string $confirmationToken
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;
    }

    /**
     * @return \DateTime
     */
    public function getPasswordRequestedAt()
    {
        return $this->passwordRequestedAt;
    }

    /**
     * @param \DateTime $passwordRequestedAt
     */
    public function setPasswordRequestedAt($passwordRequestedAt)
    {
        $this->passwordRequestedAt = $passwordRequestedAt;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }


}

