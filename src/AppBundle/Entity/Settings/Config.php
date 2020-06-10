<?php

namespace AppBundle\Entity\Settings;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="settings_config")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Settings\ConfigRepository")
 */
class Config
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
     * @ORM\Column(name="root_domain", type="string", length=255)
     */
    private $rootDomain;

    /**
     * @var string
     *
     * @ORM\Column(name="app_prefix", type="string", length=255)
     */
    private $appPrefix;

    /**
     * @var string
     *
     * @ORM\Column(name="app_username", type="string", length=255)
     */
    private $appUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="app_password", type="string", length=255)
     */
    private $appPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="server_name", type="string", length=255)
     */
    private $serverName;

    /**
     * @var string
     *
     * @ORM\Column(name="app_path", type="string", length=255)
     */
    private $appPath;


    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rootDomain
     *
     * @param string $rootDomain
     *
     * @return Config
     */
    public function setRootDomain($rootDomain)
    {
        $this->rootDomain = $rootDomain;

        return $this;
    }

    /**
     * Get rootDomain
     *
     * @return string
     */
    public function getRootDomain()
    {
        return $this->rootDomain;
    }

    /**
     * Set appPrefix
     *
     * @param string $appPrefix
     *
     * @return Config
     */
    public function setAppPrefix($appPrefix)
    {
        $this->appPrefix = $appPrefix;

        return $this;
    }

    /**
     * Get appPrefix
     *
     * @return string
     */
    public function getAppPrefix()
    {
        return $this->appPrefix;
    }

    /**
     * Set appUsername
     *
     * @param string $appUsername
     *
     * @return Config
     */
    public function setAppUsername($appUsername)
    {
        $this->appUsername = $appUsername;

        return $this;
    }

    /**
     * Get appUsername
     *
     * @return string
     */
    public function getAppUsername()
    {
        return $this->appUsername;
    }

    /**
     * Set appPassword
     *
     * @param string $appPassword
     *
     * @return Config
     */
    public function setAppPassword($appPassword)
    {
        $this->appPassword = $appPassword;

        return $this;
    }

    /**
     * Get appPassword
     *
     * @return string
     */
    public function getAppPassword()
    {
        return $this->appPassword;
    }

    /**
     * Set serverName
     *
     * @param string $serverName
     *
     * @return Config
     */
    public function setServerName($serverName)
    {
        $this->serverName = $serverName;

        return $this;
    }

    /**
     * Get serverName
     *
     * @return string
     */
    public function getServerName()
    {
        return $this->serverName;
    }

    /**
     * Set appPath
     *
     * @param string $appPath
     *
     * @return Config
     */
    public function setAppPath($appPath)
    {
        $this->appPath = $appPath;

        return $this;
    }

    /**
     * Get appPath
     *
     * @return string
     */
    public function getAppPath()
    {
        return $this->appPath;
    }
}

