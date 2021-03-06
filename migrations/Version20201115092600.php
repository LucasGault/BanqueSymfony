<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201115092600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_account (id INT AUTO_INCREMENT NOT NULL, account_owner_id INT NOT NULL, account_of_user_id INT NOT NULL, INDEX IDX_253B48AE6F2834F (account_owner_id), UNIQUE INDEX UNIQ_253B48AEA680D080 (account_of_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AE6F2834F FOREIGN KEY (account_owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AEA680D080 FOREIGN KEY (account_of_user_id) REFERENCES bank_account (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_account');
    }
}
