<?php

use PHPUnit\Framework\TestCase;
include_once "src/RobotToy.php";

class RobotToyTest extends TestCase
{

    public function testDefaultValues(): void
    {
        $robot = new RobotToy();

        $this->assertEquals(0, $robot->getPositionX());
        $this->assertEquals(0, $robot->getPositionY());
        $this->assertEquals(RobotToy::NORTH, $robot->getFacing());
    }

    public function testCannotPositionXBeNegative(): void
    {
        $robot = new RobotToy();
        $robot->place(-1,2,RobotToy::WEST);

        $this->assertEquals(0, $robot->getPositionX());
    }

    public function testCannotPositionYBeNegative(): void
    {
        $robot = new RobotToy();
        $robot->place(1,-2,RobotToy::WEST);

        $this->assertEquals(0, $robot->getPositionY());
    }

    public function testCannotPositionXBeBiggerThanFive(): void
    {
        $robot = new RobotToy();
        $robot->place(10,2,RobotToy::WEST);

        $this->assertEquals(0, $robot->getPositionX());
    }

    public function testCannotPositionYBeBiggerThanFive(): void
    {
        $robot = new RobotToy();
        $robot->place(10,20,RobotToy::WEST);

        $this->assertEquals(0, $robot->getPositionY());
    }

    public function testShouldPositionXBeValid(): void
    {
        $robot = new RobotToy();
        $robot->place(3,2,RobotToy::WEST);

        $this->assertEquals(3, $robot->getPositionX());
    }

    public function testShouldPositionYBeValid(): void
    {
        $robot = new RobotToy();
        $robot->place(1,2,RobotToy::WEST);

        $this->assertEquals(2, $robot->getPositionY());
    }

    public function testSetPositionXWontTakeBiggerThanFive()
    {
        $robot = new RobotToy();
        $robot->setPositionX(10);

        $this->assertEquals(0, $robot->getPositionX());
    }

    public function testSetPositionYWontTakeBiggerThanFive()
    {
        $robot = new RobotToy();
        $robot->setPositionY(10);

        $this->assertEquals(0, $robot->getPositionY());
    }

    public function testSetPositionXWontTakeLessThanZero()
    {
        $robot = new RobotToy();
        $robot->setPositionX(-1);

        $this->assertEquals(0, $robot->getPositionX());
    }

    public function testSetPositionYWontTakeLessThanZero()
    {
        $robot = new RobotToy();
        $robot->setPositionY(-1);

        $this->assertEquals(0, $robot->getPositionY());
    }

    public function testPositionXMustBeInteger()
    {
        $robot = new RobotToy();
        $robot->place("foo",2,RobotToy::WEST);

        $this->expectOutputString("Invalid position given \n");
    }

    public function testPositionYMustBeInteger()
    {
        $robot = new RobotToy();
        $robot->place(1,"bar",RobotToy::WEST);

        $this->expectOutputString("Invalid position given \n");
    }

    // move vertically scenarios
    public function testMoveVerticallyToNorth()
    {
        $robot = new RobotToy();
        $robot->place(3,2,RobotToy::NORTH);
        $robot->move();

        $this->assertEquals(3, $robot->getPositionX());
        $this->assertEquals(3, $robot->getPositionY());
        $this->assertEquals(RobotToy::NORTH, $robot->getFacing());
    }

    public function testMoveInvalidVerticallyToNorthFromNWEdge()
    {
        $robot = new RobotToy();
        $robot->place(0,4,RobotToy::NORTH);
        $robot->move();

        $this->assertEquals(0, $robot->getPositionX());
        $this->assertEquals(4, $robot->getPositionY());
        $this->assertEquals(RobotToy::NORTH, $robot->getFacing());
    }

    public function testMoveInvalidVerticallyToNorthFromNEEdge()
    {
        $robot = new RobotToy();
        $robot->place(4,4,RobotToy::NORTH);
        $robot->move();

        $this->assertEquals(4, $robot->getPositionX());
        $this->assertEquals(4, $robot->getPositionY());
        $this->assertEquals(RobotToy::NORTH, $robot->getFacing());
    }

    public function testMoveVerticallyToSouth()
    {
        $robot = new RobotToy();
        $robot->place(3,2,RobotToy::SOUTH);
        $robot->move();

        $this->assertEquals(3, $robot->getPositionX());
        $this->assertEquals(1, $robot->getPositionY());
        $this->assertEquals(RobotToy::SOUTH, $robot->getFacing());
    }

    public function testMoveInvalidVerticallyToSouthFromSWEdge()
    {
        $robot = new RobotToy();
        $robot->place(0,0,RobotToy::SOUTH);
        $robot->move();

        $this->assertEquals(0, $robot->getPositionX());
        $this->assertEquals(0, $robot->getPositionY());
        $this->assertEquals(RobotToy::SOUTH, $robot->getFacing());
    }

    public function testMoveInvalidVerticallyToSouthFromSEEdge()
    {
        $robot = new RobotToy();
        $robot->place(4,0,RobotToy::SOUTH);
        $robot->move();

        $this->assertEquals(4, $robot->getPositionX());
        $this->assertEquals(0, $robot->getPositionY());
        $this->assertEquals(RobotToy::SOUTH, $robot->getFacing());
    }


    // move horizontally scenarios
    public function testMoveHorizontallyToWest()
    {
        $robot = new RobotToy();
        $robot->place(3,2,RobotToy::WEST);
        $robot->move();

        $this->assertEquals(2, $robot->getPositionX());
        $this->assertEquals(2, $robot->getPositionY());
        $this->assertEquals(RobotToy::WEST, $robot->getFacing());
    }

    public function testMoveHorizontallyToEast()
    {
        $robot = new RobotToy();
        $robot->place(3,2,RobotToy::EAST);
        $robot->move();

        $this->assertEquals(4, $robot->getPositionX());
        $this->assertEquals(2, $robot->getPositionY());
        $this->assertEquals(RobotToy::EAST, $robot->getFacing());
    }

    public function testAllDirectionOrder()
    {
        $robot = new RobotToy();

        $this->assertEquals(
            [RobotToy::NORTH, RobotToy::WEST, RobotToy::SOUTH, RobotToy::EAST],
            $robot->getAllDirection()
        );
    }

    // turn left scenarios
    public function testMoveLeftFromNorth()
    {
        $robot = new RobotToy();
        $robot->left();

        $this->assertEquals(RobotToy::WEST, $robot->getFacing());
    }

    public function testMoveLeftFromEast()
    {
        $robot = new RobotToy();
        $robot->setFacing(RobotToy::EAST);
        $robot->left();

        $this->assertEquals(RobotToy::NORTH, $robot->getFacing());
    }

    public function testMoveLeftFromSouth()
    {
        $robot = new RobotToy();
        $robot->setFacing(RobotToy::SOUTH);
        $robot->left();

        $this->assertEquals(RobotToy::EAST, $robot->getFacing());
    }

    public function testMoveLeftFromWest()
    {
        $robot = new RobotToy();
        $robot->setFacing(RobotToy::WEST);
        $robot->left();

        $this->assertEquals(RobotToy::SOUTH, $robot->getFacing());
    }

    // turn right scenarios
    public function testMoveRightFromNorth()
    {
        $robot = new RobotToy();
        $robot->right();

        $this->assertEquals(RobotToy::EAST, $robot->getFacing());
    }

    public function testMoveRightFromEast()
    {
        $robot = new RobotToy();
        $robot->setFacing(RobotToy::EAST);
        $robot->right();

        $this->assertEquals(RobotToy::SOUTH, $robot->getFacing());
    }

    public function testMoveRightFromSouth()
    {
        $robot = new RobotToy();
        $robot->setFacing(RobotToy::SOUTH);
        $robot->right();

        $this->assertEquals(RobotToy::WEST, $robot->getFacing());
    }

    public function testMoveRightFromWest()
    {
        $robot = new RobotToy();
        $robot->setFacing(RobotToy::WEST);
        $robot->right();

        $this->assertEquals(RobotToy::NORTH, $robot->getFacing());
    }

    public function testReport()
    {
        $robot = new RobotToy();
        $robot->report();
        $this->expectOutputString("Robot placed on 0, 0 and facing: [NORTH] \n");
    }
}