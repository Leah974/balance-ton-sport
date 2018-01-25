<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180125140229 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement ADD inscription TINYINT(1) NOT NULL, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE statut statut TINYINT(1) NOT NULL, CHANGE organisateur organisateur VARCHAR(255) NOT NULL, CHANGE sport sport VARCHAR(255) NOT NULL, CHANGE niveau niveau VARCHAR(255) NOT NULL, CHANGE prix prix INT NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE quartier quartier VARCHAR(255) NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL, CHANGE participant participant LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', CHANGE date_evenement date_evenement DATE NOT NULL, CHANGE heure_debut heure_debut TIME NOT NULL, CHANGE heure_fin heure_fin TIME NOT NULL, CHANGE participant_min participant_min INT NOT NULL, CHANGE participant_max participant_max INT NOT NULL, CHANGE date_limite date_limite DATE NOT NULL, CHANGE code_postal code_postal INT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement DROP inscription, CHANGE titre titre VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE statut statut TINYINT(1) DEFAULT NULL, CHANGE organisateur organisateur VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE date_evenement date_evenement DATE DEFAULT NULL, CHANGE heure_debut heure_debut TIME DEFAULT NULL, CHANGE heure_fin heure_fin TIME DEFAULT NULL, CHANGE participant_min participant_min INT DEFAULT NULL, CHANGE participant_max participant_max INT DEFAULT NULL, CHANGE sport sport VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE niveau niveau VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE date_limite date_limite DATE DEFAULT NULL, CHANGE prix prix INT DEFAULT NULL, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE quartier quartier VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE photo photo VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE participant participant LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:object)\'');
    }
}
