### How to start
```sh
git clone https://github.com/orodsem/xplor.git

$ cd xplor

$ composer install
```

**Acceptance Criteria**
- 
* As a player, I'd like to place the robot on 0,0 and facing North, by default
* As a player, I'd like to limit the table size to 5 x 5 unit (0 - 4)
* As a player, I'd like to be able to place the robot anywhere on the table that I'd like
* As a player, I'd like to be able to turn the robot to lft or right
* As a player, I'd like to be able to move the robot as long as it won't fall off the table
* As a player, I'd like to be able to see where the robot located and generate a report
* As a player, I don't like my robot falls off the table and any actions can cause this should be ignored
* As a product owner, I'd like all the logic protected by unit testing, so I can deploy continuously with high confidence

### Let's play
To be able to play with this robot, please simply run:

```sh
$ php run.php

Robot placed on 2, 4 and facing: [EAST]
```

Please _note_ that the inputs come from `inputfile.txt`, feel free to change the input as explained below:

#### Input format 

* place x,y,facing example: place 1,2,north
* move
* left
* right
* report 

**Note**
If there is no `place` function or an invalid position given at the beginning of the input file, then it falls back to original position, which is 0,0 and facing North.

You can use any combination of these functions with no limitation! 


### Application structure
The main functionality and logic can be found at:
```sh
src/RobotToy.php
```
The unit tests can be found at:
```sh
tests/RobotToyTest.php
```

### Run tests
```sh
phpunit --coverage-html report tests/
```
This generate a code coverage report, which can be foud at:
```sh
report/index.html
```



     