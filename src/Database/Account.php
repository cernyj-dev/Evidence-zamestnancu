<?php

namespace App\Database;

use DateTimeImmutable;

class Account
{
    public function __construct(
        public int $employee_id,
        public string $name,
        public string $type,
        private ?DateTimeImmutable $expiration = null
    ){
    }

    public function setExpiration(DateTimeImmutable $date){
        $this->expiration = $date;
    }
    public function getExpiration(): ?DateTimeImmutable{
        return $this->expiration;
    }
}