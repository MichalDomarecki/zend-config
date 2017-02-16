<?php
/**
 * @see       https://github.com/zendframework/zend-config for the canonical source repository
 * @copyright Copyright (c) 2005-2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-config/blob/master/LICENSE.md New BSD License
 */

namespace Zend\Config\Writer;

use Zend\Config\Exception;
use Zend\Json\Json as JsonFormat;

class Json extends AbstractWriter
{
    /**
     * processConfig(): defined by AbstractWriter.
     *
     * @param  array $config
     * @return string
     * @throws Exception\MissingExtensionException if neither ext/json nor
     *     zendframework/zend-json are available.
     */
    public function processConfig(array $config)
    {
        if (function_exists('json_encode')) {
            return json_encode($config);
        }

        if (class_exists(JsonFormat::class)) {
            return JsonFormat::encode($config);
        }

        throw new Exception\MissingExtensionException(
            'Cannot write JSON config: missing ext/json. Compile PHP with '
            . 'ext/json, or install zendframework/zend-json'
        );
    }
}
