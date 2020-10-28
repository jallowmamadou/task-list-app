<?php

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class TaskTableMigration extends AbstractMigration
{

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `tasks` (
                `id`          INTEGER PRIMARY KEY AUTOINCREMENT,
                `title`       varchar(255),
                `description` text NULL,
                `status`      varchar(255) NULL DEFAULT 'PENDING',
                `due_date`    datetime NULL,
                `created_at`  DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
    }
}
