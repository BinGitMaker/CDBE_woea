<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220802224709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE massage ADD pack_cat_solo_id INT DEFAULT NULL, ADD pack_cat_multi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE massage ADD CONSTRAINT FK_2D2C7269CB8E96F3 FOREIGN KEY (pack_cat_solo_id) REFERENCES pack_cat_solo (id)');
        $this->addSql('ALTER TABLE massage ADD CONSTRAINT FK_2D2C7269410561E4 FOREIGN KEY (pack_cat_multi_id) REFERENCES pack_cat_multi (id)');
        $this->addSql('CREATE INDEX IDX_2D2C7269CB8E96F3 ON massage (pack_cat_solo_id)');
        $this->addSql('CREATE INDEX IDX_2D2C7269410561E4 ON massage (pack_cat_multi_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE massage DROP FOREIGN KEY FK_2D2C7269CB8E96F3');
        $this->addSql('ALTER TABLE massage DROP FOREIGN KEY FK_2D2C7269410561E4');
        $this->addSql('DROP INDEX IDX_2D2C7269CB8E96F3 ON massage');
        $this->addSql('DROP INDEX IDX_2D2C7269410561E4 ON massage');
        $this->addSql('ALTER TABLE massage DROP pack_cat_solo_id, DROP pack_cat_multi_id');
    }
}
