<?php

namespace Infinity\Models;


class Event
{
    /** @var  \DateTime */
    private $datetime;
    
    /** @var  string */
    private $action;
    
    /** @var  integer */
    private $callRef;
    
    /** @var  float */
    private $value;
    
    /** @var  string */
    private $currencyCode;

    /**
     * Event constructor.
     * 
     * @param string $eventDatetime
     * @param string $eventAction
     * @param int $callRef
     */
    public function __construct($eventDatetime, $eventAction, $callRef)
    {
        $this->datetime = $eventDatetime;
        $this->action = $eventAction;
        $this->callRef = $callRef;
    }

    /**
     * @param string $currencyCode
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }

    /**
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return int
     */
    public function getCallRef()
    {
        return $this->callRef;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }
}