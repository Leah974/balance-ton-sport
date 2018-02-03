<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180202172011 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A79F37AE5');
        $this->addSql('DROP INDEX IDX_5F9E962A79F37AE5 ON comments');
        $this->addSql('ALTER TABLE comments CHANGE date date DATETIME NOT NULL, CHANGE id_user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AA76ED395 ON comments (user_id)');
        $this->addSql('ALTER TABLE user DROP nom, DROP prenom, DROP telephone, DROP sport_favori, DROP photo, DROP sexe, DROP dte_naissance, DROP ville, DROP mini_bio');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('DROP INDEX IDX_5F9E962AA76ED395 ON comments');
        $this->addSql('ALTER TABLE comments CHANGE date date DATE NOT NULL, CHANGE user_id id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A79F37AE5 ON comments (id_user_id)');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(30) NOT NULL COLLATE utf8_unicode_ci, ADD prenom VARCHAR(30) NOT NULL COLLATE utf8_unicode_ci, ADD telephone VARCHAR(10) NOT NULL COLLATE utf8_unicode_ci, ADD sport_favori VARCHAR(50) NOT NULL COLLATE utf8_unicode_ci, ADD photo VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD sexe VARCHAR(1) NOT NULL COLLATE utf8_unicode_ci, ADD dte_naissance DATE NOT NULL, ADD ville VARCHAR(50) NOT NULL COLLATE utf8_unicode_ci, ADD mini_bio TINYTEXT NOT NULL COLLATE utf8_unicode_ci');
    }
}
