<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;
use AppBundle\Application\Application as App;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentRepository")
 */
class Payment
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Plan", inversedBy="payment")
     */
    private $plan;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Application", inversedBy="payment")
     */
    private $application;

    /**
     * @var int
     *
     * @ORM\Column(name="months", type="integer")
     */
    private $months;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="due_date", type="datetime", nullable=true)
     */
    private $dueDate;

    /**
     * @var string
     *
     * @ORM\Column(name="license", type="string", nullable=true)
     */
    private $license;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;
    /**
     * Payment constructor.
     */
    public function __construct()
    {
        $this->date=new \DateTime();
        $this->dueDate=null;
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
     * Set client
     *
     * @param integer $client
     *
     * @return Payment
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Set plan
     *
     * @param string $plan
     *
     * @return Payment
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return string
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Set months
     *
     * @param integer $months
     *
     * @return Payment
     */
    public function setMonths($months)
    {
        $this->months = $months;

        return $this;
    }

    /**
     * Get months
     *
     * @return int
     */
    public function getMonths()
    {
        return $this->months;
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
     * @return Payment
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param mixed $application
     * @return Payment
     */
    public function setApplication($application)
    {
        $this->application = $application;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime $dueDate
     * @return Payment
     */
    public function setDueDate(\DateTime $dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }


    
    /**
     * @return Payment
     */
    public function setLicense(){

        $payments=$this->getApplication()->getPayments();
        if(sizeof($payments)>0)
            $date=$this->getApplication()->getPayments()->last()->getDueDate();
        else
            $date=$this->getDate();
            
        $interval = new \DateInterval('P'.$this->getMonths().'M');
        $date->add($interval);
        $this->dueDate=$date;

        $license=$date->getTimestamp();
        $license=base64_encode($license);
        $license=base64_encode($license);
        $license=base64_encode($license);

        $this->license=$license;

        App::sendLicense($this);

        return $this;
    }
    public function getLicense(){
        return $this->license;    
    }
}

