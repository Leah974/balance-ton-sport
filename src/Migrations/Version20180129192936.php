<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180129192936 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement ADD participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E9D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('CREATE INDEX IDX_B26681E9D1C3019 ON evenement (participant_id)');
        $this->addSql('ALTER TABLE user ADD participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6499D1C3019 ON user (participant_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E9D1C3019');
        $this->addSql('DROP INDEX IDX_B26681E9D1C3019 ON evenement');
        $this->addSql('ALTER TABLE evenement DROP participant_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499D1C3019');
        $this->addSql('DROP INDEX IDX_8D93D6499D1C3019 ON user');
        $this->addSql('ALTER TABLE user DROP participant_id');
    }
}
