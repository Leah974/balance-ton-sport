<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180203105627 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE evenement DROP inscription, DROP participant_min, DROP code_postal, DROP ville');
        $this->addSql('ALTER TABLE participant ADD evenement_id INT NOT NULL, ADD user_id INT NOT NULL, DROP nom, DROP evenement, DROP user');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D79F6B11FD02F13 ON participant (evenement_id)');
        $this->addSql('CREATE INDEX IDX_D79F6B11A76ED395 ON participant (user_id)');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(30) DEFAULT NULL, ADD prenom VARCHAR(30) DEFAULT NULL, ADD telephone VARCHAR(10) DEFAULT NULL, ADD sport_favori VARCHAR(50) DEFAULT NULL, ADD photo VARCHAR(255) DEFAULT NULL, ADD sexe VARCHAR(1) DEFAULT NULL, ADD dte_naissance DATE DEFAULT NULL, ADD ville VARCHAR(50) DEFAULT NULL, ADD mini_bio TINYTEXT DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments CHANGE date date DATE NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD inscription TINYINT(1) DEFAULT NULL, ADD participant_min INT DEFAULT NULL, ADD code_postal VARCHAR(5) DEFAULT NULL COLLATE utf8_unicode_ci, ADD ville VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11FD02F13');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11A76ED395');
        $this->addSql('DROP INDEX IDX_D79F6B11FD02F13 ON participant');
        $this->addSql('DROP INDEX IDX_D79F6B11A76ED395 ON participant');
        $this->addSql('ALTER TABLE participant ADD nom VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD evenement INT NOT NULL, ADD user INT NOT NULL, DROP evenement_id, DROP user_id');
        $this->addSql('ALTER TABLE user DROP nom, DROP prenom, DROP telephone, DROP sport_favori, DROP photo, DROP sexe, DROP dte_naissance, DROP ville, DROP mini_bio');
    }
}
