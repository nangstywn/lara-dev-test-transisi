<form action="" method="POST">
    <input type="text" name="kata" placeholder="Masukkan Pattern Kata">
    <button type="submit" name="submit">Submit</button>
</form>
<?php
if (isset($_POST['submit'])) {
    $kata = $_POST['kata'];
    $arr = [
        ['f', 'g', 'h', 'i'],
        ['j', 'k', 'p', 'q'],
        ['r', 's', 't', 'u']
    ];

    function cari($arr, $kata)
    {
        echo "'{$kata}' ";
        $char_text = str_split($kata);
        //first char validate
        $pattern = initCariCharArray($arr, $char_text[0]);
        //char not exist
        if (empty($pattern)) {
            return false;
        }

        //collect char
        $pattern_chars = array_keys($pattern);
        //char validate.
        foreach ($char_text as $key => $char) {

            if ($key === 0) {
                continue;
            }
            //if exist set new pattern
            if (in_array($char, $pattern_chars)) {
                $pattern = setCharPattern($arr, $pattern[$char]);
                $pattern_chars = array_keys($pattern);
            }
            //if no return false
            else {
                return false;
            }
        }
        return true;
    }

    function setCharPattern($arr, $key)
    {
        list($parent, $child) = $key;
        $char_pattern = [];
        //left direction pattern
        $new_key = $child - 1;
        if ($new_key >= 0) {
            $selected_char = $arr[$parent][$new_key];
            $char_pattern[$selected_char] = [$parent, $new_key];
        }
        //right direction pattern
        $new_key = $child + 1;
        if ($new_key <= 3) {
            $selected_char = $arr[$parent][$new_key];
            $char_pattern[$selected_char] = [$parent, $new_key];
        }
        //up direction pattern
        $new_key = $parent - 1;
        if ($new_key >= 0) {
            $selected_char = $arr[$new_key][$child];
            $char_pattern[$selected_char] = [$new_key, $child];
        }
        //down direction pattern
        $new_key = $parent + 1;
        if ($new_key <= 2) {
            $selected_char = $arr[$new_key][$child];
            $char_pattern[$selected_char] = [$new_key, $child];
        }
        return $char_pattern;
    }

    function initCariCharArray($arr, $char)
    {
        $result = [];
        foreach ($arr as $key => $value) {
            $key_value = array_search($char, $value);
            if ($key_value !== false) {
                $result = [$key, $key_value];
            }
        }
        if (empty($result)) {
            return false;
        } else {
            return setCharPattern($arr, $result);
        }
    }

    echo "Validasi pattern huruf dari array:<br>";
    echo "<pre>['f', 'g', 'h', 'i']
['j', 'k', 'p', 'q']
['r', 's', 't', 'u']<pre>";
    var_dump(cari($arr, "fghi"));
    var_dump(cari($arr, "fghp"));
    var_dump(cari($arr, 'fjrstp'));
    var_dump(cari($arr, 'fghq'));
    var_dump(cari($arr, 'fst'));
    var_dump(cari($arr, 'pqr'));
    var_dump(cari($arr, 'fghh'));
    var_dump(cari($arr, $kata));
}
