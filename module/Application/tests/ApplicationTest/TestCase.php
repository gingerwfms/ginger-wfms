<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ApplicationTest;

use PHPUnit_Framework_TestCase;
/**
 *  TestCase
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class TestCase extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        chdir(realpath(__DIR__ . '/../../../..'));
    }
}
