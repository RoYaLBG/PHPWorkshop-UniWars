<?php
namespace Uniwars\Repositories;

use Uniwars\Db;
use Uniwars\Models\Player;
use Uniwars\Models\PlayerStage;
use Uniwars\Models\Stage;
use Uniwars\Models\StageLevel;
use Uniwars\Models\University;

class StageRepository
{
    /**
     * @var \Uniwars\Db
     */
    private $db;

    /**
     * @var StageRepository
     */
    private static $inst = null;

    private function __construct(\UniWars\Db $db)
    {
        $this->db = $db;
    }

    /**
     * @return StageRepository
     */
    public static function create()
    {
        if (self::$inst == null)
        {
            self::$inst = new self(Db::getInstance());
        }

        return self::$inst;
    }

    public function save(PlayerStage $stage)
    {
        $query = "UPDATE player_stages SET
        level_id = ? WHERE level_id = ? AND stage_id = ? AND player_id = ? AND university_id = ?";
        $params = [
            $stage->getLevel()->getLevelId(),
            $stage->getLevel()->getLevelId() - 1,
            $stage->getStage()->getId(),
            $stage->getPlayer()->getId(),
            $stage->getUniversity()->getId()
        ];

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }

}