<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327115414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE [user] ADD FirstName NVARCHAR(255) NULL');
        $this->addSql('ALTER TABLE [user] ADD LastName NVARCHAR(255) NULL');
        $this->addSql('ALTER TABLE [user] ADD Phone NVARCHAR(255) NULL');
        $this->addSql('ALTER TABLE [user] ADD Country NVARCHAR(255) NULL');
        $this->addSql('ALTER TABLE [user] ADD City NVARCHAR(255) NULL');
        $this->addSql('ALTER TABLE [user] ADD Address NVARCHAR(255) NULL');
        $this->addSql('ALTER TABLE [user] ADD AddressZipCode NVARCHAR(255) NULL');
        $this->addSql('ALTER TABLE [user] ALTER COLUMN roles VARCHAR(MAX) NULL');
        //$this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:json)\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'user\', N\'COLUMN\', roles');
        $this->addSql('EXEC sp_rename N\'[user].uniq_8d93d649e7927c74\', N\'UNIQ_2DA1797726535370\', N\'INDEX\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE [User] DROP COLUMN FirstName');
        $this->addSql('ALTER TABLE [User] DROP COLUMN LastName');
        $this->addSql('ALTER TABLE [User] DROP COLUMN Phone');
        $this->addSql('ALTER TABLE [User] DROP COLUMN Country');
        $this->addSql('ALTER TABLE [User] DROP COLUMN City');
        $this->addSql('ALTER TABLE [User] DROP COLUMN Address');
        $this->addSql('ALTER TABLE [User] DROP COLUMN AddressZipCode');
        $this->addSql('ALTER TABLE [User] ALTER COLUMN roles VARCHAR(MAX) NOT NULL');
        $this->addSql('EXEC sp_dropextendedproperty N\'MS_Description\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'User\', N\'COLUMN\', roles');
        $this->addSql('EXEC sp_rename N\'[User].uniq_2da1797726535370\', N\'UNIQ_8D93D649E7927C74\', N\'INDEX\'');
    }
}
