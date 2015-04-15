<?php
namespace Uniwars\Repositories;

use Uniwars\Db;
use Uniwars\Models\Player;
use Uniwars\Models\PlayerStage;
use Uniwars\Models\Stage;
use Uniwars\Models\StageLevel;
use Uniwars\Models\University;

class PlayerRepository
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
     * @param $user
     * @param $pass
     * @return bool|Player
     */
    public function getOneByDetails($user, $pass)
    {
        $query = "SELECT id, username, password
        FROM players WHERE username = ? AND password = ?";

        $this->db->query($query,
            [
                $user,
                md5($pass)
            ]
        );

        $result = $this->db->row();

        if (empty($result)) return false;

        return $this->getOne($result['id']);
    }


    public function getOne($id)
    {
        $query = "SELECT id, username, password
        FROM players WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $player = new Player(
            $result['username'],
            $result['password'],
            $result['id']
        );

        $this->db->query("SELECT id, name, player_id, money, lectures
        FROM universities WHERE player_id = ?", [$id]);

        $univiersitiesResult = $this->db->fetchAll();

        $universities = [];

        foreach ($univiersitiesResult as $univerisityResult) {
            $universities[] = new University(
                $univerisityResult['id'],
                $univerisityResult['name'],
                $player,
                $univerisityResult['money'],
                $univerisityResult['lectures']
            );
        }

        $this->db->query("SELECT id, player_id, university_id, stage_id, level_id
        FROM player_stages WHERE player_id = ?", [$id]);
        $playerStagesResult = $this->db->fetchAll();
        $playerStagesCollection = [];
        foreach ($playerStagesResult as $playerStageResult) {
            $this->db->query("SELECT id, name FROM stages WHERE id = ?",
                [$playerStageResult['stage_id']]);
            $stageResult = $this->db->row();
            $stage = new Stage($stageResult['id'], $stageResult['name']);

            $stageLevelsCollection = [];

            $this->db->query("SELECT stage_id, level_id, money_consume, lectures_consume, money_income, lectures_income FROM stage_levels WHERE stage_id = ? AND level_id = ?",
                [$stage->getId(), $playerStageResult['level_id']]);

            $stageLevelsResult = $this->db->fetchAll();
            $university = current(array_filter($universities, function(University $u) use ($playerStageResult) {
                return $u->getId() == $playerStageResult['university_id'];
            }));
            foreach ($stageLevelsResult as $stageLevelResult) {
                $stageLevel = new StageLevel(
                    $stage,
                    $stageLevelResult['level_id'],
                    $stageLevelResult['money_consume'],
                    $stageLevelResult['lectures_consume'],
                    $stageLevelResult['money_income'],
                    $stageLevelResult['lectures_income']
                );
                $stageLevelsCollection[] = $stageLevel;
                $playerStagesCollection[] = new PlayerStage(
                    $player,
                    $stage,
                    $stageLevel,
                    $university
                );
            }
        }

        $player->setUniversities($universities);
        $player->setStages($playerStagesCollection);

        return $player;
    }

    /**
     * @return Player[]
     */
    public function getAll()
    {
        $query = "SELECT id, username, password
        FROM players";

        $this->db->query($query);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $collection[] = new Player(
                $row['username'],
                $row['password'],
                $row['id']
            );
        }

        return $collection;
    }

    public function save(Player $player)
    {
        $query = "
            INSERT INTO players (username, password)
            VALUES (?, ?)
        ";
        $params = [
            $player->getUsername(),
            $player->getPassword()
        ];

        if ($player->getId()) {
            $query = "UPDATE players SET username = ?, password = ? WHERE id = ?";
            $params[] = $player->getId();
        }

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }
}