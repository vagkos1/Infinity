<?php


namespace Infinity;


use Infinity\Models\Event;

interface EventRepositoryInterface
{
    public function save(Event $event);
}