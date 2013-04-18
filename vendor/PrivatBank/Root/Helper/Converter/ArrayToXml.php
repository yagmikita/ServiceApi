<?php

namespace PrivatBank\Root\Helper\Converter;

class ArrayToXml implements ConverterInterface
{
    const QUOTE = '"';

    public $baseXmlHeader = array(
        'xml' => array(
            'attributes' => array(
                'version' => '1.0',
                'encoding' => 'utf-8',
            ),
        ),
    );
    protected $_baseXmlheaderParams;
    protected $_toObject;
    protected $_data;
    protected $_xml;


    public function __construct(array $data = array(), array $baseXmlheaderParams = array(), $toObject = false)
    {
        $this->setData($data);
        $this->setBaseXmlHeaderParams($baseXmlheaderParams);
        $this->setMode($toObject);
    }

    public function setData(array $data = array())
    {
        $this->_data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->_data;
    }

    public function setBaseXmlHeaderParams(array $baseXmlheaderParams = array())
    {
        $this->_baseXmlheaderParams = $baseXmlheaderParams;
        return $this;
    }

    public function getBaseXmlHeaderParams()
    {
        return $this->_baseXmlheaderParams;
    }

    public function getXML()
    {
        return $this->_xml;
    }

    public function applyBaseXmlHeader()
    {
        $this->baseXmlHeader['xml']['attributes'] = array_merge(
            $this->baseXmlHeader['xml']['attributes'],
            $this->_baseXmlheaderParams
        );
        $this->_xml = '<?xml' .
                       $this->_stringifyParams( $this->baseXmlHeader['xml']['attributes']) .
                       ' ?>';
        return $this;
    }

    public function setMode($mode)
    {
        $this->_toObject = $mode;
        return $this;
    }

    public function getMode()
    {
        return $this->_toObject;
    }

    /**
     * @return XML String || SimpleXMLElement
     */
    public function convert()
    {
        $this->applyBaseXmlHeader();
        $this->_addNodes($this->_data);
        try {
            $res = $this->_toObject ? @(new \SimpleXMLElement($this->_xml)) : $this->_xml;
            return $res;
        } catch (Exception $e) {
            $res = false;
        }
        return $res;
    }

    /**
     * Defines, if the array represents a single tag or a node
     *
     * @param Array $data
     * @return Enum ['single', 'plural']
     */
    protected function _analizeNodeData(array $data)
    {
        if (isset($data['attributes']))
            unset($data['attributes']);
        if (isset($data['name']))
            unset($data['name']);
        return count($data) ? 'plural' : 'single';
    }

    protected function _stringifyParams(array $params = array())
    {
        $p = array();
        if (count($params)) {
            foreach ($params as $key => $value) {
                $p[] = $key . "=" . static::QUOTE . $value . static::QUOTE;
            }
            return ' ' . implode(' ', $p);
        }
        return '';
    }

    protected function _addNodes(array $data, $childName = 'row')
    {
        foreach ($data as $name => $_data) {
            if ($name !== 'name') {
                $attr = isset($_data['attributes']) ? $_data['attributes'] : array();

                if (isset($_data['name']))
                    $n = is_numeric($name) ? $_data['name'] : $childName;
                else
                    $n = is_numeric($name) ? $_data['name'] : $name;

                if (is_string($_data)) {
                    $this->_openTag($n, $attr)
                         ->_appendPlainText($_data)
                         ->_closeTag($n);
                } elseif ($this->_analizeNodeData($_data) == 'single') {
                    $this->_openTag($n, $attr, true);
                } else {
                    $this->_openTag($n, $attr);
                    unset($_data['attributes']);
                    if (isset($_data['content'])) {
                        $this->_appendPlainText($_data)
                             ->_closeTag($n);
                    } else {
                        $this->_addNodes($_data, isset($data['childName']) ? $data['childName'] : $childName)
                             ->_closeTag($n);
                    }
                }
            }
        }
        return $this;
    }

    protected function _openTag($name, array $params = array(), $closed = false)
    {
        $closer = $closed ? '/>' : '>';
        $this->_xml .= '<' . $name . $this->_stringifyParams($params) . $closer;
        return $this;
    }

    protected function _closeTag($name)
    {
        $this->_xml .= '</' . $name . '>';
        return $this;
    }

    protected function _appendPlainText($text)
    {
        $this->_xml .= $text;
        return $this;
    }

}