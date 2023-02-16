<form action="" method="POST">
    <input type="text" name="kata" placeholder="Masukkan Kata">
    <button type="submit" name="submit">Submit</button>
</form>
<?php
if (isset($_POST['submit'])) {
    $kata = $_POST['kata'];
    echo "\"$kata\" mengandung " . lowercase($kata) . " buah huruf kecil";
}

function lowercase($kata)
{
    $lower = strtolower($kata);
    $lowerCount = similar_text($lower, $kata);
    return $lowerCount;
}
?>