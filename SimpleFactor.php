<?php
//简单工厂模式
abstract class Operator
{
    abstract public function getValue($value1, $value2);
}

class OperatorAdd extends Operator
{
    public function getValue($value1, $value2)
    {
        return $value1+$value2;
    }
}

class OperatorSub extends Operator
{
    public function getValue($value1, $value2)
    {
        return $value1-$value2;
    }
}

class SimpleFactory
{
    static public function createOperator($type)
    {
        switch($type)
        {
            case '+':
                return new OperatorAdd();
            case '-':
                return new SimpleFactory();
        }
    }
}

$add = SimpleFactory::createOperator('+');

echo $add->getValue(10,80);
