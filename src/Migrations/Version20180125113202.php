<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180125113202 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement CHANGE statut statut TINYINT(1) NOT NULL, CHANGE organisateur organisateur VARCHAR(255) NOT NULL, CHANGE date date DATE NOT NULL, CHANGE heuredebut heuredebut TIME NOT NULL, CHANGE heurefin heurefin TIME NOT NULL, CHANGE participantmin participantmin INT NOT NULL, CHANGE participantmax participantmax INT NOT NULL, CHANGE sport sport VARCHAR(255) NOT NULL, CHANGE niveau niveau VARCHAR(255) NOT NULL, CHANGE datelimite datelimite DATE NOT NULL, CHANGE prix prix INT NOT NULL, CHANGE codepostal codepostal INT NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE quartier quartier VARCHAR(255) NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL, CHANGE participant participant LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\'');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement CHANGE statut statut TINYINT(1) DEFAULT NULL, CHANGE organisateur organisateur VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE date date DATE DEFAULT NULL, CHANGE heuredebut heuredebut TIME DEFAULT NULL, CHANGE heurefin heurefin VARCHAR(11) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE participantmin participantmin INT DEFAULT NULL, CHANGE participantmax participantmax INT DEFAULT NULL, CHANGE sport sport VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE niveau niveau VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE datelimite datelimite DATE DEFAULT NULL, CHANGE prix prix INT DEFAULT NULL, CHANGE codepostal codepostal INT DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE quartier quartier VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE photo photo VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE participant participant LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:object)\'');
    }
}
