<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109191506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF77D927C');
        $this->addSql('CREATE TABLE commande_vetement (commande_id INT NOT NULL, vetement_id INT NOT NULL, INDEX IDX_EA945E5582EA2E54 (commande_id), INDEX IDX_EA945E55969D8B67 (vetement_id), PRIMARY KEY(commande_id, vetement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_vetement ADD CONSTRAINT FK_EA945E5582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_vetement ADD CONSTRAINT FK_EA945E55969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cmd_line DROP FOREIGN KEY FK_8512BA8969D8B67');
        $this->addSql('ALTER TABLE cmd_line DROP FOREIGN KEY FK_8512BA8F77D927C');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2A76ED395');
        $this->addSql('ALTER TABLE panier_vetement DROP FOREIGN KEY FK_A6F14FBDF77D927C');
        $this->addSql('ALTER TABLE panier_vetement DROP FOREIGN KEY FK_A6F14FBD969D8B67');
        $this->addSql('DROP TABLE cmd_line');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE panier_vetement');
        $this->addSql('DROP INDEX UNIQ_6EEAA67DF77D927C ON commande');
        $this->addSql('ALTER TABLE commande ADD user_id INT NOT NULL, DROP panier_id');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cmd_line (id INT AUTO_INCREMENT NOT NULL, vetement_id INT NOT NULL, panier_id INT NOT NULL, qte INT NOT NULL, INDEX IDX_8512BA8969D8B67 (vetement_id), INDEX IDX_8512BA8F77D927C (panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_24CC0DF2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE panier_vetement (panier_id INT NOT NULL, vetement_id INT NOT NULL, INDEX IDX_A6F14FBD969D8B67 (vetement_id), INDEX IDX_A6F14FBDF77D927C (panier_id), PRIMARY KEY(panier_id, vetement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cmd_line ADD CONSTRAINT FK_8512BA8969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id)');
        $this->addSql('ALTER TABLE cmd_line ADD CONSTRAINT FK_8512BA8F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE panier_vetement ADD CONSTRAINT FK_A6F14FBDF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_vetement ADD CONSTRAINT FK_A6F14FBD969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_vetement DROP FOREIGN KEY FK_EA945E5582EA2E54');
        $this->addSql('ALTER TABLE commande_vetement DROP FOREIGN KEY FK_EA945E55969D8B67');
        $this->addSql('DROP TABLE commande_vetement');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('DROP INDEX IDX_6EEAA67DA76ED395 ON commande');
        $this->addSql('ALTER TABLE commande ADD panier_id INT DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67DF77D927C ON commande (panier_id)');
    }
}
