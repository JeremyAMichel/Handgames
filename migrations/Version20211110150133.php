<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211110150133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_skin ADD CONSTRAINT FK_78F824D7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_skin ADD CONSTRAINT FK_78F824D7F404637F FOREIGN KEY (skin_id) REFERENCES skin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_skin DROP FOREIGN KEY FK_78F824D7A76ED395');
        $this->addSql('ALTER TABLE user_skin DROP FOREIGN KEY FK_78F824D7F404637F');
    }
}
