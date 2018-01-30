<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180129155036 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement DROP heure_debut, DROP heure_fin, DROP date_limite, DROP statut_prix, DROP prix, CHANGE date_evenement date_evenement DATETIME DEFAULT NULL, CHANGE code_postal code_postal VARCHAR(5) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement ADD heure_debut TIME DEFAULT NULL, ADD heure_fin TIME DEFAULT NULL, ADD date_limite DATE DEFAULT NULL, ADD statut_prix TINYINT(1) DEFAULT NULL, ADD prix INT NOT NULL, CHANGE date_evenement date_evenement DATE DEFAULT NULL, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE ville ville INT DEFAULT NULL');
    }
}
