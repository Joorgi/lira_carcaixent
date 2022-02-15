<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220215085657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F90C3340');
        $this->addSql('DROP INDEX UNIQ_8D93D649F90C3340 ON user');
        $this->addSql('ALTER TABLE user CHANGE id_musico_id ID_MUSICO INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493483FB76 FOREIGN KEY (ID_MUSICO) REFERENCES musico (ID)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6493483FB76 ON user (ID_MUSICO)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493483FB76');
        $this->addSql('DROP INDEX UNIQ_8D93D6493483FB76 ON user');
        $this->addSql('ALTER TABLE user CHANGE ID_MUSICO id_musico_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F90C3340 FOREIGN KEY (id_musico_id) REFERENCES musico (ID)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F90C3340 ON user (id_musico_id)');
    }
}
