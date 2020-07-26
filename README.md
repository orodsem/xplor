### How to start
```sh
git clone https://github.com/orodsem/xplor.git

$ cd xplor

$ composer install
```

**Acceptance Criteria**
- 
* As a player I'd like to put the robot to place the robot on 0,0 and facing North, by default
* As a player, I'd like to limit the table size to 5 x 5 unit (0 - 4)
* As a player, I'd like to be able to place the robot anywhere on the table that I'd like
* As a player, I'd like to be able to turn the robot to lft or right
* As a player, I'd like to be able to move the robot
* As a player, I'd like to be able to see where the robot is and generate a report
* As a player, I don't like my robot fall off the table and any actions can cause this should be ignored
* As a product owner, I'd like all the logic protected by unit testing, so I can deploy continuously with high confidence

###Let's play
```sh
$ php run.php

Robot placed on 1, 3 and facing: [NORTH] 
Robot placed on 1, 3 and facing: [WEST] 
Robot placed on 0, 3 and facing: [WEST] 
Robot placed on 0, 3 and facing: [WEST]
```

**Note** 
This file reads the input from `inputfile.txt` feel free to change the input

###Input format 

* place(x,y,facing) example: place(1,2,north)
* move
* left
* right
* report 

**Note**
If there is no `place` function found at the begining of this file, then it falls back to original place which 0,0 and facing North.

You can use any combination of these functions with no limitation! 




     