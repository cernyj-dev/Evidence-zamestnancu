<?php

namespace App\Database;

use App\Entity\Employee;
use App\Entity\Account;
use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;

class Database
{
    private array $employees = [];
    private array $accounts = [];

    private array $roles = [];
    #private EntityManagerInterface $manager;
    public function __construct(
        private EntityManagerInterface $manager)
    {
        $this->roles = [(new Role())->setName("IT specialista"),
        (new Role())->setName("Projektový manažer"),
        (new Role())->setName("Marketingový specialista"),
        (new Role())->setName("HR"),
        (new Role())->setName("Finanční expert"),
        (new Role())->setName("Tester"),
            (new Role())->setName("Obchodní zástupnce"),
            (new Role())->setName("Zákaznický servis"),
            (new Role())->setName("Logistický koordinátor"),
            (new Role())->setName("Grafický designer"),
        ];

        $this->employees = [(new Employee())
            ->setName("Daniel Zbyněk")
            ->setEmail("daniel.zbynek@example.com")
            ->setImageUrl("/images/1.jpg")
            ->setOfficeLocation("k335")
            ->setDescription("Technický autor zjednodušující složité myšlenky.")
            ->setPhone("159 753 486")
            ->setRoles([3]),
            (new Employee())
                ->setName("Jane Smith")
                ->setEmail("jane.smith@example.com")
                ->setImageUrl("/images/2.jpg")
                ->setOfficeLocation("k321")
                ->setDescription("Projektový manažer s talentem pro organizaci.")
                ->setPhone("987 654 321")
                ->setRoles([2]),

            (new Employee())
                ->setName("Aneta Branická")
                ->setEmail("aneta.branicka@example.com")
                ->setImageUrl("/images/2.jpg")
                ->setOfficeLocation("k322")
                ->setDescription("Marketingová specialistka zaměřená na digitální strategie.")
                ->setPhone("123 654 987")
                ->setRoles([3]),

            (new Employee())
                ->setName("Mikuláš Novotný")
                ->setEmail("mikulass.novotny@example.com")
                ->setImageUrl("/images/1.jpg")
                ->setOfficeLocation("k323")
                ->setDescription("Expert na finance se silným analytickým zázemím.")
                ->setPhone("654 321 987")
                ->setRoles([5]),

            (new Employee())
                ->setName("Richard Prosta")
                ->setEmail("richard.prosta@example.com")
                ->setImageUrl("/images/1.jpg")
                ->setOfficeLocation("k324")
                ->setDescription("Softwarový vývojář s vášní pro nové technologie.")
                ->setPhone("321 654 987")
                ->setRoles([1]),

            (new Employee())
                ->setName("Nikola Vosocká")
                ->setEmail("nikola.vosocka@example.com")
                ->setImageUrl("/images/2.jpg")
                ->setOfficeLocation("k325")
                ->setDescription("HR specialistka oddaná rozvoji zaměstnanců.")
                ->setPhone("789 654 321")
                ->setRoles([4]),

            (new Employee())
                ->setName("Kvido Pelich")
                ->setEmail("kvido.pelich@example.com")
                ->setImageUrl("/images/1.jpg")
                ->setOfficeLocation("k326")
                ->setDescription("Obchodní zástupce s vynikajícími vyjednávacími dovednostmi.")
                ->setPhone("456 789 123")
                ->setRoles([7]),

            (new Employee())
                ->setName("Michal Pohlreich")
                ->setEmail("michal.pohlreich@example.com")
                ->setImageUrl("/images/1.jpg")
                ->setOfficeLocation("k327")
                ->setDescription("Manažer zákaznického servisu zaměřený na spokojenost klientů.")
                ->setPhone("147 258 369")
                ->setRoles([8]),

            (new Employee())
                ->setName("Petr Dobriš")
                ->setEmail("petr.dobris@example.com")
                ->setImageUrl("/images/1.jpg")
                ->setOfficeLocation("k328")
                ->setDescription("Koordinátor logistiky se silným organizačním zázemím.")
                ->setPhone("963 852 741")
                ->setRoles([9]),

            (new Employee())
                ->setName("Lucie Fialová")
                ->setEmail("lucie.fialova@example.com")
                ->setImageUrl("/images/2.jpg")
                ->setOfficeLocation("k329")
                ->setDescription("Grafická designérka s dobrým okem pro estetiku.")
                ->setPhone("258 369 147")
                ->setRoles([10]),

            (new Employee())
                ->setName("Tereza Rezková")
                ->setEmail("tereza.rezkova@example.com")
                ->setImageUrl("/images/2.jpg")
                ->setOfficeLocation("k330")
                ->setDescription("Grafická designérka s dobrým okem pro pohyb.")
                ->setPhone("852 741 963")
                ->setRoles([10]),

            (new Employee())
                ->setName("Roman Malý")
                ->setEmail("roman.maly@example.com")
                ->setImageUrl("/images/1.jpg")
                ->setOfficeLocation("k331")
                ->setDescription("Manažer operací se specializací na optimalizaci efektivity.")
                ->setPhone("654 123 789")
                ->setRoles([9]),

            (new Employee())
                ->setName("Tomáš Černý")
                ->setEmail("tomas.cerny@example.com")
                ->setImageUrl("/images/1.jpg")
                ->setOfficeLocation("k332")
                ->setDescription("Specialista IT podpory zajišťující plynulý chod operací.")
                ->setPhone("654 123 789")
                ->setRoles([8]),

            (new Employee())
                ->setName("Erik Polora")
                ->setEmail("erik.polora@example.com")
                ->setImageUrl("/images/1.jpg")
                ->setOfficeLocation("k333")
                ->setDescription("Webový vývojář se zájmem o frontendové technologie.")
                ->setPhone("654 123 789")
                ->setRoles([1]),

            (new Employee())
                ->setName("Nikola Mizikovic")
                ->setEmail("nikola.mizikovic@example.com")
                ->setImageUrl("/images/2.jpg")
                ->setOfficeLocation("k334")
                ->setDescription("Financni expertka")
                ->setPhone("789 321 654")
                ->setRoles([5]),

            (new Employee())
                ->setName("Petr Novák")
                ->setEmail("petr.novak@priklad.cz")
                ->setImageUrl("/images/1.jpg")
                ->setOfficeLocation("k320")
                ->setDescription("Petr je spolehlivý IT pracovník, který se vždy snaží najít efektivní řešení problémů. Kromě své odbornosti v oblasti správy systémů je také vášnivým rybářem, což mu pomáhá udržovat rovnováhu mezi prací a volným časem. Kolegové na něj mohou vždy spoléhat, protože je precizní a rychle reaguje na jakýkoli technický problém. Jeho schopnost přemýšlet mimo rámec běžných postupů z něj dělá nepostradatelného člena týmu. Ať už se jedná o správu serverů nebo o pomoc s uživatelskými dotazy, vždy přistupuje ke své práci s maximální péčí a profesionalitou.")
                ->setPhone("123 456 789")
                ->setRoles([1,2,6])
            ];
        $this->accounts = [
            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(1),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(2),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(3),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(4),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(5),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(6),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(7),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(8),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(9),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(10),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(11),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(12),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(13),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(14),

            (new Account())->setName("Marketing")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(15),

            (new Account())->setName("Admin")
                ->setType("karta")
                ->setExpiration(new \DateTimeImmutable("2028-05-01"))
                ->setEmployeeId(16),

            (new Account())->setName("Projektak")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(16),

            (new Account())->setName("Tester")
                ->setType("username/password")
                ->setExpiration(new \DateTimeImmutable("2026-05-01"))
                ->setEmployeeId(16)
        ];
        foreach($this->roles as $role){
            $this->manager->persist($role);
        }

        foreach($this->employees as $employee){
            $this->manager->persist($employee);
        }

        foreach($this->accounts as $account){
            $this->manager->persist($account);
        }

        $this->manager->flush();

    }
    public function getNewestEmployees(int $limit = 12): array {
        usort($this->employees, function($a, $b) {
            return $b->getID() <=> $a->getID();
        });

        return array_slice($this->employees, 0, $limit);
    }

    public function addEmployee(Employee $employee): void
    {
        $this->employees[] = $employee;
    }
    public function getEmployees(): array
    {
        return $this->employees;
    }
    public function getEmployeeById(int $id): ?Employee
    {
        foreach ($this->employees as $employee) {
            if ($employee->getID() === $id) {
                return $employee;
            }
        }
        return null;
    }
    public function removeEmployeeById(int $id): bool
    {
        foreach ($this->employees as $index => $employee) {
            if ($employee->getID() === $id) {
                unset($this->employees[$index]);
                $this->employees = array_values($this->employees);
                return true;
            }
        }
        return false;
    }
}