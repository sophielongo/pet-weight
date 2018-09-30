<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180923072458 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_pet (user_id INT NOT NULL, pet_id INT NOT NULL, INDEX IDX_F44FA0EA76ED395 (user_id), INDEX IDX_F44FA0E966F7FB6 (pet_id), PRIMARY KEY(user_id, pet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weight (id INT AUTO_INCREMENT NOT NULL, pet_id INT NOT NULL, value INT NOT NULL, measuring_unit VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_7CD5541966F7FB6 (pet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birthdate DATETIME NOT NULL, gender VARCHAR(7) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_pet ADD CONSTRAINT FK_F44FA0EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_pet ADD CONSTRAINT FK_F44FA0E966F7FB6 FOREIGN KEY (pet_id) REFERENCES pet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE weight ADD CONSTRAINT FK_7CD5541966F7FB6 FOREIGN KEY (pet_id) REFERENCES pet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_pet DROP FOREIGN KEY FK_F44FA0EA76ED395');
        $this->addSql('ALTER TABLE user_pet DROP FOREIGN KEY FK_F44FA0E966F7FB6');
        $this->addSql('ALTER TABLE weight DROP FOREIGN KEY FK_7CD5541966F7FB6');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_pet');
        $this->addSql('DROP TABLE weight');
        $this->addSql('DROP TABLE pet');
    }
}
