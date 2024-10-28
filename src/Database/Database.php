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
    private EntityManagerInterface $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->roles = [(new Role())->setName("IT specialista"),
        (new Role())->setName("Projektový manažer"),
        (new Role())->setName("Marketingový specialista"),
        (new Role())->setName("HR"),
        (new Role())->setName("Finanční expert"),
        (new Role())->setName("Tester")];

        $this->employees = [(new Employee())
            ->setName("Daniel Zbyněk")
            ->setEmail("daniel.zbynek@example.com")
            ->setImageUrl("/images/1.jpg")
            ->setOfficeLocation("k335")
            ->setDescription("Technický autor zjednodušující složité myšlenky.")
            ->setPhone("159 753 486")
            ->setRoles([3])];


        $this->employees[] = new Employee(
            "Daniel Zbyněk",
            "daniel.zbynek@example.com",
            "/images/1.jpg",
            "k335",
            "Technický autor zjednodušující složité myšlenky.",
            "159 753 486",
            ["Technical Writer"],
            [new Account($id_counter,"TechWriter", "username/password", new \DateTimeImmutable("2026-05-01"))]
        );
        $id_counter++;

        $this->employees[] = new Employee(
            "Jane Smith",
            "jane.smith@example.com",
            "/images/2.jpg",
            "k321",
            "Projektový manažer s talentem pro organizaci.",
            "987 654 321",
            ["Project Manager"],
            [new Account($id_counter,"User", "username/password", new \DateTimeImmutable("2025-06-01"))]
        );
        $id_counter++;
        // Adding additional employees
        $this->employees[] = new Employee(
            "Aneta Branická",
            "aneta.branicka@example.com",
            "/images/2.jpg",
            "k322",
            "Marketingová specialistka zaměřená na digitální strategie.",
            "123 654 987",
            ["Marketing Specialist"],
            [new Account($id_counter,"Marketing", "username/password", new \DateTimeImmutable("2025-05-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Mikuláš Novotný",
            "mikulass.novotny@example.com",
            "/images/1.jpg",
            "k323",
            "Expert na finance se silným analytickým zázemím.",
            "654 321 987",
            ["Finance Expert"],
            [new Account($id_counter,"Finance", "username/password", new \DateTimeImmutable("2025-03-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Richard Prosta",
            "richard.prosta@example.com",
            "/images/1.jpg",
            "k324",
            "Softwarový vývojář s vášní pro nové technologie.",
            "321 654 987",
            ["Software Developer"],
            [new Account($id_counter,"Dev", "username/password", new \DateTimeImmutable("2025-04-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Nikola Vosocká",
            "nikola.vosocka@example.com",
            "/images/2.jpg",
            "k325",
            "HR specialistka oddaná rozvoji zaměstnanců.",
            "789 654 321",
            ["HR Specialist"],
            [new Account($id_counter,"HR", "username/password", new \DateTimeImmutable("2025-07-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Kvido Pelich",
            "kvido.pelich@example.com",
            "/images/1.jpg",
            "k326",
            "Obchodní zástupce s vynikajícími vyjednávacími dovednostmi.",
            "456 789 123",
            ["Sales Representative"],
            [new Account($id_counter,"Sales", "username/password", new \DateTimeImmutable("2025-08-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Michal Pohlreich",
            "michal.pohlreich@example.com",
            "/images/1.jpg",
            "k327",
            "Manažer zákaznického servisu zaměřený na spokojenost klientů.",
            "147 258 369",
            ["Customer Service Manager"],
            [new Account($id_counter,"CS", "username/password", new \DateTimeImmutable("2025-09-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Petr Dobriš",
            "petr.dobris@example.com",
            "/images/1.jpg",
            "k328",
            "Koordinátor logistiky se silným organizačním zázemím.",
            "963 852 741",
            ["Logistics Coordinator"],
            [new Account($id_counter,"Logistics", "username/password", new \DateTimeImmutable("2025-10-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Lucie Fialová",
            "lucie.fialova@example.com",
            "/images/2.jpg",
            "k329",
            "Grafická designérka s dobrým okem pro estetiku.",
            "258 369 147",
            ["Graphic Designer"],
            [new Account($id_counter,"Design", "username/password", new \DateTimeImmutable("2025-11-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Tereza Rezková",
            "tereza.rezkova@example.com",
            "/images/2.jpg",
            "k330",
            "Tvůrkyně obsahu zaměřená na poutavé vyprávění.",
            "852 741 963",
            ["Content Creator"],
            [new Account($id_counter,"Content", "username/password", new \DateTimeImmutable("2025-12-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Roman Malý",
            "roman.maly@example.com",
            "/images/1.jpg",
            "k331",
            "Manažer operací se specializací na optimalizaci efektivity.",
            "654 123 789",
            ["Operations Manager"],
            [new Account($id_counter,"Ops", "username/password", new \DateTimeImmutable("2026-01-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Tomáš Černý",
            "tomas.cerny@example.com",
            "/images/1.jpg",
            "k332",
            "Specialistka IT podpory zajišťující plynulý chod operací.",
            "321 987 654",
            ["IT Support"],
            [new Account($id_counter,"Support", "username/password", new \DateTimeImmutable("2026-02-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Erik Polora",
            "erik.polora@example.com",
            "/images/1.jpg",
            "k333",
            "Webový vývojář se zájmem o frontendové technologie.",
            "654 789 321",
            ["Web Developer"],
            [new Account($id_counter,"WebDev", "username/password", new \DateTimeImmutable("2026-03-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Nikola Mizikovic",
            "nikola.mizikovic@example.com",
            "/images/2.jpg",
            "k334",
            "Analytik dat se silným zaměřením na rozhodování na základě dat.",
            "789 321 654",
            ["Data Analyst"],
            [new Account($id_counter,"Data", "username/password", new \DateTimeImmutable("2026-04-01"))]
        );
        $id_counter++;
        $this->employees[] = new Employee(
            "Petr Novák",
            "petr.novak@priklad.cz",
            "/images/1.jpg",
            "k320",
            "Petr je spolehlivý IT pracovník, který se vždy snaží najít efektivní řešení problémů. Kromě své odbornosti v oblasti správy systémů je také vášnivým rybářem, což mu pomáhá udržovat rovnováhu mezi prací a volným časem. Kolegové na něj mohou vždy spoléhat, protože je precizní a rychle reaguje na jakýkoli technický problém. Jeho schopnost přemýšlet mimo rámec běžných postupů z něj dělá nepostradatelného člena týmu. Ať už se jedná o správu serverů nebo o pomoc s uživatelskými dotazy, vždy přistupuje ke své práci s maximální péčí a profesionalitou.",
            "123 456 789",
            ["IT specialista", "Projektový manažer"],
            [new Account($id_counter,"Admin", "karta", new \DateTimeImmutable("2028-01-01")),
                new Account($id_counter,"IT Podpora", "username/password", new \DateTimeImmutable("2025-01-01"))]
        );

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