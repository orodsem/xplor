<?php
include_once "src/RobotToy.php";

$file = fopen("inputfile.txt", "r");

// instantiate the robot object with default values
$robot = new RobotToy();

// read inputs until it's done
while(!feof($file))
{
    $func = fgets($file);

    // ensure user can enter in small/caps letter
    $func = strtolower(str_replace(PHP_EOL, '', $func));

    if (strpos($func, 'place') !== false) {
        // place the robot
        $func = str_replace('place ', '', $func);

        $parameters = explode(',', $func);
        $robot->place($parameters[0], $parameters[1], $parameters[2]);
    } else {
        if (!method_exists($robot, $func)) {
            // if function doesn't exist, then print an error message and do nothing else
            printf('function [' . $func . '] not found and being ignored' . "\n");
            continue;
        }

        // trigger the action
        $robot->{$func}();
    }
}

fclose($file);