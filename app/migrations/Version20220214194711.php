<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214194711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evento DROP FOREIGN KEY FK_47860B05F03D825B');
        $this->addSql('DROP INDEX IDX_47860B05F03D825B ON evento');
        $this->addSql('ALTER TABLE evento ADD BANDA VARCHAR(50) NOT NULL, DROP ID_BANDA');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evento ADD ID_BANDA INT NOT NULL, DROP BANDA');
        $this->addSql('ALTER TABLE evento ADD CONSTRAINT FK_47860B05F03D825B FOREIGN KEY (ID_BANDA) REFERENCES banda (ID)');
        $this->addSql('CREATE INDEX IDX_47860B05F03D825B ON evento (ID_BANDA)');
    }
}
