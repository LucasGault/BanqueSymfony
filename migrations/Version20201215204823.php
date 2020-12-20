<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201215204823 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_account');
        $this->addSql('ALTER TABLE bank_account ADD user_of_account_id INT NOT NULL');
        $this->addSql('ALTER TABLE bank_account ADD CONSTRAINT FK_53A23E0A9CB1337F FOREIGN KEY (user_of_account_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_53A23E0A9CB1337F ON bank_account (user_of_account_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_account (id INT AUTO_INCREMENT NOT NULL, account_owner_id INT NOT NULL, account_of_user_id INT NOT NULL, INDEX IDX_253B48AE6F2834F (account_owner_id), UNIQUE INDEX UNIQ_253B48AEA680D080 (account_of_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AE6F2834F FOREIGN KEY (account_owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AEA680D080 FOREIGN KEY (account_of_user_id) REFERENCES bank_account (id)');
        $this->addSql('ALTER TABLE bank_account DROP FOREIGN KEY FK_53A23E0A9CB1337F');
        $this->addSql('DROP INDEX IDX_53A23E0A9CB1337F ON bank_account');
        $this->addSql('ALTER TABLE bank_account DROP user_of_account_id');
    }
}
