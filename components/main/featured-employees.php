<?php
$featuredEmps = $Employee->featuredEmp(4);
$featuredEmps = json_decode($featuredEmps);
$feature1 = $featuredEmps[0];
$feature2 = $featuredEmps[1];
$feature3 = $featuredEmps[2];
$feature4 = $featuredEmps[3];

?>

