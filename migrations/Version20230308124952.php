<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308124952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Activity (Identifier INT IDENTITY NOT NULL, Name NVARCHAR(255) NOT NULL, IdentifierActivityDomain INT NOT NULL, PRIMARY KEY (Identifier))');
        $this->addSql('CREATE INDEX IDX_55026B0C62DE144D ON Activity (IdentifierActivityDomain)');
        $this->addSql('CREATE TABLE ActivityOffer (IdentifierOffer INT NOT NULL, IdentifierActivity INT NOT NULL, PRIMARY KEY (IdentifierOffer, IdentifierActivity))');
        $this->addSql('CREATE INDEX IDX_58848461E116446 ON ActivityOffer (IdentifierOffer)');
        $this->addSql('CREATE INDEX IDX_588484686C5C7B9 ON ActivityOffer (IdentifierActivity)');
        $this->addSql('CREATE TABLE ActivityDomain (Identifier INT IDENTITY NOT NULL, Name NVARCHAR(255) NOT NULL, Description NVARCHAR(3000) NOT NULL, PRIMARY KEY (Identifier))');
        $this->addSql('CREATE TABLE Advice (Identifier INT IDENTITY NOT NULL, Label NVARCHAR(255) NOT NULL, Content VARCHAR(MAX) NOT NULL, PRIMARY KEY (Identifier))');
        $this->addSql('CREATE TABLE Civility (Identifier INT IDENTITY NOT NULL, ShortLabel NVARCHAR(255) NOT NULL, Longlabel NVARCHAR(255) NOT NULL, PRIMARY KEY (Identifier))');
        $this->addSql('CREATE TABLE CivilityOffer (IdentifierOffer INT NOT NULL, IdentifierCivility INT NOT NULL, PRIMARY KEY (IdentifierOffer, IdentifierCivility))');
        $this->addSql('CREATE INDEX IDX_EE6164421E116446 ON CivilityOffer (IdentifierOffer)');
        $this->addSql('CREATE INDEX IDX_EE61644212FC897A ON CivilityOffer (IdentifierCivility)');
        $this->addSql('CREATE TABLE Client (Identifier INT IDENTITY NOT NULL, FirstName NVARCHAR(255) NOT NULL, LastName NVARCHAR(255) NOT NULL, City NVARCHAR(255) NOT NULL, Address NVARCHAR(255) NOT NULL, AddressZipCode NVARCHAR(255) NOT NULL, Email NVARCHAR(255) NOT NULL, Phone NVARCHAR(255) NOT NULL, PRIMARY KEY (Identifier))');
        $this->addSql('CREATE TABLE ContractType (Identifier INT IDENTITY NOT NULL, Label NVARCHAR(255) NOT NULL, ShortLabel NVARCHAR(255) NOT NULL, PRIMARY KEY (Identifier))');
        $this->addSql('CREATE TABLE DiffusionPartner (Identifier INT IDENTITY NOT NULL, Name NVARCHAR(255) NOT NULL, PRIMARY KEY (Identifier))');
        $this->addSql('CREATE TABLE Interview (Identifier INT IDENTITY NOT NULL, Label NVARCHAR(255) NOT NULL, Url NVARCHAR(500) NOT NULL, PRIMARY KEY (Identifier))');
        $this->addSql('CREATE TABLE Offers (Identifier INT IDENTITY NOT NULL, Label NVARCHAR(255) NOT NULL, Reference NVARCHAR(255) NOT NULL, Description NVARCHAR(3000) NOT NULL, ParutionDateTime DATETIME2(6) NOT NULL, OfferStartDate DATETIME2(6) NOT NULL, OfferEndDate DATETIME2(6) NOT NULL, Localisation NVARCHAR(255) NOT NULL, IdentifierContractType INT NOT NULL, IdentifierClient INT NOT NULL, PRIMARY KEY (Identifier))');
        $this->addSql('CREATE INDEX IDX_DDEA0111B0E4728C ON Offers (IdentifierContractType)');
        $this->addSql('CREATE INDEX IDX_DDEA011199AD3AB8 ON Offers (IdentifierClient)');
        $this->addSql('CREATE TABLE Pack (Identifier INT IDENTITY NOT NULL, Label NVARCHAR(255) NOT NULL, OffersNumber INT NOT NULL, Price DOUBLE PRECISION NOT NULL, PRIMARY KEY (Identifier))');
        $this->addSql('CREATE TABLE PackClient (IdentifierClient INT NOT NULL, IdentifierPack INT NOT NULL, PRIMARY KEY (IdentifierClient, IdentifierPack))');
        $this->addSql('CREATE INDEX IDX_B779645E99AD3AB8 ON PackClient (IdentifierClient)');
        $this->addSql('CREATE INDEX IDX_B779645E8806D6C8 ON PackClient (IdentifierPack)');
        $this->addSql('ALTER TABLE Activity ADD CONSTRAINT FK_55026B0C62DE144D FOREIGN KEY (IdentifierActivityDomain) REFERENCES ActivityDomain (Identifier)');
        $this->addSql('ALTER TABLE ActivityOffer ADD CONSTRAINT FK_58848461E116446 FOREIGN KEY (IdentifierOffer) REFERENCES Activity (Identifier)');
        $this->addSql('ALTER TABLE ActivityOffer ADD CONSTRAINT FK_588484686C5C7B9 FOREIGN KEY (IdentifierActivity) REFERENCES Offers (Identifier)');
        $this->addSql('ALTER TABLE CivilityOffer ADD CONSTRAINT FK_EE6164421E116446 FOREIGN KEY (IdentifierOffer) REFERENCES Civility (Identifier)');
        $this->addSql('ALTER TABLE CivilityOffer ADD CONSTRAINT FK_EE61644212FC897A FOREIGN KEY (IdentifierCivility) REFERENCES Offers (Identifier)');
        $this->addSql('ALTER TABLE Offers ADD CONSTRAINT FK_DDEA0111B0E4728C FOREIGN KEY (IdentifierContractType) REFERENCES ContractType (Identifier)');
        $this->addSql('ALTER TABLE Offers ADD CONSTRAINT FK_DDEA011199AD3AB8 FOREIGN KEY (IdentifierClient) REFERENCES Client (Identifier)');
        $this->addSql('ALTER TABLE PackClient ADD CONSTRAINT FK_B779645E99AD3AB8 FOREIGN KEY (IdentifierClient) REFERENCES Pack (Identifier)');
        $this->addSql('ALTER TABLE PackClient ADD CONSTRAINT FK_B779645E8806D6C8 FOREIGN KEY (IdentifierPack) REFERENCES Client (Identifier)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Activity DROP CONSTRAINT FK_55026B0C62DE144D');
        $this->addSql('ALTER TABLE ActivityOffer DROP CONSTRAINT FK_58848461E116446');
        $this->addSql('ALTER TABLE ActivityOffer DROP CONSTRAINT FK_588484686C5C7B9');
        $this->addSql('ALTER TABLE CivilityOffer DROP CONSTRAINT FK_EE6164421E116446');
        $this->addSql('ALTER TABLE CivilityOffer DROP CONSTRAINT FK_EE61644212FC897A');
        $this->addSql('ALTER TABLE Offers DROP CONSTRAINT FK_DDEA0111B0E4728C');
        $this->addSql('ALTER TABLE Offers DROP CONSTRAINT FK_DDEA011199AD3AB8');
        $this->addSql('ALTER TABLE PackClient DROP CONSTRAINT FK_B779645E99AD3AB8');
        $this->addSql('ALTER TABLE PackClient DROP CONSTRAINT FK_B779645E8806D6C8');
        $this->addSql('DROP TABLE Activity');
        $this->addSql('DROP TABLE ActivityOffer');
        $this->addSql('DROP TABLE ActivityDomain');
        $this->addSql('DROP TABLE Advice');
        $this->addSql('DROP TABLE Civility');
        $this->addSql('DROP TABLE CivilityOffer');
        $this->addSql('DROP TABLE Client');
        $this->addSql('DROP TABLE ContractType');
        $this->addSql('DROP TABLE DiffusionPartner');
        $this->addSql('DROP TABLE Interview');
        $this->addSql('DROP TABLE Offers');
        $this->addSql('DROP TABLE Pack');
        $this->addSql('DROP TABLE PackClient');
    }
}
