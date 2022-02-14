<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213214440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evento (ID INT AUTO_INCREMENT NOT NULL, NOMBRE VARCHAR(50) NOT NULL, FECHA DATETIME NOT NULL, LUGAR VARCHAR(50) DEFAULT NULL, BANDA VARCHAR(50) NOT NULL, ID_PIEZA INT NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE socio (ID INT AUTO_INCREMENT NOT NULL, NOMBRE VARCHAR(50) NOT NULL, PRIMER_APELLIDO VARCHAR(50) NOT NULL, SEGUNDO_APELLIDO VARCHAR(50) DEFAULT NULL, DNI VARCHAR(9) NOT NULL, FECHA_ALTA DATETIME DEFAULT NULL, FECHA_BAJA DATETIME DEFAULT NULL, TIPO VARCHAR(50) NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pieza ADD CONSTRAINT FK_D8A766221E1D86F0 FOREIGN KEY (ID_AUTOR) REFERENCES autor (ID)');
        $this->addSql('ALTER TABLE pieza ADD CONSTRAINT FK_D8A76622EACE999B FOREIGN KEY (ID_EVENTO) REFERENCES evento (ID)');
        $this->addSql('CREATE INDEX IDX_D8A766221E1D86F0 ON pieza (ID_AUTOR)');
        $this->addSql('CREATE INDEX IDX_D8A76622EACE999B ON pieza (ID_EVENTO)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pieza DROP FOREIGN KEY FK_D8A76622EACE999B');
        $this->addSql('DROP TABLE evento');
        $this->addSql('DROP TABLE socio');
        $this->addSql('ALTER TABLE autor CHANGE NOMBRE NOMBRE VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE banda CHANGE NOMBRE nombre VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE instrumento CHANGE NOMBRE NOMBRE VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE noticia CHANGE TITULO TITULO VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE DESCRIPCION DESCRIPCION VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE IMAGEN IMAGEN VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE partitura CHANGE ROL_INSTRUMENTO ROL_INSTRUMENTO VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE FICHERO FICHERO VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pieza DROP FOREIGN KEY FK_D8A766221E1D86F0');
        $this->addSql('DROP INDEX IDX_D8A766221E1D86F0 ON pieza');
        $this->addSql('DROP INDEX IDX_D8A76622EACE999B ON pieza');
        $this->addSql('ALTER TABLE pieza CHANGE NOMBRE NOMBRE VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
