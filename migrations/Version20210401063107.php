<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401063107 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorias ADD url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE marcas ADD url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE productos ADD url VARCHAR(255) NOT NULL, ADD titulo VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorias DROP url');
        $this->addSql('ALTER TABLE marcas DROP url');
        $this->addSql('ALTER TABLE productos DROP url, DROP titulo');
    }
}
