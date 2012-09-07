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
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_replace('{files_legend', '{extended_security_legend:},extended_security_minimum_password_length,extended_security_maximum_password_age,extended_security_higher_password_complexity,extended_security_password_not_contain_user;{files_legend', $GLOBALS['TL_DCA']['tl_settings']['palettes']['default']);

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['extended_security_minimum_password_length'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['extended_security_minimum_password_length'],
    'exclude'	=> true,
    'search'    => false,
    'default'	=> 10,
    'inputType'	=> 'text',
    'eval'		=> array(
        'mandatory' => true,
        'tl_class'  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['extended_security_maximum_password_age'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['extended_security_maximum_password_age'],
    'exclude'	=> true,
    'search'    => false,
    'inputType'	=> 'text',
    'default'	=> 90,
    'eval'      => array(
        'tl_class'  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['extended_security_password_not_contain_user'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['extended_security_password_not_contain_user'],
    'exclude'	=> true,
    'search'    => false,
    'inputType'	=> 'checkbox',
    'default'	=> true,
    'eval'      => array(
        'tl_class'  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['extended_security_higher_password_complexity'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['extended_security_higher_password_complexity'],
    'exclude'	=> true,
    'search'    => false,
    'inputType'	=> 'checkbox',
    'default'	=> true,
    'eval'      => array(
        'tl_class'  => 'w50'
    )
);