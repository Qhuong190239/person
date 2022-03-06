<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220306165149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, name VARCHAR(30) NOT NULL, brand VARCHAR(15) NOT NULL, model INT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_773DE69D217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, company VARCHAR(50) NOT NULL, position VARCHAR(20) NOT NULL, salary DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, detail_id INT DEFAULT NULL, name VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_34DCD176D8D003BB (detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_job (person_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_789527E3217BBB47 (person_id), INDEX IDX_789527E3BE04EA9 (job_id), PRIMARY KEY(person_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_detail (id INT AUTO_INCREMENT NOT NULL, nationality VARCHAR(20) NOT NULL, address VARCHAR(50) NOT NULL, mobile VARCHAR(10) NOT NULL, birthday DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176D8D003BB FOREIGN KEY (detail_id) REFERENCES person_detail (id)');
        $this->addSql('ALTER TABLE person_job ADD CONSTRAINT FK_789527E3217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_job ADD CONSTRAINT FK_789527E3BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person_job DROP FOREIGN KEY FK_789527E3BE04EA9');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D217BBB47');
        $this->addSql('ALTER TABLE person_job DROP FOREIGN KEY FK_789527E3217BBB47');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176D8D003BB');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_job');
        $this->addSql('DROP TABLE person_detail');
    }
}
