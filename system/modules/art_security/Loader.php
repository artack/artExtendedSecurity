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
 * Class Loader
 *
 * Loader service class
 * @copyright  ARTACK WebLab GmbH 2012
 * @author     Patrick Landolt <http://www.artack.ch>
 * @package    art_security
 */
class Loader
{
    
    private static $supportedLanguages = array("de");
    private static $LANG = array(
        'de'    => array(
            'tl_user'   => array(
                'validator' => array(
                    'higherPasswordComplexity'  => 'Das Passwort muss aus 3 der folgenden 4 Kategorien zusammengesetzt sein: A-Z, a-z, 0-9, Sonderzeichen (z.B. !, $, #, %, ...)',
                    'usernamePartOfPassword'    => 'Das Passwort darf keine Teile des Benutzernamens enthalten'
                )
            )
        )
    );
            
    public static function loadMinPasswordLength()
    {
        return (isset($GLOBALS['TL_CONFIG']['extended_security_minimum_password_length'])) ? $GLOBALS['TL_CONFIG']['extended_security_minimum_password_length'] : 10;
    }
    
    public static function loadTranslations($language)
    {
        if (!in_array($language, self::$supportedLanguages))
        {
            throw new Exception("Languages not supported");
        }
        
        return self::$LANG[$language];
    }
        
}