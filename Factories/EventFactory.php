<?php


namespace Infinity;

require_once "EventFactoryInterface.php";
require_once "/Users/vagelis/code/Infinity/Models/Event.php";

use Infinity\Models\Event;

class EventFactory implements EventFactoryInterface
{
    public function make($data)
    {
        $event = new Event($data['eventDatetime'], $data['eventAction'], $data['callRef']);
        if ($data['eventValue']) {
            $event->setValue($data['eventValue']);
            $event->setCurrencyCode($data['eventCurrencyCode']);
        }

        return $event;
    }
}
