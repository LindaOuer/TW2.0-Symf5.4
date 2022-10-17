<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221012161126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student_club DROP FOREIGN KEY FK_87CD43AA61190A32');
        $this->addSql('ALTER TABLE student_club ADD CONSTRAINT FK_87CD43AA61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student_club DROP FOREIGN KEY FK_87CD43AA61190A32');
        $this->addSql('ALTER TABLE student_club ADD CONSTRAINT FK_87CD43AA61190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
    }
}
