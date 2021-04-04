<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404072749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD id_cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993987BF9CE86 FOREIGN KEY (id_cliente_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F52993987BF9CE86 ON `order` (id_cliente_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993987BF9CE86');
        $this->addSql('DROP INDEX IDX_F52993987BF9CE86 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP id_cliente_id');
    }
}
