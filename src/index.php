<?php
$products = array(
    'q1' => array(
        'Kolkata' => array(
            'milk' => 340,
            'egg' => 604,
            'bread' => 38
        ),
        'Delhi' => array(
            'milk' => 335,
            'egg' => 365,
            'bread' => 35
        ),
        'Mumbai' => array(
            'milk' => 336,
            'egg' => 484,
            'bread' => 80
        )
    ),
    'q2' => array(
        'Kolkata' => array(
            'milk' => 680,
            'egg' => 583,
            'bread' => 10
        ),
        'Delhi' => array(
            'milk' => 684,
            'egg' => 490,
            'bread' => 48
        ),
        'Mumbai' => array(
            'milk' => 595,
            'egg' => 594,
            'bread' => 39
        )
    ),
    'q3' => array(
        'Kolkata' => array(
            'milk' => 535,
            'egg' => 490,
            'bread' => 50
        ),
        'Delhi' => array(
            'milk' => 389,
            'egg' => 385,
            'bread' => 15
        ),
        'Mumbai' => array(
            'milk' => 366,
            'egg' => 385,
            'bread' => 20
        )
    )
)
    ?>
<?php
$cities = array(
    'Kolkata',
    'Delhi',
    'Mumbai'
);
// function to display the table header
function displayHeader()
{
    echo "<thead>";
    foreach ($GLOBALS['cities'] as $value) {
        echo "<span style='margin-left: 120px; color: green;'><b>" . $value . "</b></span>";

    }
    echo "<br>";
    foreach ($GLOBALS['cities'] as $value) {
        echo "<span style='margin-left: 130px; color: green;'><b>" . "Item" . "</b></span>";
    }
    echo "<br>";
    echo "<th>Time</th>";
    foreach ($GLOBALS['cities'] as $value) {
        echo "<th>Milk</th><th>Egg</th><th>Bread</th>";
    }
    echo "</thead>";
}
// function to display the table body
function displayBody()
{
    foreach ($GLOBALS['products'] as $quarterKey => $quartervalue) {
        echo "<tr><td>" . $quarterKey . "</td>";
        foreach ($quartervalue as $citykey => $cityvalue) {
            foreach ($cityvalue as $key => $value) {
                echo "<td>" . $value . "</td>";
            }
        }
        echo "</tr>";
    }
}
?>
<style>
    th {
        padding-left: 20px;
        color: green;
    }

    td {
        padding-left: 20px;
    }
</style>
<table>
    <?php
    displayHeader()
        ?>
    <tbody>
        <?php
        displayBody()
            ?>
    </tbody>
</table>
<?php
// displaying the quarter with maximum consumption of eggs
$max = 0;
$maxQ = '';
foreach ($products as $quarterkey => $quartervalue) {
    $sumegg = 0;
    foreach ($quartervalue as $citykey => $cityvalue) {
        foreach ($cityvalue as $key => $value) {
            $sumegg += $products[$quarterkey][$citykey]['egg'];
        }
    }
    if ($sumegg > $max) {
        $maxQ = $quarterkey;
    }
    $max = max($max, $sumegg);
}
echo "<br>Quarter with maximum sale of egg is : " . $maxQ . "<br>";
// displaying the location with minimum consumption of milk
$min = PHP_INT_MAX;
$minL = '';
foreach ($products as $quarterkey => $quartervalue) {
    $summilk = 0;
    foreach ($quartervalue as $citykey => $cityvalue) {
        foreach ($cityvalue as $key => $value) {
            $summilk += $products[$quarterkey][$citykey]['milk'];
        }
    }
    if ($summilk < $min) {
        $minL = $citykey;
    }
    $min = min($min, $summilk);
}
echo "<br>Location with mimimum consumption of milk is : " . $minL;
// deleting the location with minimum sale of bread
$minbread = PHP_INT_MAX;
$minLBread = '';
// finding the location with minimum consumption of bread
foreach ($products as $quarterkey => $quartervalue) {
    $sumbread = 0;
    foreach ($quartervalue as $citykey => $cityvalue) {
        foreach ($cityvalue as $key => $value) {
            $sumbread += $products[$quarterkey][$citykey]['bread'];
        }
    }
    if ($sumbread < $minbread) {
        $minLBread = $citykey;
    }
    $minbread = min($minbread, $sumbread);
}
// deleting the location from products array
foreach ($products as $quarterkey => $quartervalue) {
    foreach ($quartervalue as $citykey => $cityvalue) {
        if ($citykey == $minLBread) {
            unset($products[$quarterkey][$citykey]);
        }
    }
}
// deleting the location from cities array 
foreach ($cities as $key => $value) {
    if ($value == $minLBread) {
        unset($cities[$key]);
    }
}
// displaying the table after deleting the loaction
echo "<br><br>";
echo "Displaying the table after deleting the location with minimum sales of bread. ";
echo "<br>";
?>
<table>
    <?php
    displayHeader()
        ?>
    <tbody>
        <?php
        displayBody()
            ?>
    </tbody>
</table>