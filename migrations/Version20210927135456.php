<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210927135456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actualite (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bordure (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classement (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, jeu_id INT NOT NULL, ranking INT NOT NULL, INDEX IDX_55EE9D6DA76ED395 (user_id), INDEX IDX_55EE9D6D8C9E392E (jeu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, regle LONGTEXT DEFAULT NULL, nbrjoueur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skin (id INT AUTO_INCREMENT NOT NULL, rock_url VARCHAR(255) NOT NULL, scissor_url VARCHAR(255) NOT NULL, paper_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistique (id INT AUTO_INCREMENT NOT NULL, nbr_partie INT NOT NULL, nbr_win INT NOT NULL, nbr_lose INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trophee (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, avatar_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64986383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_trophee (user_id INT NOT NULL, trophee_id INT NOT NULL, INDEX IDX_8867492BA76ED395 (user_id), INDEX IDX_8867492B753AAE2 (trophee_id), PRIMARY KEY(user_id, trophee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_bordure (user_id INT NOT NULL, bordure_id INT NOT NULL, INDEX IDX_6557D6D4A76ED395 (user_id), INDEX IDX_6557D6D469CB389B (bordure_id), PRIMARY KEY(user_id, bordure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_statistique (user_id INT NOT NULL, statistique_id INT NOT NULL, INDEX IDX_DABBF138A76ED395 (user_id), INDEX IDX_DABBF13876A81463 (statistique_id), PRIMARY KEY(user_id, statistique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_skin (user_id INT NOT NULL, skin_id INT NOT NULL, INDEX IDX_78F824D7A76ED395 (user_id), INDEX IDX_78F824D7F404637F (skin_id), PRIMARY KEY(user_id, skin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classement ADD CONSTRAINT FK_55EE9D6DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE classement ADD CONSTRAINT FK_55EE9D6D8C9E392E FOREIGN KEY (jeu_id) REFERENCES jeu (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64986383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id)');
        $this->addSql('ALTER TABLE user_trophee ADD CONSTRAINT FK_8867492BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_trophee ADD CONSTRAINT FK_8867492B753AAE2 FOREIGN KEY (trophee_id) REFERENCES trophee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_bordure ADD CONSTRAINT FK_6557D6D4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_bordure ADD CONSTRAINT FK_6557D6D469CB389B FOREIGN KEY (bordure_id) REFERENCES bordure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_statistique ADD CONSTRAINT FK_DABBF138A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_statistique ADD CONSTRAINT FK_DABBF13876A81463 FOREIGN KEY (statistique_id) REFERENCES statistique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_skin ADD CONSTRAINT FK_78F824D7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_skin ADD CONSTRAINT FK_78F824D7F404637F FOREIGN KEY (skin_id) REFERENCES skin (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64986383B10');
        $this->addSql('ALTER TABLE user_bordure DROP FOREIGN KEY FK_6557D6D469CB389B');
        $this->addSql('ALTER TABLE classement DROP FOREIGN KEY FK_55EE9D6D8C9E392E');
        $this->addSql('ALTER TABLE user_skin DROP FOREIGN KEY FK_78F824D7F404637F');
        $this->addSql('ALTER TABLE user_statistique DROP FOREIGN KEY FK_DABBF13876A81463');
        $this->addSql('ALTER TABLE user_trophee DROP FOREIGN KEY FK_8867492B753AAE2');
        $this->addSql('ALTER TABLE classement DROP FOREIGN KEY FK_55EE9D6DA76ED395');
        $this->addSql('ALTER TABLE user_trophee DROP FOREIGN KEY FK_8867492BA76ED395');
        $this->addSql('ALTER TABLE user_bordure DROP FOREIGN KEY FK_6557D6D4A76ED395');
        $this->addSql('ALTER TABLE user_statistique DROP FOREIGN KEY FK_DABBF138A76ED395');
        $this->addSql('ALTER TABLE user_skin DROP FOREIGN KEY FK_78F824D7A76ED395');
        $this->addSql('DROP TABLE actualite');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE bordure');
        $this->addSql('DROP TABLE classement');
        $this->addSql('DROP TABLE jeu');
        $this->addSql('DROP TABLE skin');
        $this->addSql('DROP TABLE statistique');
        $this->addSql('DROP TABLE trophee');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_trophee');
        $this->addSql('DROP TABLE user_bordure');
        $this->addSql('DROP TABLE user_statistique');
        $this->addSql('DROP TABLE user_skin');
    }
}
