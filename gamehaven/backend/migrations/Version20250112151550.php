<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250112151550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_listing (id INT AUTO_INCREMENT NOT NULL, seller_id INT NOT NULL, title VARCHAR(255) NOT NULL, platform VARCHAR(50) NOT NULL, `condition` VARCHAR(50) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, status VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5EC237FB8DE820D9 (seller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, game_listing_id INT NOT NULL, image_url VARCHAR(255) NOT NULL, INDEX IDX_C53D045F3ABD5AF7 (game_listing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, reviewer_id INT NOT NULL, seller_id INT NOT NULL, rating INT NOT NULL, comment LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_794381C670574616 (reviewer_id), INDEX IDX_794381C68DE820D9 (seller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, buyer_id INT NOT NULL, seller_id INT NOT NULL, game_listing_id INT NOT NULL, status VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_723705D16C755722 (buyer_id), INDEX IDX_723705D18DE820D9 (seller_id), INDEX IDX_723705D13ABD5AF7 (game_listing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, avatar_url VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wishlist (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, game_listing_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9CE12A31A76ED395 (user_id), INDEX IDX_9CE12A313ABD5AF7 (game_listing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_listing ADD CONSTRAINT FK_5EC237FB8DE820D9 FOREIGN KEY (seller_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F3ABD5AF7 FOREIGN KEY (game_listing_id) REFERENCES game_listing (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C670574616 FOREIGN KEY (reviewer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C68DE820D9 FOREIGN KEY (seller_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D16C755722 FOREIGN KEY (buyer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D18DE820D9 FOREIGN KEY (seller_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D13ABD5AF7 FOREIGN KEY (game_listing_id) REFERENCES game_listing (id)');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A31A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A313ABD5AF7 FOREIGN KEY (game_listing_id) REFERENCES game_listing (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_listing DROP FOREIGN KEY FK_5EC237FB8DE820D9');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F3ABD5AF7');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C670574616');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C68DE820D9');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D16C755722');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D18DE820D9');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D13ABD5AF7');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A31A76ED395');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A313ABD5AF7');
        $this->addSql('DROP TABLE game_listing');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE wishlist');
    }
}
