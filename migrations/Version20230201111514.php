<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201111514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD level_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649159D9B5E FOREIGN KEY (level_id_id) REFERENCES level (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649159D9B5E ON user (level_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649159D9B5E');
        $this->addSql('DROP INDEX IDX_8D93D649159D9B5E ON user');
        $this->addSql('ALTER TABLE user DROP level_id_id');
    }
}
