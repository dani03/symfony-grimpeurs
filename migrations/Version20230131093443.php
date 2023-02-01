<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131093443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jpo_user (jpo_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_27575FF11B3A9627 (jpo_id), INDEX IDX_27575FF1A76ED395 (user_id), PRIMARY KEY(jpo_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jpo_user ADD CONSTRAINT FK_27575FF11B3A9627 FOREIGN KEY (jpo_id) REFERENCES jpo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jpo_user ADD CONSTRAINT FK_27575FF1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jpo_user DROP FOREIGN KEY FK_27575FF11B3A9627');
        $this->addSql('ALTER TABLE jpo_user DROP FOREIGN KEY FK_27575FF1A76ED395');
        $this->addSql('DROP TABLE jpo_user');
    }
}
