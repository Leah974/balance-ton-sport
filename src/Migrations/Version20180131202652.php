<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180131202652 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A2C115A61');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A79F37AE5');
        $this->addSql('DROP INDEX IDX_5F9E962A79F37AE5 ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962A2C115A61 ON comments');
        $this->addSql('ALTER TABLE comments ADD user_id_id INT NOT NULL, ADD evenement_id_id INT NOT NULL, DROP id_user_id, DROP id_evenement_id');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AECEE32AF FOREIGN KEY (evenement_id_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A9D86650F ON comments (user_id_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AECEE32AF ON comments (evenement_id_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A9D86650F');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AECEE32AF');
        $this->addSql('DROP INDEX IDX_5F9E962A9D86650F ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962AECEE32AF ON comments');
        $this->addSql('ALTER TABLE comments ADD id_user_id INT NOT NULL, ADD id_evenement_id INT NOT NULL, DROP user_id_id, DROP evenement_id_id');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A2C115A61 FOREIGN KEY (id_evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A79F37AE5 ON comments (id_user_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A2C115A61 ON comments (id_evenement_id)');
    }
}
