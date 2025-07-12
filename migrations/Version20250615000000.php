<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250615000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Move sanitary stats from zone to surveillance_point';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE surveillance_point ADD population INT NOT NULL');
        $this->addSql('ALTER TABLE surveillance_point ADD symptomatic INT NOT NULL');
        $this->addSql('ALTER TABLE surveillance_point ADD positive INT NOT NULL');
        $this->addSql('ALTER TABLE zone DROP population');
        $this->addSql('ALTER TABLE zone DROP symptomatic');
        $this->addSql('ALTER TABLE zone DROP positive');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE zone ADD population INT NOT NULL');
        $this->addSql('ALTER TABLE zone ADD symptomatic INT NOT NULL');
        $this->addSql('ALTER TABLE zone ADD positive INT NOT NULL');
        $this->addSql('ALTER TABLE surveillance_point DROP population');
        $this->addSql('ALTER TABLE surveillance_point DROP symptomatic');
        $this->addSql('ALTER TABLE surveillance_point DROP positive');
    }
}
