<?php

namespace PrivatBank\Root\Log;

use Psr\Log\InvalidArgumentException as InvalidArgumentException;

class DbLogger extends LoggerPrototype
{
    protected $_tableName;

    public function __construct($tableName)
    {
        if (strlen($tableName))
            $this->_tableName = $tableName;
        else
            throw new InvalidArgumentException();
    }

    public function log($level, $message, array $context = array())
    {
        $sql = $this->sql($level, $this->_prepare($message, $context));
        try {
            yii::app()->db->createCommand($sql)->execute();
        } catch(Exception $e) {
            throw new SqlException($e->getMessage());
        }
    }

    private function sql($level, $message)
    {
        $sql = 'INSERT INTO `'. $this->_tableName .'` ' .
               '(type, message) ' .
               'VALUES ("'. $level .'", "' . $message . '");';
        return $sql;
    }

}