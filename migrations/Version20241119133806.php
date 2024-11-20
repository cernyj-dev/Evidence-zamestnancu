<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119133806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employees_roles (employee_id INTEGER NOT NULL, role_id INTEGER NOT NULL, PRIMARY KEY(employee_id, role_id), CONSTRAINT FK_1D2A55268C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1D2A5526D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_1D2A55268C03F15C ON employees_roles (employee_id)');
        $this->addSql('CREATE INDEX IDX_1D2A5526D60322AC ON employees_roles (role_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__account AS SELECT id, employee_id, name, type, expiration FROM account');
        $this->addSql('DROP TABLE account');
        $this->addSql('CREATE TABLE account (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, employee_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, expiration DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_7D3656A48C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO account (id, employee_id, name, type, expiration) SELECT id, employee_id, name, type, expiration FROM __temp__account');
        $this->addSql('DROP TABLE __temp__account');
        $this->addSql('CREATE INDEX IDX_7D3656A48C03F15C ON account (employee_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__employee AS SELECT id, name, email, image_url, office_location, description, phone FROM employee');
        $this->addSql('DROP TABLE employee');
        $this->addSql('CREATE TABLE employee (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, office_location VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, phone VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO employee (id, name, email, image_url, office_location, description, phone) SELECT id, name, email, image_url, office_location, description, phone FROM __temp__employee');
        $this->addSql('DROP TABLE __temp__employee');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A1E7927C74 ON employee (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE employees_roles');
        $this->addSql('CREATE TEMPORARY TABLE __temp__account AS SELECT id, employee_id, name, type, expiration FROM account');
        $this->addSql('DROP TABLE account');
        $this->addSql('CREATE TABLE account (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, employee_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, expiration DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO account (id, employee_id, name, type, expiration) SELECT id, employee_id, name, type, expiration FROM __temp__account');
        $this->addSql('DROP TABLE __temp__account');
        $this->addSql('ALTER TABLE employee ADD COLUMN role_ids CLOB DEFAULT NULL');
    }
}
