<?php
include_once "src/RobotToy.php";

$file = fopen("inputfile.txt", "r");
$robot = new RobotToy();
while(!feof($file))
{
    $func = fgets($file);
    $func = strtolower(str_replace(PHP_EOL, '', $func));

    if (strpos($func, 'place') !== false) {
        // place the robot
        $func = str_replace('place ', '', $func);

        $parameters = explode(',', $func);
        $robot->place($parameters[0], $parameters[1], $parameters[2]);
    } else {
        if (!method_exists($robot, $func)) {
            printf('function [' . $func . '] not found and being ignored' . "\n");
            continue;
        }
        $robot->{$func}();
    }
}

fclose($file);