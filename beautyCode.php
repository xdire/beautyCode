<?php
/**
 * Class beautyCode
 *
 * hashing the string into short
 *
 */

class beautyCode {

    private $length;
    private $string;
    private $dictionary;
    private $dictlength;
    public $hash;

    function __construct($string,$length=8)
    {

        // Length of beautifized string
        $this->length = $length;

        // Use unix time if string is not defined or lesser than 3
        $this->string = (strlen($string)<3)?microtime():$string;

        // Dictionary string of allowed characters with constant length
        $this->dictionary = 'B8A1C3D9E0F4G5HLKJIMPNOQR6SWUVTX2Y7Z';
        $this->dictlength = 36;

        // Exec
        $this->hash();

    }

    private function hash()
    {

        $result = '';

        // Packing input string into array of numbers
        $values = $this->pack($this->string);
        
        // Iterate
        foreach ($values as $val) {
            
            // Take number in 0-36 range
            $rest = $val % $this->dictlength;
            // Extract number from dictionary
            $result .= $this->dictionary[$rest];

        }

        $this->hash = $result;
    }

    private function pack($string)
    {

        $result = array();

        // Create MD5 hash of string and length variables
        $values = md5($string);
        $vallen = 32;

        // Determine how much data we need to write up after tiers is end
        $rest = $vallen % $this->length;

        // Determine how much tiers we need to make
        $tier = round($vallen / $this->length);

        // Set maximum after which we will fill up array with rest values
        $max = $vallen - $rest;

        $k = 1;
        $e = 0;
        $r = 0;

        for ($i = 0; $i < $vallen; $i++) {

            // Extract letter number
            $int = ord($values[$i]);

            // Append it to result number
            $r += $i + $int;

            // If k var equals to tier change number write up number in result
            if ($k == $tier) {

                $result[$e] = $r;
                $e++;
                $r=0;
                $k = 1;

            } else {

                $k++;

            }

            // If tiers ended writing up rest values into result cells
            if ($i > $max) {

                if (isset($result[$rest])) {

                    $result[$rest] += $r;
                    $rest--;

                }

            }

        }

        return $result;
    }
}