<?php

namespace App\Utils\Interfaces;

use Doctrine\ORM\EntityManagerInterface;

interface EntityTransaction
{
    public function execute(EntityManagerInterface $entityManager);
}