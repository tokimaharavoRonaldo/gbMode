<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129232115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cmd_line (id INT AUTO_INCREMENT NOT NULL, vetement_id INT NOT NULL, panier_id INT NOT NULL, qte INT NOT NULL, INDEX IDX_8512BA8969D8B67 (vetement_id), INDEX IDX_8512BA8F77D927C (panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cmd_line ADD CONSTRAINT FK_8512BA8969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id)');
        $this->addSql('ALTER TABLE cmd_line ADD CONSTRAINT FK_8512BA8F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cmd_line DROP FOREIGN KEY FK_8512BA8969D8B67');
        $this->addSql('ALTER TABLE cmd_line DROP FOREIGN KEY FK_8512BA8F77D927C');
        $this->addSql('DROP TABLE cmd_line');
    }
}
