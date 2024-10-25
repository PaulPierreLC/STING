<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025124812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE programmation (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album ADD le_groupe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E43A35D217B FOREIGN KEY (le_groupe_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_39986E43A35D217B ON album (le_groupe_id)');
        $this->addSql('ALTER TABLE festival ADD les_programmations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE festival ADD CONSTRAINT FK_57CF789FFB50D63 FOREIGN KEY (les_programmations_id) REFERENCES programmation (id)');
        $this->addSql('CREATE INDEX IDX_57CF789FFB50D63 ON festival (les_programmations_id)');
        $this->addSql('ALTER TABLE groupe ADD les_programmations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21FFB50D63 FOREIGN KEY (les_programmations_id) REFERENCES programmation (id)');
        $this->addSql('CREATE INDEX IDX_4B98C21FFB50D63 ON groupe (les_programmations_id)');
        $this->addSql('ALTER TABLE titre ADD le_album_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE titre ADD CONSTRAINT FK_FF7747B4DF798026 FOREIGN KEY (le_album_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_FF7747B4DF798026 ON titre (le_album_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE festival DROP FOREIGN KEY FK_57CF789FFB50D63');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21FFB50D63');
        $this->addSql('DROP TABLE programmation');
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E43A35D217B');
        $this->addSql('DROP INDEX IDX_39986E43A35D217B ON album');
        $this->addSql('ALTER TABLE album DROP le_groupe_id');
        $this->addSql('DROP INDEX IDX_57CF789FFB50D63 ON festival');
        $this->addSql('ALTER TABLE festival DROP les_programmations_id');
        $this->addSql('DROP INDEX IDX_4B98C21FFB50D63 ON groupe');
        $this->addSql('ALTER TABLE groupe DROP les_programmations_id');
        $this->addSql('ALTER TABLE titre DROP FOREIGN KEY FK_FF7747B4DF798026');
        $this->addSql('DROP INDEX IDX_FF7747B4DF798026 ON titre');
        $this->addSql('ALTER TABLE titre DROP le_album_id');
    }
}
