<?php
namespace Uniwars\Repositories;

use Uniwars\Db;
use Uniwars\Models\Player;
use Uniwars\Models\University;

class UniversityRepository
{
    /**
     * @var \Uniwars\Db
     */
    private $db;

    /**
     * @var PlayerRepository
     */
    private static $inst = null;

    private function __construct(\UniWars\Db $db)
    {
        $this->db = $db;
    }

    /**
     * @return PlayerRepository
     */
    public static function create()
    {
        if (self::$inst == null)
        {
            self::$inst = new self(Db::getInstance());
        }

        return self::$inst;
    }

    /**
     * @param $id
     * @return bool|University
     */
    public function getOne($id)
    {
        $query = "SELECT id, name, player_id, money, lectures
        FROM universities WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $player = PlayerRepository::create()
            ->getOne($result['player_id']);

        $university = new University(
            $result['id'],
            $result['name'],
            $player,
            $result['money'],
            $result['lectures']
        );

        return $university;
    }

    /**
     * @return University[]
     */
    public function getAll()
    {
        $query = "SELECT id, name, player_id, money, lectures
        FROM universities";

        $this->db->query($query);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row) {
            $player = PlayerRepository::create()
                ->getOne($row['player_id']);

            $collection[] = new University(
                $row['id'],
                $row['name'],
                $player,
                $row['money'],
                $row['lectures']
            );
        }

        return $collection;
    }

    public function save(University $university)
    {
        $query = "
            INSERT INTO universities
            (name, player_id, money, lectures)
            VALUES (?, ?, ?, ?)
        ";

        $params = [
            $university->getName(),
            $university->getPlayer()->getId(),
            $university->getMoney(),
            $university->getLecturues()
        ];

        if ($university->getId()) {
           $query = "UPDATE universities SET
           name = ?, player_id = ?, money = ?, lectures = ?
           WHERE id = ?
           ";
            $params[] = $university->getId();
        }

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }
}