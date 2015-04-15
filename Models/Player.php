<?php
namespace Uniwars\Models;

use Uniwars\Repositories\PlayerRepository;

class Player
{
    private $id;

    private $username;

    private $password;

    /**
     * @var University[];
     */
    private $universities;

    /**
     * @var PlayerStage[]
     */
    private $stages;


    public function __construct($username, $password, $id = null)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setId($id);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    /**
     * @return University[]
     */
    public function getUniversities()
    {
        return $this->universities;
    }

    /**
     * @param University[] $universities
     */
    public function setUniversities($universities)
    {
        $this->universities = $universities;
    }

    /**
     * @return PlayerStage[]
     */
    public function getStages()
    {
        return $this->stages;
    }

    /**
     * @param PlayerStage[] $stages
     */
    public function setStages($stages)
    {
        $this->stages = $stages;
    }

    public function save()
    {
        return PlayerRepository::create()->save($this);
    }

}