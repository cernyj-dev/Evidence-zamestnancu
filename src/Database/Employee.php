<?php

namespace App\Database;

class Employee
{
    private static int $next_id = 1;
    private int $id;
    public function __construct(
        public string $name,
        public string $email,
        public string $image_url,
        public string $office_location,
        public string $description,
        public string $phone,
        private array $roles = [],
        private array $accounts = []

    ){
        $this->id = self::$next_id++;
    }

    public function getID(): int{
        return $this->id;
    }
    public function getRoles(): array{ // should I be returning the whole array? Shouldnt I have like a method to return just the one role? That might be retarded tho
        return $this->roles;
    }
    public function getAccounts(): array{ // same thing - might be useful to return a single account based on its name or smth
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
        foreach ($this->accounts as $account) {
            if ($account->name === $new_account->name) {
                return false;
            }
        }
        $this->accounts[] = $new_account;
        return true;
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