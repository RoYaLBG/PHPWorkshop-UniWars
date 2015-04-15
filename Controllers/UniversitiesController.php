<?php
namespace Uniwars\Controllers;

use Uniwars\Repositories\PlayerRepository;
use Uniwars\Repositories\UniversityRepository;

class UniversitiesController extends
    GameController
{

    public function change()
    {
        $hasUniversity = false;
        foreach (
            $this->currentPlayer->getUniversities() as $university) {
            if ($university->getId()
                == $this->request->id
            ) {
                $hasUniversity = true;
                break;
            }
        }

        if (!$hasUniversity) {
            $this->redirect('game');
        }

        $_SESSION['university_id'] = $this->request->id;
        $this->redirect('game');
    }
}