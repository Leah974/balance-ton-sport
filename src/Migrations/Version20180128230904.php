<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180128230904 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sport ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sport ADD CONSTRAINT FK_1A85EFD2BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_1A85EFD2BCF5E72D ON sport (categorie_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sport DROP FOREIGN KEY FK_1A85EFD2BCF5E72D');
        $this->addSql('DROP INDEX IDX_1A85EFD2BCF5E72D ON sport');
        $this->addSql('ALTER TABLE sport DROP categorie_id');
    }
}
