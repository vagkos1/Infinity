<?php

namespace Infinity\Repositories;

require_once "EventRepositoryInterface.php";

use Infinity\Models\Event;
use Infinity\MySQL;
use Infinity\EventRepositoryInterface;

class CSVEventRepository implements EventRepositoryInterface
{
    /** @var  \PDO */
    private $pdo;

    public function __construct(MySQL $mySQL)
    {
        $this->pdo = $mySQL->PDOConnect();
    }

    private function createTable()
    {
        $this->pdo->query(
            "CREATE TABLE IF NOT EXISTS `event` (
             `id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
             `datetime` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
             `action` VARCHAR(20) NOT NULL,
             `callRef` INT NULL,
             `value` DECIMAL NULL,
             `currencyCode` VARCHAR(3) NULL,
             PRIMARY KEY (`id`)
             )"
        );
    }

    public function save(Event $event)
    {
        $this->createTable();

        $statement = $this->pdo->prepare(
            "INSERT INTO `event` (`datetime`, `action`, `calx§lRef`, `value`, `currencyCode`) 
             VALUES (:datetime, :eventAction, :callRef, :eventValue, :eventCurrencyCode) ");

        // date times are handled as strings
        $statement->bindParam(':eventDatetime', $event->getDatetime(), \PDO::PARAM_STR);
        $statement->bindParam(':action', $event->getAction(), \PDO::PARAM_STR);
        $statement->bindParam(':callRef', $event->getCallRef(), \PDO::PARAM_INT);
        $statement->bindParam(':eventValue', $event->getValue(), \PDO::PARAM_STR);
        $statement->bindParam(':eventCurrencyCode', $event->getCurrencyCode(), \PDO::PARAM_STR);

        $statement->execute();

        return ($statement->rowCount() > 0) ? true : false;
    }
}