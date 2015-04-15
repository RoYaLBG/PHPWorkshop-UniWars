<?php
namespace Uniwars\Models;

use Uniwars\Repositories\UniversityRepository;

class University
{
    private $id;
    private $name;

    /**
     * @var Player
     */
    private $player;

    private $money;
    private $lecturues;

    public function __construct(
        $id,
        $name,
        Player $player,
        $money,
        $lectures
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->setPlayer($player);
        $this->setMoney($money);
        $this->setLecturues($lectures);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param Player $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @return mixed
     */
    public function getLecturues()
    {
        return $this->lecturues;
    }

    /**
     * @param mixed $lecturues
     */
    public function setLecturues($lecturues)
    {
        $this->lecturues = $lecturues;
    }

    /**
     * @return mixed
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * @param mixed $money
     */
    public function setMoney($money)
    {
        $this->money = $money;
    }


    public function save()
    {
        return UniversityRepository::create()->save($this);
    }
}