<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220731105425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE massage ADD mass_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE massage ADD CONSTRAINT FK_2D2C7269816B7527 FOREIGN KEY (mass_category_id) REFERENCES mass_category (id)');
        $this->addSql('CREATE INDEX IDX_2D2C7269816B7527 ON massage (mass_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE massage DROP FOREIGN KEY FK_2D2C7269816B7527');
        $this->addSql('DROP INDEX IDX_2D2C7269816B7527 ON massage');
        $this->addSql('ALTER TABLE massage DROP mass_category_id');
    }
}
