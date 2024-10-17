<?php

namespace App;

use DateTimeImmutable;

class Account
{
    public function __construct(
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