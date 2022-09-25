<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923091029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorite ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_68C58ED9A76ED395 ON favorite (user_id)');
        $this->addSql('ALTER TABLE user ADD home_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64928CDC89C FOREIGN KEY (home_id) REFERENCES home (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64928CDC89C ON user (home_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED9A76ED395');
        $this->addSql('DROP INDEX IDX_68C58ED9A76ED395 ON favorite');
        $this->addSql('ALTER TABLE favorite DROP user_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64928CDC89C');
        $this->addSql('DROP INDEX IDX_8D93D64928CDC89C ON user');
        $this->addSql('ALTER TABLE user DROP home_id');
    }
}
