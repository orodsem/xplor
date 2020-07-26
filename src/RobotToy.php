<?php


class RobotToy
{
    const NORTH = 'NORTH';
    const EAST  = 'EAST';
    const SOUTH = 'SOUTH';
    const WEST  = 'WEST';

    private $positionX;
    private $positionY;
    private $facing;

    /**
     * RobotToy constructor.
     * default is 0,0 facing North
     */
    public function __construct()
    {
        $this->setPositionX(0);
        $this->setPositionY(0);
        $this->setFacing(self::NORTH);
    }

    /**
     * place the robot
     *
     * @param $x
     * @param $y
     * @param $f
     */
    public function place($x, $y, $f = null): void
    {
        if (!$this->isPositionValid($x, $y)) {
            return;
        }

        $this->setPositionX($x);
        $this->setPositionY($y);
        $this->setFacing($f);
    }

    public function move()
    {
        // get current position and facing
        $x = $this->getPositionX();
        $y = $this->getPositionY();
        $facing = $this->getFacing();

        switch ($facing) {
            case self::NORTH:
                $y = $y + 1;
                break;
            case self::SOUTH:
                $y = $y - 1;
                break;
            case self::WEST:
                $x = $x - 1;
                break;
            case self::EAST:
                $x = $x + 1;
                break;
        }

        if (!$this->isPositionValid($x, $y)) {
            // if new position is invalid, then ignore it
            return;
        }

        $this->setPositionX($x);
        $this->setPositionY($y);
    }

    /**
     * turn to left
     */
    public function left()
    {
        $allDirections = $this->getAllDirection();
        $currentKey = array_search($this->getFacing(), $allDirections);
        $nextKey = $currentKey + 1;

        // if next key not found back to North
        $nextDirection = array_key_exists($nextKey, $allDirections)
            ? $allDirections[$nextKey]
            : self::NORTH;

        $this->setFacing($nextDirection);
    }

    /**
     * turn to right
     */
    public function right()
    {
        $allDirections = $this->getAllDirection();
        $currentKey = array_search($this->getFacing(), $allDirections);
        $nextKey = $currentKey - 1;

        // if it's North, then turn to East
        // otherwise, the prev item in the array will the on the right
        $nextDirection = $this->getFacing() === RobotToy::NORTH
            ? RobotToy::EAST
            : $allDirections[$nextKey];

        $this->setFacing($nextDirection);
    }

    /**
     *
     */
    public function report()
    {
        printf("Robot placed on %s, %s and facing: [%s] \n",
            $this->getPositionX(),
            $this->getPositionY(),
            $this->getFacing()
        );
    }

    /**
     * @return mixed
     */
    public function getPositionX()
    {
        return $this->positionX;
    }

    /**
     * @param $positionX
     * @return RobotToy
     */
    public function setPositionX($positionX): self
    {
        if (!$this->isPositionValid($positionX, $this->getPositionY())) {
            return $this;
        }

        $this->positionX = $positionX;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPositionY()
    {
        return $this->positionY;
    }

    /**
     * @param $positionY
     * @return RobotToy
     */
    public function setPositionY($positionY): self
    {
        if (!$this->isPositionValid($this->getPositionX(), $positionY)) {
            return $this;
        }

        $this->positionY = $positionY;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFacing()
    {
        return $this->facing;
    }

    /**
     * @param $facing
     * @return RobotToy
     */
    public function setFacing($facing): self
    {
        if ($this->isFacingValid($facing)) {
            $this->facing = strtoupper($facing);
        }

        return $this;
    }

    /**
     * validate position, both x and y position must be between 0 and 5
     *
     * @param $x
     * @param $y
     * @return bool
     */
    private function isPositionValid($positionX, $positionY): bool
    {
        if ($positionX < 0 || $positionX > 4) {
            return false;
        }

        if ($positionY < 0 || $positionY > 4) {
            return false;
        }

        return true;
    }

    /**
     * validate the direction
     *
     * @param $f
     * @return bool
     */
    private function isFacingValid($f): bool
    {
        $directions = array(
            self::NORTH,
            self::SOUTH,
            self::EAST,
            self::WEST
        );

        return in_array(strtoupper($f), $directions);
    }

    /**
     * this function return all direction in on order, which MUST not be changed
     */
    public function getAllDirection()
    {
        return [self::NORTH, self::WEST, self::SOUTH, self::EAST];
    }
}