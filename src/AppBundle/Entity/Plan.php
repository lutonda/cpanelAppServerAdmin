<?php

namespace AppBundle\Entity;


use JMS\Serializer\Annotation AS JMS;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plan
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlanRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Plan
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payment", mappedBy="plan")

     */
    private $payments;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", precision=32, scale=2)
     * @JMS\Expose()
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     * @JMS\Expose()
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="invoices", type="integer")
     * @JMS\Expose()
     */
    private $invoices;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="decimal")
     * @JMS\Expose()
     */
    private $amount;

    /**
     * @var int
     *
     * @ORM\Column(name="wareHouses", type="integer")
     * @JMS\Expose()
     */
    private $wareHouses;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supplies", type="boolean")
     * @JMS\Expose()
     */
    private $supllies;

    /**
     * @var int
     *
     * @ORM\Column(name="users", type="integer")
     * @JMS\Expose()
     */
    private $users;

    /**
     * @var bool
     *
     * @ORM\Column(name="accounting", type="boolean")
     * @JMS\Expose()
     */
    private $accounting;


    /**
     * @var bool
     *
     * @ORM\Column(name="auditing", type="boolean")
     * @JMS\Expose()
     */
    private $auditing;

    /**
     * @var bool
     *
     * @ORM\Column(name="pos", type="boolean")
     * @JMS\Expose()
     */
    private $pos;

    /**
     * @var bool
     *
     * @ORM\Column(name="reports", type="boolean")
     * @JMS\Expose()
     */
    private $reports;

    /**
     * @var int
     *
     * @ORM\Column(name="dayly_back_ups", type="integer")
     * @JMS\Expose()
     */
    private $daylyBackUps;


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
     * @return Plan
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
     * Set invoices
     *
     * @param integer $invoices
     *
     * @return Plan
     */
    public function setInvoices($invoices)
    {
        $this->invoices = $invoices;

        return $this;
    }

    /**
     * Get invoices
     *
     * @return int
     */
    public function getInvoices()
    {
        return $this->invoices;
    }

    /**
     * Set wareHouses
     *
     * @param integer $wareHouses
     *
     * @return Plan
     */
    public function setWareHouses($wareHouses)
    {
        $this->wareHouses = $wareHouses;

        return $this;
    }

    /**
     * Get wareHouses
     *
     * @return int
     */
    public function getWareHouses()
    {
        return $this->wareHouses;
    }

    /**
     * Set users
     *
     * @param integer $users
     *
     * @return Plan
     */
    public function setUsers($users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return int
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set accounting
     *
     * @param integer $accounting
     *
     * @return Plan
     */
    public function setAccounting($accounting)
    {
        $this->accounting = $accounting;

        return $this;
    }

    /**
     * Get accounting
     *
     * @return int
     */
    public function getAccounting()
    {
        return $this->accounting;
    }

    /**
     * Set auditing
     *
     * @param integer $auditing
     *
     * @return Plan
     */
    public function setAuditing($auditing)
    {
        $this->auditing = $auditing;

        return $this;
    }

    /**
     * Get auditing
     *
     * @return int
     */
    public function getAuditing()
    {
        return $this->auditing;
    }

    /**
     * Set pos
     *
     * @param integer $pos
     *
     * @return Plan
     */
    public function setPos($pos)
    {
        $this->pos = $pos;

        return $this;
    }

    /**
     * Get pos
     *
     * @return int
     */
    public function getPos()
    {
        return $this->pos;
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
     * @return Plan
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;

        return $this;
    }

}

