<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plan
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlanRepository")
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="invoices", type="integer")
     */
    private $invoices;

    /**
     * @var int
     *
     * @ORM\Column(name="wareHouses", type="integer")
     */
    private $wareHouses;

    /**
     * @var int
     *
     * @ORM\Column(name="users", type="integer")
     */
    private $users;

    /**
     * @var int
     *
     * @ORM\Column(name="accounting", type="integer")
     */
    private $accounting;

    /**
     * @var int
     *
     * @ORM\Column(name="auditing", type="integer")
     */
    private $auditing;

    /**
     * @var int
     *
     * @ORM\Column(name="pos", type="integer")
     */
    private $pos;


    /**
     * Get id
     *
     * @return int
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

