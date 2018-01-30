<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180130114650 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD evenement_id INT NOT NULL, DROP id_user, CHANGE id_event id_user_id INT NOT NULL, CHANGE date_commentaire date DATE NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A79F37AE5 ON comments (id_user_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AFD02F13 ON comments (evenement_id)');
        $this->addSql('ALTER TABLE evenement ADD sport_id INT NOT NULL, ADD niveau_id INT NOT NULL, DROP sport, DROP niveau');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_B26681EAC78BCF8 ON evenement (sport_id)');
        $this->addSql('CREATE INDEX IDX_B26681EB3E9C81 ON evenement (niveau_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EB3E9C81');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EAC78BCF8');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE sport');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A79F37AE5');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AFD02F13');
        $this->addSql('DROP INDEX IDX_5F9E962A79F37AE5 ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962AFD02F13 ON comments');
        $this->addSql('ALTER TABLE comments ADD id_user VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD id_event INT NOT NULL, DROP id_user_id, DROP evenement_id, CHANGE date date_commentaire DATE NOT NULL');
        $this->addSql('DROP INDEX IDX_B26681EAC78BCF8 ON evenement');
        $this->addSql('DROP INDEX IDX_B26681EB3E9C81 ON evenement');
        $this->addSql('ALTER TABLE evenement ADD sport VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD niveau VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, DROP sport_id, DROP niveau_id');
    }
}
