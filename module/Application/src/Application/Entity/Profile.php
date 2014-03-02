<?php
namespace Application\Entity;
use Application\Entity\EntityAbstract;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Application\Mapper\Profile")
 * @ORM\Table(name="profile")
 */
class Profile extends EntityAbstract
{
    /**
     * Primary Identifier
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     * @access public
     */
    protected $id;

    /**
     * User
     *
     *
     * @ORM\OneToOne(targetEntity="User", mappedBy="profile", fetch="LAZY")
     * @var user
     */
    protected $user;

    /**
     * LastName
     *
     * @ORM\Column(type="string", length=128)
     *
     * @var string
     */
    protected $lastName;

    /**
     * FirstName
     *
     * @ORM\Column(type="string", length=128)
     *
     * @var string
     */
    protected $firstName;

    /**
     * Address
     *
     * @ORM\Column(type="string", length=256, nullable=true)
     *
     * @var string
     */
    protected $address;
	
	/**
     * Birth
     *
     * @ORM\Column(type="date")
     *
     * @var datetime $birth
     */
    protected $birth;

    /**
     * @var datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @ORM\Column(type="datetime")
     */
    private $updated;

    public function __construct()
    {
        $this->created = new \DateTime;
        $this->updated = new \DateTime;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set LastName
     *
     * @param string $lastName
     * @return Profile
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get LastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set FirstName
     *
     * @param string $firstName
     * @return Profile
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get FirstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Profile
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
	
	
	/**
     * Set birth
     *
     * @param \DateTime $birth
     * @return Profile
     */
    public function setBirth($birth)
    {
        $this->birth = $this->updated = new \DateTime($birth);

        return $this;
    }
	
	/**
     * Get birth
     *
     * @return \DateTime 
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * Set user
     *
     * @param \Application\Entity\User $user
     * @return Profile
     */
    public function setUser(\Application\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Profile
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Profile
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
