<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250629082902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE refresh_tokens ADD refreshToken VARCHAR(255) NOT NULL, DROP refresh_token, CHANGE username username VARCHAR(255) NOT NULL, CHANGE valid valid DATETIME NOT NULL');
        $this->addSql('ALTER TABLE users ADD firstName VARCHAR(255) DEFAULT NULL, ADD lastName VARCHAR(255) DEFAULT NULL, DROP first_name, DROP last_name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE refresh_tokens ADD refresh_token VARCHAR(255) DEFAULT NULL, DROP refreshToken, CHANGE username username VARCHAR(255) DEFAULT NULL, CHANGE valid valid DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) DEFAULT NULL, DROP firstName, DROP lastName');
    }
}
