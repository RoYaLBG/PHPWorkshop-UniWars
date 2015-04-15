<?php
namespace Uniwars\Controllers;

use Uniwars\Repositories\PlayerRepository;
use Uniwars\Repositories\UniversityRepository;

class GameController extends Controller
{
    /**
     * @var \Uniwars\Models\Player
     */
    protected $currentPlayer = null;
    /**
     * @var \Uniwars\Models\University
     */
    protected $currentUniversity = null;

    protected function onLoad()
    {
        if (!isset($_SESSION['userid'])) {
            $this->redirect('users', 'login');
        }

        if ($this->currentPlayer == null) {
            $this->currentPlayer =
                PlayerRepository::create()
                ->getOne($_SESSION['userid']);
        }

        if ($this->currentUniversity == null) {
            $this->currentUniversity =
                UniversityRepository::create()
                ->getOne($_SESSION['university_id']);
        }

        $this->view->playerName = $this->currentPlayer->getUsername();
        $this->view->university = $this->currentUniversity;
        $this->view->partial('authHeader');
    }

    public function index()
    {
        $this->view->universities =
            $this->currentPlayer->getUniversities();
    }
}