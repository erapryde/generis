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
 * Copyright (c) 2013 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *
 * @author Lionel Lecaque  <lionel@taotesting.com>
 * @license GPLv2
 * @package 
 * @subpackage 
 *
 */
class common_persistence_sql_dbal_Driver implements common_persistence_sql_Driver
{

    protected $connection;

    /**
     * @param array $params
     * @return \Doctrine\DBAL\Connection;
     */
    function connect($id, array $params)
    {
        common_Logger::d('Running Dbal Driver');
        $params['driver'] = str_replace('dbal_', '', $params['driver']);
        $config = new \Doctrine\DBAL\Configuration();
        $this->connection = \Doctrine\DBAL\DriverManager::getConnection($params,$config);
        return new common_persistence_SqlPersistence($params,$this);
    }
    
    
   

    /* (non-PHPdoc)
     * @see common_persistence_sql_Driver::getPlatForm()
     */
    public function getPlatForm(){
        return new common_persistence_sql_dbal_Platform($this->connection->getDatabasePlatform());
    }
    
    /* (non-PHPdoc)
     * @see common_persistence_sql_Driver::getSchemaManager()
     */
    public function getSchemaManager()
    {
        return new common_persistence_sql_dbal_SchemaManager($this->connection->getSchemaManager());
    }
   
    /**
     * @access
     * @author "Lionel Lecaque, <lionel@taotesting.com>"
     * @param mixed $statement
     */
    public function exec($statement,$params = array())
    {
        return $this->connection->executeUpdate($statement,$params);
    }
    
    
    /**
     * @access
     * @author "Lionel Lecaque, <lionel@taotesting.com>"
     * @param mixed $statement
     */
    public function query($statement,$params = array())
    {
        return $this->connection->executeQuery($statement,$params);
    }
    
    /**
     * Convenience access to PDO::quote.
     *
     * @author Jerome Bogaerts, <jerome@taotesting.com>
     * @param string $parameter The parameter to quote.
     * @param int $parameter_type A PDO PARAM_XX constant.
     * @return string The quoted string.
     */
    public function quote($parameter, $parameter_type = PDO::PARAM_STR){
        return $this->connection->quote($parameter, $parameter_type);
    }
    
    

    
    public function insert($tableName, array $data){
        return $this->connection->insert($tableName, $data);
    }
    
    /**
     * Convenience access to PDO::lastInsertId.
     *
     * @author Jerome Bogaerts, <jerome@taotesting.com>
     * @param string $name
     * @return string The quoted string.
     */
    public function lastInsertId($name = null){
        return $this->connection->lastInsertId($name);
    }

    

}