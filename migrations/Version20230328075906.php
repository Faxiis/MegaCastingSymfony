<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328075906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE UserOffer (IdentifierOffer INT NOT NULL, IdentifierUser INT NOT NULL, PRIMARY KEY (IdentifierOffer, IdentifierUser))');
        $this->addSql('CREATE INDEX IDX_4D42164B1E116446 ON UserOffer (IdentifierOffer)');
        $this->addSql('CREATE INDEX IDX_4D42164B924B5EA2 ON UserOffer (IdentifierUser)');
        $this->addSql('ALTER TABLE UserOffer ADD CONSTRAINT FK_4D42164B1E116446 FOREIGN KEY (IdentifierOffer) REFERENCES [User] (id)');
        $this->addSql('ALTER TABLE UserOffer ADD CONSTRAINT FK_4D42164B924B5EA2 FOREIGN KEY (IdentifierUser) REFERENCES Offers (Identifier)');
        $this->addSql('ALTER TABLE [user] ALTER COLUMN roles VARCHAR(MAX) NOT NULL');
        $this->addSql('ALTER TABLE [user] ALTER COLUMN FirstName NVARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE [user] ALTER COLUMN LastName NVARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE [user] ALTER COLUMN Phone NVARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE [user] ALTER COLUMN Country NVARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE [user] ALTER COLUMN City NVARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE [user] ALTER COLUMN Address NVARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE [user] ALTER COLUMN AddressZipCode NVARCHAR(255) NOT NULL');
        $this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:json)\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'user\', N\'COLUMN\', roles');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('ALTER TABLE UserOffer DROP CONSTRAINT FK_4D42164B1E116446');
        $this->addSql('ALTER TABLE UserOffer DROP CONSTRAINT FK_4D42164B924B5EA2');
        $this->addSql('DROP TABLE UserOffer');
        $this->addSql('ALTER TABLE [User] ALTER COLUMN roles VARCHAR(MAX)');
        $this->addSql('ALTER TABLE [User] ALTER COLUMN FirstName NVARCHAR(255)');
        $this->addSql('ALTER TABLE [User] ALTER COLUMN LastName NVARCHAR(255)');
        $this->addSql('ALTER TABLE [User] ALTER COLUMN Phone NVARCHAR(255)');
        $this->addSql('ALTER TABLE [User] ALTER COLUMN Country NVARCHAR(255)');
        $this->addSql('ALTER TABLE [User] ALTER COLUMN City NVARCHAR(255)');
        $this->addSql('ALTER TABLE [User] ALTER COLUMN Address NVARCHAR(255)');
        $this->addSql('ALTER TABLE [User] ALTER COLUMN AddressZipCode NVARCHAR(255)');
        $this->addSql('EXEC sp_dropextendedproperty N\'MS_Description\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'User\', N\'COLUMN\', roles');
    }
}
