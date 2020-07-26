<?php


class RobotToy
{
    // facing options
    const NORTH = 'NORTH';
    const EAST  = 'EAST';
    const SOUTH = 'SOUTH';
    const WEST  = 'WEST';

    // min position
    const MIN_POS = 0;
    // max position
    const MAX_POS = 4;

    // default values
    private $positionX = self::MIN_POS;
    private $positionY = self::MIN_POS;
    private $facing = self::NORTH;

    /**
     * place the robot
     *
     * @param $x
     * @param $y
     * @param $f
     */
    public function place($x, $y, $f = null): void
    {
        try {
            if (!$this->isPositionValid($x, $y)) {
                return;
            }

            $this->setPositionX($x);
            $this->setPositionY($y);
            $this->setFacing($f);
        } catch (TypeError $e) {
            printf( "Invalid position given \n");
        }
    }

    /**
     * move the robot
     */
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
     * print out the current robot position
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
     * @return int
     */
    public function getPositionX(): int
    {
        return $this->positionX;
    }

    /**
     * @param $positionX
     * @return RobotToy
     */
    public function setPositionX(int $positionX): self
    {
        if (!$this->isPositionValid($positionX, $this->getPositionY())) {
            return $this;
        }

        $this->positionX = $positionX;
        return $this;
    }

    /**
     * @return int
     */
    public function getPositionY(): int
    {
        return $this->positionY;
    }

    /**
     * @param $positionY
     * @return RobotToy
     */
    public function setPositionY(int $positionY): self
    {
        if (!$this->isPositionValid($this->getPositionX(), $positionY)) {
            return $this;
        }

        $this->positionY = $positionY;
        return $this;
    }

    /**
     * @return string
     */
    public function getFacing(): string
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
        if ($positionX < self::MIN_POS || $positionX > self::MAX_POS) {
            return false;
        }

        if ($positionY < self::MIN_POS || $positionY > self::MAX_POS) {
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
     * this function returns all directions in a particular order, which MUST not be changed
     */
    public function getAllDirection()
    {
        return [self::NORTH, self::WEST, self::SOUTH, self::EAST];
    }
}