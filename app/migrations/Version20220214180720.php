<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214180720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumno (ID INT AUTO_INCREMENT NOT NULL, NOMBRE VARCHAR(50) NOT NULL, PRIMER_APELLIDO VARCHAR(50) NOT NULL, SEGUNDO_APELLIDO VARCHAR(50) DEFAULT NULL, FECHA_ALTA DATETIME DEFAULT NULL, FECHA_BAJA DATETIME DEFAULT NULL, ID_SOCIO INT NOT NULL, INDEX IDX_1435D52D17AC8B43 (ID_SOCIO), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE banda (ID INT AUTO_INCREMENT NOT NULL, NOMBRE VARCHAR(50) NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrumento (ID INT AUTO_INCREMENT NOT NULL, NOMBRE VARCHAR(50) NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musico (ID INT AUTO_INCREMENT NOT NULL, ID_SOCIO INT DEFAULT NULL, NOMBRE VARCHAR(50) NOT NULL, PRIMER_APELLIDO VARCHAR(50) NOT NULL, SEGUNDO_APELLIDO VARCHAR(50) NOT NULL, DNI VARCHAR(9) NOT NULL, ID_INSTRUMENTO INT DEFAULT NULL, ID_BANDA INT NOT NULL, ID_ALUMNO INT NOT NULL, INDEX IDX_99CB69E8B97D47B3 (ID_ALUMNO), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noticia (ID INT AUTO_INCREMENT NOT NULL, TITULO VARCHAR(50) NOT NULL, FECHA DATETIME NOT NULL, DESCRIPCION VARCHAR(255) NOT NULL, IMAGEN VARCHAR(255) DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partitura (ID INT AUTO_INCREMENT NOT NULL, ROL_INSTRUMENTO VARCHAR(50) NOT NULL, FICHERO VARCHAR(255) NOT NULL, ID_PIEZA INT NOT NULL, ID_INSTRUMENTO INT NOT NULL, INDEX IDX_E4563B7DF7BDBE68 (ID_PIEZA), INDEX IDX_E4563B7D1C5AEE76 (ID_INSTRUMENTO), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alumno ADD CONSTRAINT FK_1435D52D17AC8B43 FOREIGN KEY (ID_SOCIO) REFERENCES socio (ID)');
        $this->addSql('ALTER TABLE musico ADD CONSTRAINT FK_99CB69E8B97D47B3 FOREIGN KEY (ID_ALUMNO) REFERENCES alumno (ID)');
        $this->addSql('ALTER TABLE partitura ADD CONSTRAINT FK_E4563B7DF7BDBE68 FOREIGN KEY (ID_PIEZA) REFERENCES pieza (ID)');
        $this->addSql('ALTER TABLE partitura ADD CONSTRAINT FK_E4563B7D1C5AEE76 FOREIGN KEY (ID_INSTRUMENTO) REFERENCES instrumento (ID)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musico DROP FOREIGN KEY FK_99CB69E8B97D47B3');
        $this->addSql('ALTER TABLE partitura DROP FOREIGN KEY FK_E4563B7D1C5AEE76');
        $this->addSql('DROP TABLE alumno');
        $this->addSql('DROP TABLE banda');
        $this->addSql('DROP TABLE instrumento');
        $this->addSql('DROP TABLE musico');
        $this->addSql('DROP TABLE noticia');
        $this->addSql('DROP TABLE partitura');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
