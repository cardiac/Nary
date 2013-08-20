<?php
/*
    Nary
    Copyright (C) 2013 Ryan Strug

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
define('TOP', 10);
define('BOTTOM', 2);
define('COUNT', 1000);
define('COMPARE_RANGE', true);

/**
 * Nary class.
 */
class Nary
{
    /**
     * calc function.
     * calculates the various number systems.
     * 
     * @access public
     * @static
     * @param int $base (default: 3)
     * @param int $cap (default: 100)
     * @return void
     */
    public static function calc($base = 3, $cap = 100) {
        $res = array();
        $j = $k = $num[0] = 0;
        for ($i = 0; $i < $cap; $i++) {
            $res[] = null;
            for ($l = count($num) - 1; $l >= 0; $l--)
                $res[$i] .= $num[$l];
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
        
        for ($i = BOTTOM; $i < TOP; $i++) {
            echo '            <th>'.$i.'</th>'."\n";
            $data[$i] = Nary::calc($i, COUNT);
        }
        
        echo '        </tr>'."\n"
            .'    </thead>'."\n"
            .'    <tbody>'."\n";
        
        for ($i = 0; $i < COUNT; $i++) {
            echo '        <tr>'."\n"
                .'                <td>'.$data[TOP - 1][$i].'</td>'."\n";
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

if (COMPARE_RANGE == true)
    Nary::range();
else
    Nary::deuce();