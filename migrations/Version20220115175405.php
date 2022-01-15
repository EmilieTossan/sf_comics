<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220115175405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comics ADD licence_id INT DEFAULT NULL, ADD editor_id INT DEFAULT NULL, ADD writer_id INT DEFAULT NULL, ADD designer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comics ADD CONSTRAINT FK_2D56FB5826EF07C9 FOREIGN KEY (licence_id) REFERENCES licence (id)');
        $this->addSql('ALTER TABLE comics ADD CONSTRAINT FK_2D56FB586995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)');
        $this->addSql('ALTER TABLE comics ADD CONSTRAINT FK_2D56FB581BC7E6B6 FOREIGN KEY (writer_id) REFERENCES writer (id)');
        $this->addSql('ALTER TABLE comics ADD CONSTRAINT FK_2D56FB58CFC54FAB FOREIGN KEY (designer_id) REFERENCES designer (id)');
        $this->addSql('CREATE INDEX IDX_2D56FB5826EF07C9 ON comics (licence_id)');
        $this->addSql('CREATE INDEX IDX_2D56FB586995AC4C ON comics (editor_id)');
        $this->addSql('CREATE INDEX IDX_2D56FB581BC7E6B6 ON comics (writer_id)');
        $this->addSql('CREATE INDEX IDX_2D56FB58CFC54FAB ON comics (designer_id)');
        $this->addSql('ALTER TABLE image ADD comics_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F71AE76A2 FOREIGN KEY (comics_id) REFERENCES comics (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F71AE76A2 ON image (comics_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE comics DROP FOREIGN KEY FK_2D56FB5826EF07C9');
        $this->addSql('ALTER TABLE comics DROP FOREIGN KEY FK_2D56FB586995AC4C');
        $this->addSql('ALTER TABLE comics DROP FOREIGN KEY FK_2D56FB581BC7E6B6');
        $this->addSql('ALTER TABLE comics DROP FOREIGN KEY FK_2D56FB58CFC54FAB');
        $this->addSql('DROP INDEX IDX_2D56FB5826EF07C9 ON comics');
        $this->addSql('DROP INDEX IDX_2D56FB586995AC4C ON comics');
        $this->addSql('DROP INDEX IDX_2D56FB581BC7E6B6 ON comics');
        $this->addSql('DROP INDEX IDX_2D56FB58CFC54FAB ON comics');
        $this->addSql('ALTER TABLE comics DROP licence_id, DROP editor_id, DROP writer_id, DROP designer_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F71AE76A2');
        $this->addSql('DROP INDEX IDX_C53D045F71AE76A2 ON image');
        $this->addSql('ALTER TABLE image DROP comics_id');
    }
}
