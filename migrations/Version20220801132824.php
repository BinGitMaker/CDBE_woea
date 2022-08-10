<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220801132824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE massage_pack (massage_id INT NOT NULL, pack_id INT NOT NULL, INDEX IDX_8E92B678E964225 (massage_id), INDEX IDX_8E92B6781919B217 (pack_id), PRIMARY KEY(massage_id, pack_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack (id INT AUTO_INCREMENT NOT NULL, time INT NOT NULL, price INT NOT NULL, content LONGTEXT NOT NULL, name VARCHAR(70) NOT NULL, is_solo TINYINT(1) NOT NULL, modality LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE massage_pack ADD CONSTRAINT FK_8E92B678E964225 FOREIGN KEY (massage_id) REFERENCES massage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE massage_pack ADD CONSTRAINT FK_8E92B6781919B217 FOREIGN KEY (pack_id) REFERENCES pack (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE massage_pack DROP FOREIGN KEY FK_8E92B6781919B217');
        $this->addSql('DROP TABLE massage_pack');
        $this->addSql('DROP TABLE pack');
    }
}
