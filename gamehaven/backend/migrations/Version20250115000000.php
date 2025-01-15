<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250115000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new fields to entities for enhanced functionality';
    }

    public function up(Schema $schema): void
    {
        // User table updates
        $this->addSql('ALTER TABLE user ADD is_active TINYINT(1) NOT NULL DEFAULT 1');

        // Image table updates
        $this->addSql('ALTER TABLE image ADD type VARCHAR(50) NOT NULL DEFAULT "main"');
        $this->addSql('ALTER TABLE image ADD position INT NOT NULL DEFAULT 0');

        // Review table updates
        $this->addSql('ALTER TABLE review ADD is_verified TINYINT(1) NOT NULL DEFAULT 0');
        $this->addSql('ALTER TABLE review ADD is_flagged TINYINT(1) NOT NULL DEFAULT 0');

        // Transaction table updates
        $this->addSql('ALTER TABLE transaction ADD payment_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD payment_method VARCHAR(50) NOT NULL DEFAULT "pending"');

        // GameListing table updates
        $this->addSql('ALTER TABLE game_listing ADD price_history JSON DEFAULT NULL');

        // Wishlist table updates
        $this->addSql('ALTER TABLE wishlist ADD max_price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE wishlist ADD notify_on_price_change TINYINT(1) NOT NULL DEFAULT 1');
    }

    public function down(Schema $schema): void
    {
        // User table rollback
        $this->addSql('ALTER TABLE user DROP is_active');

        // Image table rollback
        $this->addSql('ALTER TABLE image DROP type');
        $this->addSql('ALTER TABLE image DROP position');

        // Review table rollback
        $this->addSql('ALTER TABLE review DROP is_verified');
        $this->addSql('ALTER TABLE review DROP is_flagged');

        // Transaction table rollback
        $this->addSql('ALTER TABLE transaction DROP payment_id');
        $this->addSql('ALTER TABLE transaction DROP payment_method');

        // GameListing table rollback
        $this->addSql('ALTER TABLE game_listing DROP price_history');

        // Wishlist table rollback
        $this->addSql('ALTER TABLE wishlist DROP max_price');
        $this->addSql('ALTER TABLE wishlist DROP notify_on_price_change');
    }
}
