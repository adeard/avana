<?php 

function test1($string = null, $num = null){
    if (strlen($string) > 0) {
        $open=0;
        $index=0;
        for ($i=0; $i < strlen($string); $i++) { 
            $char = substr($string,$i,1);
            if ($char == "(") {
                $open += 1;
                if ($i == $num)
                    $index = $open;
            }
            if ($char == ")") {
                $open -= 1;
                if ($index > $open)
                    return $i;
            }
        }
        return "char is not '('";
    } else {
        return "Error String";
    }
}

$string = "a (b c (d e (f) g) h) i (j k)";
$result = test1($string, 2);

echo $result;

?>