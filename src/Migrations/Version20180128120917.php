<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180128120917 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, sport_id INT NOT NULL, niveau_id INT NOT NULL, titre VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, statut TINYINT(1) DEFAULT NULL, organisateur VARCHAR(255) NOT NULL, date_evenement DATE DEFAULT NULL, heure_debut TIME DEFAULT NULL, heure_fin TIME DEFAULT NULL, inscription TINYINT(1) DEFAULT NULL, participant_min INT DEFAULT NULL, participant_max INT DEFAULT NULL, date_limite DATE DEFAULT NULL, statut_prix TINYINT(1) DEFAULT NULL, prix INT NOT NULL, code_postal INT DEFAULT NULL, ville INT DEFAULT NULL, quartier VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, participant LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', INDEX IDX_B26681EAC78BCF8 (sport_id), INDEX IDX_B26681EB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(60) NOT NULL, is_active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EB3E9C81');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EAC78BCF8');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE user');
    }
}
