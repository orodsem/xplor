<?php
include_once "src/RobotToy.php";

$file = fopen("inputfile.txt", "r");
$robot = new RobotToy();
while(! feof($file))
{
    $func = fgets($file);
    $func = str_replace(PHP_EOL, '', $func);

    if (strpos($func, 'place') !== false) {
        // place the robot
        $func = str_replace('place(', '', $func);
        $func = str_replace(')', '', $func);

        $parameters = explode(',', $func);
        $robot->place($parameters[0], $parameters[1], $parameters[2]);
    } else {
        $robot->{$func}();
    }
}

// always generate the report at the end
//$robot->report();
fclose($file);