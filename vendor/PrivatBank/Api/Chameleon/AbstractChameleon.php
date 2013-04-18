<?php

namespace PrivatBank\Api\Chameleon;

use PrivatBank\Root\Service\AbstractServiceXmlRequestXml as AbstractServiceXmlRequestXml;

/**
 * Ребота с Проминем
 * http://10.1.99.58/wiki/index.php?title=ChameleonServer
 */
abstract class AbstractChameleon extends AbstractServiceXmlRequestXml
{
    use SetServices;
}