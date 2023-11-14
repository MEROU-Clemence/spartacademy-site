<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114091300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_start DATETIME DEFAULT NULL, date_end DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_gallery (media_id INT NOT NULL, gallery_id INT NOT NULL, INDEX IDX_26FCFE73EA9FDD75 (media_id), INDEX IDX_26FCFE734E7AF8F (gallery_id), PRIMARY KEY(media_id, gallery_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_gallery (product_id INT NOT NULL, gallery_id INT NOT NULL, INDEX IDX_96F2638A4584665A (product_id), INDEX IDX_96F2638A4E7AF8F (gallery_id), PRIMARY KEY(product_id, gallery_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stage_gallery (stage_id INT NOT NULL, gallery_id INT NOT NULL, INDEX IDX_CDD238772298D193 (stage_id), INDEX IDX_CDD238774E7AF8F (gallery_id), PRIMARY KEY(stage_id, gallery_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media_gallery ADD CONSTRAINT FK_26FCFE73EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_gallery ADD CONSTRAINT FK_26FCFE734E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_gallery ADD CONSTRAINT FK_96F2638A4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_gallery ADD CONSTRAINT FK_96F2638A4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage_gallery ADD CONSTRAINT FK_CDD238772298D193 FOREIGN KEY (stage_id) REFERENCES stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage_gallery ADD CONSTRAINT FK_CDD238774E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product DROP image_path');
        $this->addSql('ALTER TABLE stage DROP image_path');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media_gallery DROP FOREIGN KEY FK_26FCFE73EA9FDD75');
        $this->addSql('ALTER TABLE media_gallery DROP FOREIGN KEY FK_26FCFE734E7AF8F');
        $this->addSql('ALTER TABLE product_gallery DROP FOREIGN KEY FK_96F2638A4584665A');
        $this->addSql('ALTER TABLE product_gallery DROP FOREIGN KEY FK_96F2638A4E7AF8F');
        $this->addSql('ALTER TABLE stage_gallery DROP FOREIGN KEY FK_CDD238772298D193');
        $this->addSql('ALTER TABLE stage_gallery DROP FOREIGN KEY FK_CDD238774E7AF8F');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE media_gallery');
        $this->addSql('DROP TABLE product_gallery');
        $this->addSql('DROP TABLE stage_gallery');
        $this->addSql('ALTER TABLE product ADD image_path VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE stage ADD image_path VARCHAR(255) NOT NULL');
    }
}
