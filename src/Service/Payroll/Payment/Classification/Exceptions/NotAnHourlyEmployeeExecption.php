<?php

namespace App\Service\Payroll\Payment\Classification\Exceptions;

class NotAnHourlyEmployeeException extends \Exception
{
    public function __construct($message = 'Selected employee is not paid by hour')
    {
        parent::__construct($message);
    }
}