<?php

namespace App\Service\Payroll\Payment\Classification\Exceptions;

class NotAnCommissionedEmployeeException extends \Exception
{
    public function __construct($message = 'Selected employee is not commissioned')
    {
        parent::__construct($message);
    }
}