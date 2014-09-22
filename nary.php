<?php
/*
    Nary
    Copyright (C) 2013-2014 Ryan Strug

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

// Configuration
define('TOP', 16);
define('BOTTOM', 2);
define('COUNT', 1000);
define('COMPARE_RANGE', true);

/**
 * Nary class.
 */
class Nary
{
    private static $_symbols = array (
        10 => 'A', 11 => 'B',
        12 => 'C', 13 => 'D',
        14 => 'E', 15 => 'F',
        16 => 'G', 17 => 'H',
        18 => 'I', 19 => 'J',
        20 => 'K', 21 => 'L',
        22 => 'M', 23 => 'N',
        24 => 'O', 25 => 'P',
        26 => 'Q', 27 => 'R',
        28 => 'S', 29 => 'T',
        30 => 'U', 31 => 'V',
        32 => 'W', 33 => 'X',
        34 => 'Y', 35 => 'Z',
        36 => 'a', 37 => 'b',
        38 => 'c', 39 => 'd',
        40 => 'e', 41 => 'f',
        42 => 'g', 43 => 'h',
        44 => 'i', 45 => 'j',
        46 => 'k', 47 => 'l',
        48 => 'm', 49 => 'n',
        50 => 'o', 51 => 'p',
        52 => 'q', 53 => 'r',
        54 => 's', 55 => 't',
        56 => 'u', 57 => 'v',
        58 => 'w', 59 => 'x',
        60 => 'y', 61 => 'z'
    );

    /**
     * calc function.
     * calculates the various number systems.
     * 
     * @access public
     * @static
     * @param int $base (default: 3)
     * @param int $cap (default: 100)
     * @return array
     */
    public static function calc($base = 3, $cap = 100)
    {
        if ($base > 62)
            throw new Exception('Unable to display bases > 62 properly.');
        $res = array();
        $j = $k = $num[0] = 0;
        for ($i = 0; $i < $cap; $i++) {
            $res[] = null;
            for ($l = count($num) - 1; $l >= 0; $l--)
                $res[$i] .= ($base > 10 && $num[$l] > 9) ? Nary::$_symbols[$num[$l]] : $num[$l];
            if ($k == $base - 1) {
                for ($j = 0; $j < count($num); $j++) {
                    if ($num[$j] == $base - 1)
                        $num[$j] = 0;
                    else {
                        $num[$j]++;
                        break;
                    }
                }
                if (empty($num[$j]) && $num[$j - 1] == 0)
                    $num[] = 1;
                $j = $k = 0;
            } else
                $num[$j] = ++$k;
        }
        return $res;
    }
    
    /**
     * range function.
     * displays the various number systems between two bases.
     * 
     * @access public
     * @static
     * @return void
     */
    public static function range()
    {
        echo '<table>'."\n"
            .'    <thead>'."\n"
            .'        <tr>'."\n"
            .'            <th>'.TOP.'</th>'."\n";
        
        $data[TOP] = Nary::calc(TOP, COUNT);
        for ($i = BOTTOM; $i < TOP; $i++) {
            echo '            <th>'.$i.'</th>'."\n";
            $data[$i] = Nary::calc($i, COUNT);
        }
        
        echo '        </tr>'."\n"
            .'    </thead>'."\n"
            .'    <tbody>'."\n";
        
        for ($i = 0; $i < COUNT; $i++) {
            echo '        <tr>'."\n"
                .'                <td>'.$data[TOP][$i].'</td>'."\n";
            for ($j = BOTTOM; $j < TOP; $j++)
                echo '            <td>'.$data[$j][$i].'</td>'."\n";
            echo '        </tr>'."\n";
        }
        
        echo '    </tbody>'."\n"
            .'</table>'."\n";
    }
    
    /**
     * deuce function.
     * compares two different number systems.
     * 
     * @access public
     * @static
     * @return void
     */
    public static function deuce()
    {
        $data[TOP] = Nary::calc(TOP, COUNT);
        $data[BOTTOM] = Nary::calc(BOTTOM, COUNT);
        
        echo '<table'."\n"
            .'    <thead>'."\n"
            .'        <tr>'."\n"
            .'            <th>'.TOP.'</th>'."\n"
            .'            <th>'.BOTTOM.'</th>'."\n"
            .'        </tr>'."\n"
            .'     </thead>'."\n"
            .'     <tbody>'."\n";
        
        for ($i = 0; $i < COUNT; $i++)
            echo '        <tr>'."\n"
                .'            <td>'.$data[TOP][$i].'</td>'
                .'            <td>'.$data[BOTTOM][$i].'</td>'
                .'        </tr>'."\n";
        
        echo '    </tbody>'."\n"
            .'</table>'."\n";
    }
}

if (COMPARE_RANGE)
    Nary::range();
else
    Nary::deuce();
