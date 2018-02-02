<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180202134045 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE localisation');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A79F37AE5');
        $this->addSql('DROP INDEX IDX_5F9E962A79F37AE5 ON comments');
        $this->addSql('ALTER TABLE comments CHANGE id_user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AA76ED395 ON comments (user_id)');
        $this->addSql('ALTER TABLE evenement ADD inscription TINYINT(1) DEFAULT NULL, ADD participant_min INT DEFAULT NULL, ADD code_postal VARCHAR(5) DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL, DROP localisation_id');
        $this->addSql('ALTER TABLE participant ADD nom VARCHAR(255) NOT NULL, ADD evenement INT NOT NULL, ADD user INT NOT NULL, DROP evenement_id, DROP user_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE localisation (id INT AUTO_INCREMENT NOT NULL, departement INT NOT NULL, ville VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, code_postal VARCHAR(5) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('DROP INDEX IDX_5F9E962AA76ED395 ON comments');
        $this->addSql('ALTER TABLE comments CHANGE user_id id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A79F37AE5 ON comments (id_user_id)');
        $this->addSql('ALTER TABLE evenement ADD localisation_id INT NOT NULL, DROP inscription, DROP participant_min, DROP code_postal, DROP ville');
        $this->addSql('ALTER TABLE participant ADD evenement_id INT NOT NULL, ADD user_id INT NOT NULL, DROP nom, DROP evenement, DROP user');
    }
}
