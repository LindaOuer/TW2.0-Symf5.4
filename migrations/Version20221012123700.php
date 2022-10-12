<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221012123700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B723AF334ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_club (student_id INT NOT NULL, club_id INT NOT NULL, INDEX IDX_87CD43AACB944F1A (student_id), INDEX IDX_87CD43AA61190A32 (club_id), PRIMARY KEY(student_id, club_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_card (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF334ACC9A20 FOREIGN KEY (card_id) REFERENCES student_card (id)');
        $this->addSql('ALTER TABLE student_club ADD CONSTRAINT FK_87CD43AACB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_club ADD CONSTRAINT FK_87CD43AA61190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF334ACC9A20');
        $this->addSql('ALTER TABLE student_club DROP FOREIGN KEY FK_87CD43AACB944F1A');
        $this->addSql('ALTER TABLE student_club DROP FOREIGN KEY FK_87CD43AA61190A32');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE student_club');
        $this->addSql('DROP TABLE student_card');
    }
}
