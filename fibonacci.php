<?php


function fibonacci(int $number)
{
    if($number > 20 || $number < 1) {
    	echo("Number must be greater than 0 and less than 20");
        return;
    }

    $firstNumber = 0;
    $secondNumber= 1;
    $counter = 0;

    while ($counter < $number) {
     echo ' ' . $firstNumber;
        $thirdNumber = $secondNumber + $firstNumber;
        $firstNumber = $secondNumber;
        $secondNumber = $thirdNumber;
        $counter = $counter + 1;
    }
}


$number = 5;

fibonacci($number);
echo "\n";

$anotherNumber = 10;
fibonacci($anotherNumber);
echo "\n";


$invalidNumber = 21;
fibonacci($invalidNumber);
?>
