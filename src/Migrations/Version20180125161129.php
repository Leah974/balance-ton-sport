<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180125161129 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement ADD statut_prix TINYINT(1) DEFAULT NULL, CHANGE organisateur organisateur VARCHAR(255) NOT NULL, CHANGE sport sport VARCHAR(255) NOT NULL, CHANGE prix prix INT NOT NULL, CHANGE participant participant LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\'');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement DROP statut_prix, CHANGE organisateur organisateur VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE sport sport VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE prix prix INT DEFAULT NULL, CHANGE participant participant LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:object)\'');
    }
}
