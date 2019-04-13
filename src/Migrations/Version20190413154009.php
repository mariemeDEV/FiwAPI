<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190413154009 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaction (id_transaction INT AUTO_INCREMENT NOT NULL, id_compte INT DEFAULT NULL, id_type INT DEFAULT NULL, montant_transaction DOUBLE PRECISION NOT NULL, date_transaction DATE NOT NULL, INDEX id_type (id_type), INDEX id_compte (id_compte), PRIMARY KEY(id_transaction)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(20) NOT NULL, password VARCHAR(20) NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, adresse VARCHAR(40) NOT NULL, telephone VARCHAR(30) NOT NULL, pays VARCHAR(20) NOT NULL, photo BLOB DEFAULT NULL, profil VARCHAR(15) NOT NULL, matricule VARCHAR(15) DEFAULT NULL, UNIQUE INDEX login (login), UNIQUE INDEX password (password), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typeDeTransaction (id_type INT AUTO_INCREMENT NOT NULL, libelle_type VARCHAR(255) NOT NULL, PRIMARY KEY(id_type)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id_compte INT AUTO_INCREMENT NOT NULL, id_utilisateur INT DEFAULT NULL, solde INT NOT NULL, points INT NOT NULL, INDEX id_utilisateur (id_utilisateur), PRIMARY KEY(id_compte)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1E9C1E78D FOREIGN KEY (id_compte) REFERENCES compte (id_compte)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D17FE4B2B FOREIGN KEY (id_type) REFERENCES typeDeTransaction (id_type)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526050EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526050EAE44');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D17FE4B2B');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1E9C1E78D');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE typeDeTransaction');
        $this->addSql('DROP TABLE compte');
    }
}
