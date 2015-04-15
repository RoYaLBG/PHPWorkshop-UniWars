<?php
namespace Uniwars\Models;

class StageLevel
{
    /**
     * @var Stage
     */
    private $stage;

    private $levelId;

    private $moneyConsume;

    private $lecturesConsume;

    private $moneyIncome;

    private $lecturesIncome;

    public function __construct(
        Stage $stage,
        $levelId,
        $moneyConsume,
        $lecturesConsume,
        $moneyIncome,
        $lecturesIncome
    )
    {
        $this->stage = $stage;
        $this->levelId = $levelId;
        $this->moneyConsume = $moneyConsume;
        $this->lecturesConsume = $lecturesConsume;
        $this->moneyIncome = $moneyIncome;
        $this->lecturesIncome = $lecturesIncome;
    }

    /**
     * @return Stage
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * @return mixed
     */
    public function getLevelId()
    {
        return $this->levelId;
    }

    /**
     * @return mixed
     */
    public function getMoneyConsume()
    {
        return $this->moneyConsume;
    }

    /**
     * @return mixed
     */
    public function getLecturesConsume()
    {
        return $this->lecturesConsume;
    }

    /**
     * @return mixed
     */
    public function getMoneyIncome()
    {
        return $this->moneyIncome;
    }

    /**
     * @return mixed
     */
    public function getLecturesIncome()
    {
        return $this->lecturesIncome;
    }
}