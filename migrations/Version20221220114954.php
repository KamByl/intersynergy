<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220114954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE osoby (id INT AUTO_INCREMENT NOT NULL, imie VARCHAR(50) NOT NULL, nazwisko VARCHAR(100) NOT NULL, pesel VARCHAR(11) NOT NULL, nip VARCHAR(10) DEFAULT NULL, adres VARCHAR(255) DEFAULT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, haslo VARCHAR(255) NOT NULL, opis LONGTEXT DEFAULT NULL, zainteresowania LONGTEXT DEFAULT NULL, umiejetnosci LONGTEXT DEFAULT NULL, doswiadczenie LONGTEXT DEFAULT NULL, data_urodzenia DATE NOT NULL, data_rejestracji DATE NOT NULL, data_aktualizacji_wpisu DATETIME NOT NULL, ocena SMALLINT NOT NULL, cv VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_99535453E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uzyt (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D5615AEE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE osoby');
        $this->addSql('DROP TABLE uzyt');
    }
}
