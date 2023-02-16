<?php
$nilai = "72 65 73 78 75 74 90 81 87 65 55 69 72 78 79 91 100 40 67 77 86";
//convert string to array
$arr = explode(' ', $nilai);
//count arr length
$length = count($arr);
$total = 0;
for ($i = 0; $i < $length; $i++) {
    $total += $arr[$i];
}
$rata = $total / $length;
echo "Rata rata = $rata <br>";

rsort($arr); //descending sort
$max = array_slice($arr, 0, 7); //get 7 max data
$result = implode(", ", $max); //convert array to string
echo "7 Nilai Tertinggi adalah $result <br>";


asort($arr); //ascending sort
$min = array_slice($arr, 0, 7); //get 7 min data
$result = implode(", ", $min); //convert array to string
echo "7 Nilai Terendah adalah $result";
