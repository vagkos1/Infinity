<?php


namespace Infinity;

require_once "ValidatorInterface.php";

class CSVValidator implements ValidatorInterface
{
    public function validate($data)
    {
        return true;
    }
}