<?php
namespace App\Model;

use App\Service\Config;

class Aktor
{
    private ?int $id = null;
    private ?string $nickname = null;
    private ?string $description = null;
    private string $videoUrl = '';

    public function getVideoUrl(): string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(string $videoUrl): Aktor
    {
        $this->videoUrl = $videoUrl;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nickname' => $this->getNickname(),
            'description' => $this->getDescription(),
            'video_url' => $this->getVideoUrl(),
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Aktor
    {
        $this->id = $id;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): Aktor
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Aktor
    {
        $this->description = $description;

        return $this;
    }

    public static function fromArray($array): Aktor
    {
        $aktor = new self();
        $aktor->fill($array);

        return $aktor;
    }

    public function fill($array): Aktor
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['nickname'])) {
            $this->setNickname($array['nickname']);
        }
        if (isset($array['video_url'])) {
            $this->setVideoUrl($array['video_url']);
        }
        if (isset($array['description'])) {
            $this->setDescription($array['description']);
        }

        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM aktor';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $aktorzy = [];
        $aktorzyArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($aktorzyArray as $aktorArray) {
            $aktorzy[] = self::fromArray($aktorArray);
        }

        return $aktorzy;
    }

    public static function find($id): ?Aktor
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM aktor WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $aktorArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $aktorArray) {
            return null;
        }
        $aktor = Aktor::fromArray($aktorArray);

        return $aktor;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getId()) {
            $sql = "INSERT INTO aktor (nickname, description, video_url) VALUES (:nickname, :description, :video_url)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'nickname' => $this->getNickname(),
                'description' => $this->getDescription(),
                'video_url' => $this->getVideoUrl(),
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE aktor SET nickname = :nickname, description = :description, video_url = :video_url WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':nickname' => $this->getNickname(),
                ':description' => $this->getDescription(),
                ':video_url' => $this->getVideoUrl(),
                ':id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM aktor WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setNickname(null);
        $this->setDescription(null);
        $this->setVideoUrl('');
    }
}
