<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation AS JMS;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Application
 *
 * @ORM\Table(name="application")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ApplicationRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Application
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="app_key", type="string", length=50, unique=true)
     * @JMS\Expose()
     */
    private $appKey;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=50)
     * @JMS\Expose()
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=50, unique=true)
     * @JMS\Expose()
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     * @JMS\Expose()
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     * @JMS\Expose()
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="application", cascade={"persist"})
     * @JMS\Expose()
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payment", mappedBy="application", cascade={"persist"})
     * @ORM\OrderBy({"dueDate" = "ASC"})
     * @JMS\Expose()
     */
    private $payments;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @JMS\Expose()
     */
    private $date;


    public function __construct(){
        $this->isActive=true;
        $this->date=new \DateTime();
        $this->path='/';
    }
    /**
     * Get id
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Application
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param bool $isActive
     *
     * @return Application
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get name
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }


    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     * @return Application
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return string
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     * @return Application
     */
    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $doamin
     * @return Application
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Application
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param mixed $payments
     * @return Application
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return Application
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;

        return $this;
    }


}

