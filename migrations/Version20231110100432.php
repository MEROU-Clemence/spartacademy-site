<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231110100432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C78486F9AC');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C93698486F9AC');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, address0 VARCHAR(255) NOT NULL, address1 VARCHAR(255) DEFAULT NULL, address2 VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE adress');
        $this->addSql('ALTER TABLE facturation CHANGE adress address VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_D4F804C78486F9AC ON info_user');
        $this->addSql('ALTER TABLE info_user CHANGE adress_id address_id INT NOT NULL');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C7F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_D4F804C7F5B7AF75 ON info_user (address_id)');
        $this->addSql('DROP INDEX IDX_C27C93698486F9AC ON stage');
        $this->addSql('ALTER TABLE stage CHANGE adress_id address_id INT NOT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_C27C9369F5B7AF75 ON stage (address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C7F5B7AF75');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369F5B7AF75');
        $this->addSql('CREATE TABLE adress (id INT AUTO_INCREMENT NOT NULL, adress0 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adress1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, adress2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, zip_code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, city VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, country VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE address');
        $this->addSql('ALTER TABLE facturation CHANGE address adress VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_D4F804C7F5B7AF75 ON info_user');
        $this->addSql('ALTER TABLE info_user CHANGE address_id adress_id INT NOT NULL');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C78486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id)');
        $this->addSql('CREATE INDEX IDX_D4F804C78486F9AC ON info_user (adress_id)');
        $this->addSql('DROP INDEX IDX_C27C9369F5B7AF75 ON stage');
        $this->addSql('ALTER TABLE stage CHANGE address_id adress_id INT NOT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C93698486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id)');
        $this->addSql('CREATE INDEX IDX_C27C93698486F9AC ON stage (adress_id)');
    }
}
