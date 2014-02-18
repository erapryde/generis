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
 * Copyright (c) 2014 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *
 * @author Joel Bout, <joel@taotesting.com>
 * @license GPLv2
 * @package generis
 *
 */
class helpers_ExtensionHelper{
    
    public static function sortByDependencies($extensions) {
        $sorted = array();
        $unsorted = array();
        foreach ($extensions as $ext) {
            $unsorted[$ext->getId()] = array_keys($ext->getDependencies());
        }
        while (!empty($unsorted)) {
            foreach (array_keys($unsorted) as $id) {
                $missing = array_diff($unsorted[$id], $sorted);
                if (empty($missing)) {
                    $sorted[] = $id;
                    unset($unsorted[$id]);
                }
            }
        }
        
        $returnValue = array();
        foreach ($sorted as $id) {
            foreach ($extensions as $ext) {
                if ($ext->getId() == $id) {
                    $returnValue[$id] = $ext;
                }
            }
        }
        return $returnValue;
    }
    
    public static function sortById($extensions) {
        usort($extensions, function($a, $b) {
            return strcasecmp($a->getId(),$b->getId());
        });
        return $extensions;
    }
    
    
}