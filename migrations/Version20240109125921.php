<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109125921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE envirometal_metric (id INT AUTO_INCREMENT NOT NULL, metric_type_id INT NOT NULL, value DOUBLE PRECISION DEFAULT NULL, INDEX IDX_8BDB7DE3E4789E1D (metric_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE envirometal_metric ADD CONSTRAINT FK_8BDB7DE3E4789E1D FOREIGN KEY (metric_type_id) REFERENCES metric_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE envirometal_metric DROP FOREIGN KEY FK_8BDB7DE3E4789E1D');
        $this->addSql('DROP TABLE envirometal_metric');
    }
}
