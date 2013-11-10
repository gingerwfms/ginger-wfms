<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Util;
/**
 * Util class
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class Util
{
    public static function getType($mixed)
    {
        if (is_null($mixed)) {
            return 'null';
        }
        
        return (is_object($mixed))? get_class($mixed) : gettype($mixed);
    }
}
