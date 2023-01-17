<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221123012709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, date_cmd DATETIME NOT NULL, etat_cmd TINYINT(1) NOT NULL, prix_total NUMERIC(6, 2) NOT NULL, UNIQUE INDEX UNIQ_6EEAA67DF77D927C (panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_24CC0DF2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier_vetement (panier_id INT NOT NULL, vetement_id INT NOT NULL, INDEX IDX_A6F14FBDF77D927C (panier_id), INDEX IDX_A6F14FBD969D8B67 (vetement_id), PRIMARY KEY(panier_id, vetement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vetement (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix NUMERIC(6, 2) NOT NULL, taille VARCHAR(255) DEFAULT NULL, file VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, dispo TINYINT(1) NOT NULL, INDEX IDX_3CB446CFBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE panier_vetement ADD CONSTRAINT FK_A6F14FBDF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_vetement ADD CONSTRAINT FK_A6F14FBD969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF77D927C');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2A76ED395');
        $this->addSql('ALTER TABLE panier_vetement DROP FOREIGN KEY FK_A6F14FBDF77D927C');
        $this->addSql('ALTER TABLE panier_vetement DROP FOREIGN KEY FK_A6F14FBD969D8B67');
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CFBCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE panier_vetement');
        $this->addSql('DROP TABLE vetement');
    }
}
