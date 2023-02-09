<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230209135652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, num INT NOT NULL, nom VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, departement_id INT DEFAULT NULL, nom_etablissement VARCHAR(25) NOT NULL, adresse_etablissement VARCHAR(70) NOT NULL, telephone_etablissement VARCHAR(10) NOT NULL, ville_etablissement VARCHAR(50) NOT NULL, site_etablissement VARCHAR(255) NOT NULL, INDEX IDX_20FD592CCCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement_formation (etablissement_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_2D9FACD6FF631228 (etablissement_id), INDEX IDX_2D9FACD65200282E (formation_id), PRIMARY KEY(etablissement_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, intitule_formation VARCHAR(25) NOT NULL, duree_formation INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_referent (formation_id INT NOT NULL, referent_id INT NOT NULL, INDEX IDX_3908FB9D5200282E (formation_id), INDEX IDX_3908FB9D35E47E35 (referent_id), PRIMARY KEY(formation_id, referent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_etablissement (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, etablissement_id INT DEFAULT NULL, site_web VARCHAR(150) NOT NULL, INDEX IDX_795F3ACD5200282E (formation_id), INDEX IDX_795F3ACDFF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referent (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT DEFAULT NULL, nom_referent VARCHAR(30) NOT NULL, prenom_referent VARCHAR(30) NOT NULL, mail_referent VARCHAR(35) NOT NULL, telephone_referent VARCHAR(10) NOT NULL, INDEX IDX_FE9AAC6CFF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CCCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE etablissement_formation ADD CONSTRAINT FK_2D9FACD6FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement_formation ADD CONSTRAINT FK_2D9FACD65200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_referent ADD CONSTRAINT FK_3908FB9D5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_referent ADD CONSTRAINT FK_3908FB9D35E47E35 FOREIGN KEY (referent_id) REFERENCES referent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_etablissement ADD CONSTRAINT FK_795F3ACD5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE formation_etablissement ADD CONSTRAINT FK_795F3ACDFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE referent ADD CONSTRAINT FK_FE9AAC6CFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CCCF9E01E');
        $this->addSql('ALTER TABLE etablissement_formation DROP FOREIGN KEY FK_2D9FACD6FF631228');
        $this->addSql('ALTER TABLE etablissement_formation DROP FOREIGN KEY FK_2D9FACD65200282E');
        $this->addSql('ALTER TABLE formation_referent DROP FOREIGN KEY FK_3908FB9D5200282E');
        $this->addSql('ALTER TABLE formation_referent DROP FOREIGN KEY FK_3908FB9D35E47E35');
        $this->addSql('ALTER TABLE formation_etablissement DROP FOREIGN KEY FK_795F3ACD5200282E');
        $this->addSql('ALTER TABLE formation_etablissement DROP FOREIGN KEY FK_795F3ACDFF631228');
        $this->addSql('ALTER TABLE referent DROP FOREIGN KEY FK_FE9AAC6CFF631228');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE etablissement_formation');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_referent');
        $this->addSql('DROP TABLE formation_etablissement');
        $this->addSql('DROP TABLE referent');
    }
}
