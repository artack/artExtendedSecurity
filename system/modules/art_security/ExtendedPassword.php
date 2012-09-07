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
 * Class ExtendedPassword
 *
 * Form field "password".
 * @copyright  ARTACK WebLab GmbH 2012
 * @author     Patrick Landolt <http://www.artack.ch>
 * @package    art_security
 */
class ExtendedPassword extends Password
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_widget_epw';
    
    /**
     * Validate input and set value
     * @param mixed
     * @return string
     */
    protected function validator($varInput)
    {
        // check for password complexity
        if ($GLOBALS['TL_CONFIG']['extended_security_higher_password_complexity'])
        {
            $nonAlphaNum = '!#$%&()*+,-.:;>=<?@[]_{}';
            $countCategories = 0;

            if (preg_match('/[a-z]+/', $varInput)) $countCategories++;
            if (preg_match('/[A-Z]+/', $varInput)) $countCategories++;
            if (preg_match('/[0-9]+/', $varInput)) $countCategories++;
            if (preg_match('/['. preg_quote($nonAlphaNum) .']+/', $varInput)) $countCategories++;

            if ($countCategories < 3)
            {
                $this->addError($GLOBALS['TL_LANG']['tl_user']['validator']['higherPasswordComplexity']);
            }
        }
        
        // check for parts of username in password
        if ($GLOBALS['TL_CONFIG']['extended_security_password_not_contain_user'])
        {
            $username = $this->getPost('username');
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
            
            if ($usernamePartInPassword)
            {
                $this->addError($GLOBALS['TL_LANG']['tl_user']['validator']['usernamePartOfPassword']);
            }
        }
        
        $return = parent::validator($varInput);
        return $return;
    }
    
}