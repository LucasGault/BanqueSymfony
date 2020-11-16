<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201115101917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction ADD credit_account_id INT NOT NULL, ADD debit_account_id INT NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D16813E404 FOREIGN KEY (credit_account_id) REFERENCES bank_account (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1204C4EAA FOREIGN KEY (debit_account_id) REFERENCES bank_account (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_723705D16813E404 ON transaction (credit_account_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_723705D1204C4EAA ON transaction (debit_account_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D16813E404');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1204C4EAA');
        $this->addSql('DROP INDEX UNIQ_723705D16813E404 ON transaction');
        $this->addSql('DROP INDEX UNIQ_723705D1204C4EAA ON transaction');
        $this->addSql('ALTER TABLE transaction DROP credit_account_id, DROP debit_account_id');
    }
}
