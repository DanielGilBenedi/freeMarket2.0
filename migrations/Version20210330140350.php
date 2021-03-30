<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330140350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorias (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, imagen VARCHAR(255) DEFAULT NULL, fecha DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marcas (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, imagen VARCHAR(255) DEFAULT NULL, fecha DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marcas (id INT AUTO_INCREMENT NOT NULL, id_cliente_id INT DEFAULT NULL, fecha DATE DEFAULT NULL, num_pedido VARCHAR(50) NOT NULL, cod_pedido VARCHAR(255) NOT NULL, precio DOUBLE PRECISION NOT NULL, array_productos LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_6716CCAA7BF9CE86 (id_cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE productos (id INT AUTO_INCREMENT NOT NULL, id_marca_id INT DEFAULT NULL, id_categoria_id INT DEFAULT NULL, fecha DATE DEFAULT NULL, cod_referencia VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, precio DOUBLE PRECISION NOT NULL, peso DOUBLE PRECISION NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, ean VARCHAR(255) NOT NULL, imagen VARCHAR(255) NOT NULL, stock INT NOT NULL, INDEX IDX_767490E6D134ECD4 (id_marca_id), INDEX IDX_767490E610560508 (id_categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE marcas ADD CONSTRAINT FK_6716CCAA7BF9CE86 FOREIGN KEY (id_cliente_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE productos ADD CONSTRAINT FK_767490E6D134ECD4 FOREIGN KEY (id_marca_id) REFERENCES marcas (id)');
        $this->addSql('ALTER TABLE productos ADD CONSTRAINT FK_767490E610560508 FOREIGN KEY (id_categoria_id) REFERENCES categorias (id)');
        $this->addSql('ALTER TABLE user ADD empresa VARCHAR(255) DEFAULT NULL, ADD telefono VARCHAR(50) NOT NULL, ADD nombre VARCHAR(255) NOT NULL, ADD cod_cliente VARCHAR(255) NOT NULL, ADD direccion VARCHAR(255) DEFAULT NULL, ADD provincia VARCHAR(255) DEFAULT NULL, ADD ciudad VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE productos DROP FOREIGN KEY FK_767490E610560508');
        $this->addSql('ALTER TABLE productos DROP FOREIGN KEY FK_767490E6D134ECD4');
        $this->addSql('DROP TABLE categorias');
        $this->addSql('DROP TABLE marcas');
        $this->addSql('DROP TABLE marcas');
        $this->addSql('DROP TABLE productos');
        $this->addSql('ALTER TABLE user DROP empresa, DROP telefono, DROP nombre, DROP cod_cliente, DROP direccion, DROP provincia, DROP ciudad');
    }
}
