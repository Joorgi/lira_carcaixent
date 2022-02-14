<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213212005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE autor (ID INT AUTO_INCREMENT NOT NULL, NOMBRE VARCHAR(50) NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrumento (ID INT AUTO_INCREMENT NOT NULL, NOMBRE VARCHAR(50) NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partitura (ID INT AUTO_INCREMENT NOT NULL, ROL_INSTRUMENTO VARCHAR(50) NOT NULL, FICHERO VARCHAR(255) NOT NULL, ID_PIEZA INT NOT NULL, ID_INSTRUMENTO INT NOT NULL, INDEX IDX_E4563B7DF7BDBE68 (ID_PIEZA), INDEX IDX_E4563B7D1C5AEE76 (ID_INSTRUMENTO), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pieza (ID INT AUTO_INCREMENT NOT NULL, NOMBRE VARCHAR(50) NOT NULL, ID_EVENTO INT NOT NULL, ID_AUTOR INT NOT NULL, INDEX IDX_D8A766221E1D86F0 (ID_AUTOR), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partitura ADD CONSTRAINT FK_E4563B7DF7BDBE68 FOREIGN KEY (ID_PIEZA) REFERENCES pieza (ID)');
        $this->addSql('ALTER TABLE partitura ADD CONSTRAINT FK_E4563B7D1C5AEE76 FOREIGN KEY (ID_INSTRUMENTO) REFERENCES instrumento (ID)');
        $this->addSql('ALTER TABLE pieza ADD CONSTRAINT FK_D8A766221E1D86F0 FOREIGN KEY (ID_AUTOR) REFERENCES autor (ID)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pieza DROP FOREIGN KEY FK_D8A766221E1D86F0');
        $this->addSql('ALTER TABLE partitura DROP FOREIGN KEY FK_E4563B7D1C5AEE76');
        $this->addSql('ALTER TABLE partitura DROP FOREIGN KEY FK_E4563B7DF7BDBE68');
        $this->addSql('DROP TABLE autor');
        $this->addSql('DROP TABLE instrumento');
        $this->addSql('DROP TABLE partitura');
        $this->addSql('DROP TABLE pieza');
        $this->addSql('ALTER TABLE banda CHANGE NOMBRE nombre VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE noticia CHANGE TITULO TITULO VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE DESCRIPCION DESCRIPCION VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE IMAGEN IMAGEN VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
