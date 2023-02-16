<style>
    td {
        padding: 5px;
        border: 1px solid black;
    }

    .white-bg {
        background-color: white;
    }

    .black-bg {
        background-color: black;
        color: white;
    }
</style>
<table>
    <?php
    $count = 1;
    for ($i = 1; $i <= 9; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= 8; $j++) {
            $class = "";
            if ($count % 3 == 0 || $count % 4 == 0) {
                $class = " class='white-bg'";
            } else {
                $class = " class='black-bg'";
            }
            echo "<td" . $class . ">" . $count . "</td>";
            $count++;
            if ($count > 64) break;
        }
        echo "</tr>";
        if ($count > 64) break;
    }
    ?>
</table>