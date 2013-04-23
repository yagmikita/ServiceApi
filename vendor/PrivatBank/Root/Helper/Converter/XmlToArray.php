<?php

namespace PrivatBank\Root\Helper\Converter;

class XmlToArray implements ConverterInterface
{
    protected $_xml;


    public function __construct(\SimpleXMLIterator $data = null)
    {
        $this->setData($data);
    }

    public function setData(\SimpleXMLIterator $data = null)
    {
        $this->_xml = $data;
        return $this;
    }

    public function getData()
    {
        return $this->_xml;
    }

    /**
     * @return Array
     */
    public function convert()
    {
        if (!is_null($_xml)) {
            $name = $this->_xml->getName();
            $res = $this->_iterate($this->_xml);
            return [
                $name => $res,
            ];
        }
        return false;
    }

    private function _iterate(SimpleXMLIterator $data)
    {
        $t = [];
        $_t = [];

        foreach ($data as $key => $node) {
            $_ = [];
            if (count($node->children())) {
                $_ = $this->_iterate($node);
            } else {
                if (trim(strlen((string)$node)))
                    $_['content'] = (string)$node;
            }

            $attr = (array)$node->attributes();
            if (count($attr)) {
                $_['attributes'] = $attr['@attributes'];

            }

            if (isset($_t[$key]) && (isset($_t[$key]['content']) || isset($_t[$key]['attributes']))) {
                $item = $_t[$key];
                $tmp = [];
                $tmp[] = $item;
                $tmp[] = $_;
                $_t[$key] = $tmp;
            } else {
                $_t[$key] = $_;
            }

        }

        $t = $_t;

        return $t;
    }

}