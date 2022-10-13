<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221012124427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF334ACC9A20');
        $this->addSql('DROP INDEX UNIQ_B723AF334ACC9A20 ON student');
        $this->addSql('ALTER TABLE student DROP card_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student ADD card_id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF334ACC9A20 FOREIGN KEY (card_id) REFERENCES student_card (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF334ACC9A20 ON student (card_id)');
    }
}
