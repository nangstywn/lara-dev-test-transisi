<form action="" method="POST">
    <textarea name="word" id="" cols="50" rows="10">Masukkan Kalimat</textarea><br>
    <button type="submit" name="submit">Submit</button>
</form>
<?php
if (isset($_POST['submit'])) {
    $word = $_POST['word'];
    echo gram($word);
}

function gram($input)
{
    $arr = explode(' ', $input);

    // unigram
    $unigram = '';
    foreach ($arr as $item) {
        $unigram .= $item . ', ';
    }
    $unigram = substr($unigram, 0, -2);

    // bigram
    $i = 0;
    $bigram = '';
    foreach ($arr as $item) {
        if ($i < 1) {
            $bigram .= $item . ' ';
            $i++;
        } else {
            $bigram .= $item . ', ';
            $i = 0;
        }
    }
    $bigram = substr($bigram, 0, -2);

    // trigram
    $x = 0;
    $trigram = '';
    foreach ($arr as $item) {
        if ($x < 2) {
            $trigram .= $item . ' ';
            $x++;
        } else {
            $trigram .= $item . ', ';
            $x = 0;
        }
    }
    $trigram = substr($trigram, 0, -2);

    $result = 'Unigram : ' . $unigram . '<br>';
    $result .= 'Bigram : ' . $bigram . '<br>';
    $result .= 'Trigram : ' . $trigram;

    return $result;
}

?>