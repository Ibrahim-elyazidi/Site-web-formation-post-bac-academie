<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230117160343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, num_departement INT NOT NULL, nom_departement VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, departement_id INT NOT NULL, nom_etablissement VARCHAR(115) NOT NULL, adresse_etablissement VARCHAR(145) NOT NULL, telephone_etablissement VARCHAR(10) NOT NULL, INDEX IDX_20FD592CCCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement_formation (etablissement_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_2D9FACD6FF631228 (etablissement_id), INDEX IDX_2D9FACD65200282E (formation_id), PRIMARY KEY(etablissement_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(12) NOT NULL, duree INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referent (id INT AUTO_INCREMENT NOT NULL, nom_ref VARCHAR(50) NOT NULL, prenom_ref VARCHAR(50) NOT NULL, adresse_ref VARCHAR(50) NOT NULL, telephone_ref VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_web (id INT AUTO_INCREMENT NOT NULL, lien VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CCCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE etablissement_formation ADD CONSTRAINT FK_2D9FACD6FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement_formation ADD CONSTRAINT FK_2D9FACD65200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CCCF9E01E');
        $this->addSql('ALTER TABLE etablissement_formation DROP FOREIGN KEY FK_2D9FACD6FF631228');
        $this->addSql('ALTER TABLE etablissement_formation DROP FOREIGN KEY FK_2D9FACD65200282E');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE etablissement_formation');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE referent');
        $this->addSql('DROP TABLE site_web');
    }
}
