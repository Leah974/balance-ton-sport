<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180204135815 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE alerte (id INT AUTO_INCREMENT NOT NULL, evenement_id INT NOT NULL, type_alerte VARCHAR(30) NOT NULL, statut TINYINT(1) NOT NULL, INDEX IDX_3AE753AFD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_alertes (user_id INT NOT NULL, alerte_id INT NOT NULL, INDEX IDX_2D01CC06A76ED395 (user_id), INDEX IDX_2D01CC062C9BA629 (alerte_id), PRIMARY KEY(user_id, alerte_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alerte ADD CONSTRAINT FK_3AE753AFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE users_alertes ADD CONSTRAINT FK_2D01CC06A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_alertes ADD CONSTRAINT FK_2D01CC062C9BA629 FOREIGN KEY (alerte_id) REFERENCES alerte (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users_alertes DROP FOREIGN KEY FK_2D01CC062C9BA629');
        $this->addSql('DROP TABLE alerte');
        $this->addSql('DROP TABLE users_alertes');
    }
}
