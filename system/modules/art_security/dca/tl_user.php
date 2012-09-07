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
 * Table tl_user
 */
$GLOBALS['TL_DCA']['tl_user']['fields']['password'] = array(
    'label'     => &$GLOBALS['TL_LANG']['MSC']['password'],
    'exclude'   => true,
    'inputType' => 'extendedPassword',
    'eval'      => array(
        'mandatory' => true,
        'minlength' => as_tl_user::retrivePasswordMinimumLength()
    )
);

/**
 * Class tl_user
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  ARTACK WebLab GmbH 2012
 * @author     Patrick Landolt <http://www.artack.ch>
 * @package    art_security
 */
class as_tl_user extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
            parent::__construct();
            $this->import('BackendUser', 'User');
    }
    
    /**
     * Retrieve extended password minimum length.
     */
    public static function retrivePasswordMinimumLength()
    {
        return ($GLOBALS['TL_CONFIG']['extended_security_minimum_password_length'] > 0) ? $GLOBALS['TL_CONFIG']['extended_security_minimum_password_length'] : 10;
    }
        
}