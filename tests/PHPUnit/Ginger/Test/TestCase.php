<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Test;

use PHPUnit_Framework_TestCase;
use Zend\Db\Adapter\Adapter;
/**
 *  TestCase
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @return Adapter
     */
    protected function initCrudDatabase()
    {
        $adapter = new Adapter(array(
            'driver' => 'Pdo_Sqlite',
            'database' => ':memory:'
         ));
        
        $adapter->query(
            'CREATE TABLE workflow '
            . '('
                . 'id INTEGER PRIMARY KEY AUTOINCREMENT,'
                . 'data TEXT'
            . ')'
        )->execute();
        
        return $adapter;
    }
}
