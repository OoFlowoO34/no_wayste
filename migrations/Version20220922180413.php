<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220922180413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, u_name VARCHAR(50) NOT NULL, u_color VARCHAR(7) NOT NULL, u_active_notification TINYINT(1) NOT NULL, u_hour_notification TIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorite CHANGE f_addition_date f_addition_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE home_product CHANGE hp_scan_date hp_scan_date DATETIME NOT NULL, CHANGE hp_use_by_date hp_use_by_date DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE favorite CHANGE f_addition_date f_addition_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE home_product CHANGE hp_scan_date hp_scan_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE hp_use_by_date hp_use_by_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
