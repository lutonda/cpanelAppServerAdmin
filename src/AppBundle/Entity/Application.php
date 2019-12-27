<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 *
 * @ORM\Table(name="application")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ApplicationRepository")
 */
class Application
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     *  @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="application", cascade={"persist"})
     */
    private $client;

    public function __construct(){
        $this->isActive=true;
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
     * @return mixed
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


}

