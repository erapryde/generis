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

namespace oat\oatbox\extension;

use common_exception_Error;
use oat\oatbox\action\Action;
use oat\oatbox\service\ServiceManager as ServiceManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 * abstract base for extension actions
 *
 * @author Christophe GARCIA <christopheg@taotesting.com>
 */
abstract class AbstractAction implements Action, ServiceLocatorAwareInterface {
    
    use \Zend\ServiceManager\ServiceLocatorAwareTrait;
    
    /**
     * 
     * @throws common_exception_Error
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        $serviceManager = $this->getServiceLocator();
        if (!$serviceManager instanceof ServiceManager) {
            throw new common_exception_Error('Alternate service locator not compatible with '.__CLASS__);
        }
        return $serviceManager;
    }
    
}
