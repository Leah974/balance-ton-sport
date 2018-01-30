<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180129194505 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE evenement_participant (evenement_id INT NOT NULL, participant_id INT NOT NULL, INDEX IDX_460A7D3AFD02F13 (evenement_id), INDEX IDX_460A7D3A9D1C3019 (participant_id), PRIMARY KEY(evenement_id, participant_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_participant (user_id INT NOT NULL, participant_id INT NOT NULL, INDEX IDX_7E84A284A76ED395 (user_id), INDEX IDX_7E84A2849D1C3019 (participant_id), PRIMARY KEY(user_id, participant_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement_participant ADD CONSTRAINT FK_460A7D3AFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_participant ADD CONSTRAINT FK_460A7D3A9D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_participant ADD CONSTRAINT FK_7E84A284A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_participant ADD CONSTRAINT FK_7E84A2849D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E9D1C3019');
        $this->addSql('DROP INDEX IDX_B26681E9D1C3019 ON evenement');
        $this->addSql('ALTER TABLE evenement DROP participant_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499D1C3019');
        $this->addSql('DROP INDEX IDX_8D93D6499D1C3019 ON user');
        $this->addSql('ALTER TABLE user DROP participant_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE evenement_participant');
        $this->addSql('DROP TABLE user_participant');
        $this->addSql('ALTER TABLE evenement ADD participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E9D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('CREATE INDEX IDX_B26681E9D1C3019 ON evenement (participant_id)');
        $this->addSql('ALTER TABLE user ADD participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6499D1C3019 ON user (participant_id)');
    }
}
