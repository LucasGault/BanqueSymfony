<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220182314 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account_beneficiary DROP FOREIGN KEY FK_ABF8B8699D86650F');
        $this->addSql('DROP INDEX UNIQ_ABF8B8699D86650F ON account_beneficiary');
        $this->addSql('ALTER TABLE account_beneficiary CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE account_beneficiary ADD CONSTRAINT FK_ABF8B869A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ABF8B869A76ED395 ON account_beneficiary (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account_beneficiary DROP FOREIGN KEY FK_ABF8B869A76ED395');
        $this->addSql('DROP INDEX UNIQ_ABF8B869A76ED395 ON account_beneficiary');
        $this->addSql('ALTER TABLE account_beneficiary CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE account_beneficiary ADD CONSTRAINT FK_ABF8B8699D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ABF8B8699D86650F ON account_beneficiary (user_id_id)');
    }
}
