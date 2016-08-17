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
 * Copyright (c) 2015 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 * 
 */

use Interop\Container\ContainerInterface;
use oat\oatbox\action\Action;
use oat\oatbox\event\EventManager;
use oat\oatbox\service\ServiceManager;
use oat\oatbox\service\ServiceManagerAwareInterface;
use oat\oatbox\service\ServiceManagerAwareTrait;
/**
 * Abstract action containing some helper functions
 * @author bout
 *
 */
abstract class common_ext_action_InstallAction implements Action, ServiceManagerAwareInterface
{
    use ServiceManagerAwareTrait;
    
    /**
     * 
     * @param mixed $event either an Event object or a string
     * @param Callable $callback
     */
    public function registerEvent($event, $callback)
    {
        $eventManager = $this->getServiceLocator()->get(EventManager::CONFIG_ID);
        $eventManager->attach($event, $callback);
        $this->getServiceManager()->register(EventManager::CONFIG_ID, $eventManager);
    }
    
    public function registerService($serviceKey, $service)
    {
        if ($service instanceof ServiceManagerAwareInterface) {
            $service->setServiceLocator($this->getServiceManager());
        }
        $this->getServiceManager()->register($serviceKey, $service);
    }
    
    /**
     * 
     * @throws common_exception_Error
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        $serviceManager = $this->getServiceLocator();
        if (!$serviceManager instanceof ContainerInterface ) {
            throw new common_exception_Error('Alternate service locator not compatible with '.__CLASS__);
        }
        return $serviceManager;
    }
}
