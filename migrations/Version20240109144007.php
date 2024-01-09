<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109144007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, material_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, cost DOUBLE PRECISION NOT NULL, INDEX IDX_7CBE759574D6573C (material_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material_supplier (material_id INT NOT NULL, supplier_id INT NOT NULL, INDEX IDX_DDF248DCE308AC6F (material_id), INDEX IDX_DDF248DC2ADD6D8C (supplier_id), PRIMARY KEY(material_id, supplier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE759574D6573C FOREIGN KEY (material_type_id) REFERENCES material_type (id)');
        $this->addSql('ALTER TABLE material_supplier ADD CONSTRAINT FK_DDF248DCE308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE material_supplier ADD CONSTRAINT FK_DDF248DC2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE envirometal_metric ADD material_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE envirometal_metric ADD CONSTRAINT FK_8BDB7DE3E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('CREATE INDEX IDX_8BDB7DE3E308AC6F ON envirometal_metric (material_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE envirometal_metric DROP FOREIGN KEY FK_8BDB7DE3E308AC6F');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE759574D6573C');
        $this->addSql('ALTER TABLE material_supplier DROP FOREIGN KEY FK_DDF248DCE308AC6F');
        $this->addSql('ALTER TABLE material_supplier DROP FOREIGN KEY FK_DDF248DC2ADD6D8C');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE material_supplier');
        $this->addSql('DROP INDEX IDX_8BDB7DE3E308AC6F ON envirometal_metric');
        $this->addSql('ALTER TABLE envirometal_metric DROP material_id');
    }
}
