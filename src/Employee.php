<?php

namespace App;

use App\Account;

class Employee
{
    public function __construct(
        private int $id,
        public string $name,
        public string $email,
        public string $image_url,
        public string $office_location,
        public string $phone,
        private array $roles = [],
        private array $accounts = []

    ){}

    public function getID(): int{
        return $this->id;
    }
    public function getRoles(): array{
        return $this->roles;
    }
    public function getAccounts(): array{
        return $this->accounts;
    }

    public function addRole(string $new_role): bool{
        if(in_array($new_role, $this->roles) === false){
            $this->roles[] = $new_role;
            return true;
        }
        return false;
    }
    public function addAccount(Account $new_account): bool{
        if(in_array($new_account, $this->accounts) === false){
            $this->accounts[] = $new_account;
            return true;
        }
        return false;
    }
    public function removeRole(string $role): bool {
        $index = array_search($role, $this->roles);
        if ($index !== false) {
            unset($this->roles[$index]);
            $this->roles = array_values($this->roles);
            return true;
        }
        return false;
    }
    public function removeAccount(string $accountName): bool {
        foreach ($this->accounts as $index => $account) {
            if ($account->name === $accountName) {
                unset($this->accounts[$index]);
                $this->accounts = array_values($this->accounts);
                return true;
            }
        }
        return false;
    }
}