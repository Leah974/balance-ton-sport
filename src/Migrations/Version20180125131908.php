<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180125131908 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement ADD date_evenement DATE NOT NULL, ADD heure_debut TIME NOT NULL, ADD heure_fin TIME NOT NULL, ADD participant_min INT NOT NULL, ADD participant_max INT NOT NULL, ADD date_limite DATE NOT NULL, ADD code_postal INT NOT NULL, DROP date, DROP heuredebut, DROP heurefin, DROP participantmin, DROP participantmax, DROP datelimite, DROP codepostal, CHANGE statut statut TINYINT(1) NOT NULL, CHANGE sport sport VARCHAR(255) NOT NULL, CHANGE niveau niveau VARCHAR(255) NOT NULL, CHANGE prix prix INT NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE quartier quartier VARCHAR(255) NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL, CHANGE participant participant LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\'');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement ADD date DATE DEFAULT NULL, ADD heuredebut TIME DEFAULT NULL, ADD heurefin TIME DEFAULT NULL, ADD participantmin INT DEFAULT NULL, ADD participantmax INT DEFAULT NULL, ADD datelimite DATE DEFAULT NULL, ADD codepostal INT DEFAULT NULL, DROP date_evenement, DROP heure_debut, DROP heure_fin, DROP participant_min, DROP participant_max, DROP date_limite, DROP code_postal, CHANGE statut statut TINYINT(1) DEFAULT NULL, CHANGE sport sport VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE niveau niveau VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE prix prix INT DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE quartier quartier VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE photo photo VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE participant participant LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:object)\'');
    }
}
