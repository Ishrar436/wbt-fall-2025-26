<?php
echo "Hello, World! <br> <br>";
for ($i = 0; $i < 10; $i++) {
    echo "Number: $i <br> <br>";
}
$a = 5;
$b = 10;
echo "Sum:  $a  +  $b  = " . ($a + $b) . "<br> <br>";

echo "<br> <br>";

echo "<h2> Question 1 </h2>";
$length = 15;
$height = 5;
$perimeter = 2 * ($length + $height);
echo " The length of the rectangle is: " . $length . "<br>";
echo " The height of the rectangle is: " . $height . "<br>";
echo " The area of the rectangle is:  $length * $height = " . ($length * $height) . "<br>";
echo " The perimeter of the rectangle is: 2 * ( $length + $height ) = " . $perimeter . " <br> <br>";

echo "<h2> Question 2 </h2>";
$amount = 1500;
$VAT = 15;
echo " The amount is:  $amount  TAKA <br>";
echo " The VAT rate is: " . ($VAT) . "% <br>";
echo " The VAT amount is:  $amount * $VAT % = " . ($amount * $VAT / 100) . " TAKA";

echo "<h2> Question 3 </h2>";
$number = 7;
echo " The number is:  $number <br>";
if ($number % 2 == 0) {
    echo " The number $number is even. <br>";
} else {
    echo " The number is odd. <br>";
}

echo "<h2> Question 4 </h2>";

$number1 = 15;
$number2 = 17;
$number3 = 10;
echo " The numbers are:  $number1 ,  $number2 ,  $number3 <br>";
if ($number1 >= $number2 && $number1 >= $number3) {
    echo " The largest number is:  $number1 <br>";
} elseif ($number2 >= $number1 && $number2 >= $number3) {
    echo " The largest number is:  $number2 <br>";
} else {
    echo " The largest number is:  $number3 <br>";
}

echo "<h2> Question 5 </h2>";
$start = 10;
$end = 100;
echo "All the ODD numbers between $start and $end are: <br>";
while ($start <= $end) {
    if ($start % 2 != 0) {
        echo "$start <br>";
    }
    $start++;
}


echo "<h2> Question 6 </h2>";

$array = ["BBA", "CSE", "EEE", "ENG", "LLB", "ECO", "PHARMACY", "ARCH"];
echo "The array elements are: <br>";
foreach ($array as $value) {
    echo "$value <br>";
}
echo "<br>";
$value = "CSE";
$found = false;
echo "Searching for '$value' in the array<br>";
for ($i = 0; $i < count($array); $i++) {
    if ($array[$i] == $value) {
        echo "Found $value in the array at index $i. <br>";
        $found = true;
        break;
    }
}
if (!$found) {
    echo "$value is not found in the array. <br><br>";
}

echo "<h2> Question 7 </h2>";
echo "Pattern 1<br>";
for ($i = 1; $i <= 3; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
    echo "<br>";
}

echo "<br>";
echo "Pattern 2<br>";
for ($i = 3; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo "$j ";
    }
    echo "<br>";
}

echo "<br>";
echo "Pattern 3<br>";
$char = 'A';
for ($i = 1; $i <= 3; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "$char ";
        $char++;
    }
    echo "<br>";
}
?>