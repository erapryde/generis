<?php
/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright (c) 2016 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *
 */

namespace oat\oatbox\task\implementation;

use oat\oatbox\task\AbstractTask;
use oat\oatbox\action\Action;

/**
 * Class SyncTask
 *
 * Basic implementation of `AbstractTask` class
 *
 * @package oat\oatbox\task\implementation
 * @author Aleh Hutnikau, <huntikau@1pt.com>
 */
class SyncTask extends AbstractTask
{

    /**
     * SyncTask constructor.
     * @param Action|string $invocable
     * @param array $params
     */
    public function __construct($invocable, $params)
    {
        $this->id = \common_Utils::getNewUri();
        $this->setInvocable($invocable);
        $this->setParameters($params);
        $this->setStatus(self::STATUS_CREATED);
    }
}
