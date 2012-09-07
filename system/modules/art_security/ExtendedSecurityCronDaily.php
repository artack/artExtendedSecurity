<?php

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
 * Class ExtendedSecurityCronDaily
 *
 * Cron class.
 * @copyright  ARTACK WebLab GmbH 2012
 * @author     Patrick Landolt <http://www.artack.ch>
 * @package    art_security
 */
class ExtendedSecurityCronDaily extends Frontend
{

    protected $maximumPasswordAge;


    protected function __construct() {
        parent::__construct();
        $this->maximumPasswordAge = ($GLOBALS['TL_CONFIG']['extended_security_maximum_password_age']) ? $GLOBALS['TL_CONFIG']['extended_security_maximum_password_age'] : 90;
    }

    
    public function checkForPasswordAge()
    {
        $objUser = $this->Database->prepare("SELECT id, dateAdded, pwChangeTstamp FROM tl_user")->execute();
        while ($objUser->next())
        {
            $lastPwChange = ($objUser->pwChangeTstamp) ? $objUser->pwChangeTstamp : $objUser->dateAdded;
            
            $lastChangeDate = new DateTime('@'.$lastPwChange);
            $nowDate        = new DateTime("now", new DateTimeZone('UTC'));
            
            $dateDiff = $lastChangeDate->diff($nowDate);
            if ($dateDiff->days >= $this->maximumPasswordAge)
            {
                $this->Database->prepare("UPDATE tl_user SET pwChange = ? WHERE id = ?")->execute(1, $objUser->id);
            }
        }
    }
    
}