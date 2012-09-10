<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  ARTACK WebLab GmbH 2012
 * @author     Patrick Landolt <http://www.artack.ch>
 * @package    art_security
 * @license    LGPL
 * @filesource
 */

/**
 * Class Validator
 *
 * Validation service class
 * @copyright  ARTACK WebLab GmbH 2012
 * @author     Patrick Landolt <http://www.artack.ch>
 * @package    art_security
 */
class Validator
{

    public static function validatePasswordComplexity($varInput)
    {
        $nonAlphaNum = '!#$%&()*+,-.:;>=<?@[]_{}';
        $countCategories = 0;

        if (preg_match('/[a-z]+/', $varInput)) $countCategories++;
        if (preg_match('/[A-Z]+/', $varInput)) $countCategories++;
        if (preg_match('/[0-9]+/', $varInput)) $countCategories++;
        if (preg_match('/['. preg_quote($nonAlphaNum) .']+/', $varInput)) $countCategories++;

        return ($countCategories >= 3) ? true : false;
    }
    
    public static function validatePartOfUsernameInPassword($username, $varInput)
    {
        $usernameCount = utf8_strlen($username);
            
        $usernameParts = array();
        for ($i=0; $i<=$usernameCount-3; $i++)
        {
            $usernameParts[] = utf8_substr($username, $i, 3);
        }

        $usernamePartInPassword = false;
        foreach ($usernameParts as $part)
        {
            if (false !== utf8_strpos($varInput, $part))
            {
                $usernamePartInPassword = true;
            }
        }
        
        return !$usernamePartInPassword;
    }
    
    public static function validateMinPasswordLength($varInput)
    {
        return (utf8_strlen($varInput) > $GLOBALS['TL_CONFIG']['extended_security_minimum_password_length']) ? true : false;
    }
        
}