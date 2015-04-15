<?php
namespace Uniwars\Controllers;

use Uniwars\Models\PlayerStage;
use Uniwars\Repositories\LevelRepository;
use Uniwars\Repositories\PlayerRepository;
use Uniwars\Repositories\UniversityRepository;

class StagesController extends
    GameController
{

   public function index()
   {
        $this->view->playerStages =
            array_filter($this->currentPlayer->getStages(), function(PlayerStage $s) {
               return $s->getUniversity()->getId()
                   == $this->currentUniversity->getId();
            });
   }

    public function increase()
    {
        /**
         * @var \Uniwars\Models\PlayerStage $stage
         */
        $stage = current(array_filter($this->currentPlayer->getStages(), function(PlayerStage $s) {
            return $s->getUniversity()->getId()
            == $this->currentUniversity->getId() &&
                $s->getStage()->getId() == $this->request->id;
        }));

        $currentLevelId = $stage->getLevel()->getLevelId();
        $nextLevel = LevelRepository::create()
            ->getOne($currentLevelId + 1, $stage->getStage()->getId());

        $moneyLeft = $this->currentUniversity->getMoney() - $nextLevel->getMoneyConsume();
        $lecturesLeft = $this->currentUniversity->getLecturues() - $nextLevel->getLecturesConsume();

        if ($moneyLeft >= 0 && $lecturesLeft >= 0) {
            $this->currentUniversity->setMoney($moneyLeft);
            $this->currentUniversity->setLecturues($lecturesLeft);
            $stage->setLevel($nextLevel);
            $stage->save();
            $this->currentUniversity->save();
        }
        $this->redirect('stages');
    }
}