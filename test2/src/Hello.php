<?php 
namespace HelloComposer;

use SimpleXLSX;

class Hello
{
    public function say($toSay = "Nothing given")
    {
        return $toSay;
    }

    public function validate($file = null)
    {
        if ( $xlsx = SimpleXLSX::parse($file) ) {
            $header_values = $rows = $rules = [];
            foreach ( $xlsx->rows() as $k => $r ) {
                $row = $k+1;
                $error = [];
                if ( $k === 0 ) {
                    $header_values = $r;
                    for ($i=0; $i < count($header_values); $i++) { 
                        $header = $header_values[$i];
                        if (substr($header,0,1) == "#") 
                            $rules[$i] = "Should Not Contain Any Space";
                        if (substr($header,strlen($header)-1,1) == "*")
                            $rules[$i] = "Should Not Empty";
                    }
                    continue;
                }
                
                foreach ($rules as $key => $value) {
                    if (($value == "Should Not Contain Any Space") && (strpos($r[$key], " ") !== false))
                        $error[] = $header_values[$key]." ".$value;
                    if (($value == "Should Not Empty") && empty($r[$key])) 
                        $error[] = " Missing Value in ".$header_values[$key];
                }

                if (!empty($error)) {
                    echo "<pre>";
                    echo "Row ".$row." => ".implode(", ", $error);
                }
            }

        } else {
            echo SimpleXLSX::parseError();
        }
    }
}