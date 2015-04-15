<?php
namespace Uniwars\Controllers;

use Uniwars\Models\Player;
use Uniwars\Repositories\PlayerRepository;

class UsersController extends Controller
{
    public function login()
    {
        $this->view->error = false;
        $this->view->user = false;
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $player = PlayerRepository::create()->getOneByDetails(
                $username,
                $password
            );

            if (!$player) {
                $this->view->error = 'Invalid details';
                return;
            }

            $_SESSION['userid'] = $player->getId();
            $_SESSION['university_id'] = $player->getUniversities()[0]->getId();
            $this->view->user = $player->getUsername();
            $this->redirect('game');
        }
    }

    public function register()
    {
        $this->view->error = false;
        if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $player = new Player($username, $password);

            if (!$player->save()) {
                $this->view->error = 'duplicate users';
            }

            $this->login();
        }
    }

    public function logout()
    {
        session_destroy();
        die;
    }
}