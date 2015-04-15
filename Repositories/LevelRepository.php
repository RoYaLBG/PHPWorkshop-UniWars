<?php
namespace Uniwars\Repositories;

use Uniwars\Db;
use Uniwars\Models\Player;
use Uniwars\Models\Stage;
use Uniwars\Models\StageLevel;
use Uniwars\Models\University;

class LevelRepository
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
     * @return LevelRepository
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
     * @param $levelId
     * @param $stageId
     * @return bool|StageLevel
     */
    public function getOne($levelId, $stageId)
    {
        $query = "SELECT stage_id, level_id, money_consume, lectures_consume, money_income, lectures_income FROM stage_levels WHERE level_id = ? AND stage_id = ?";
        $this->db->query($query, [$levelId, $stageId]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $this->db->query("SELECT id, name FROM stages WHERE id = ?", [$stageId]);
        $stageResult = $this->db->row();
        $stage = new Stage($stageResult['id'], $stageResult['name']);

        $stageLevel = new StageLevel(
            $stage,
            $result['level_id'],
            $result['money_consume'],
            $result['lectures_consume'],
            $result['money_income'],
            $result['lectures_income']
        );

        return $stageLevel;
    }


}