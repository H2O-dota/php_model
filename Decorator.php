<?php

//装饰者模式  decorator
//装饰者模式：动态的讲责任附加到对象上

//抽象饮料类
abstract class Beverage{
    //饮料名称
    public $name;

    //饮料价格
    abstract public function cost();
}

//被装饰者类
class Coffer extends Beverage
{
    public function __construct()
    {
        $this->name = 'Coffer';
    }

    public function cost()
    {
        return 1.00;
    }
}

class CondimentDecorator extends Beverage
{
    public function __construct()
    {
        $this->name = 'Condiment';
    }

    public function cost()
    {
        return 0.1;
    }
}


class Milk extends CondimentDecorator
{
    public $beverage;

    public function __construct(Beverage $beverage)
    {
        $this->name = 'Milk';
        if($beverage instanceof Beverage){
            $this->beverage = $beverage;
        }else{
            exit('Failure');
        }
    }

    public function cost()
    {
        return $this->beverage->cost()+0.2;
    }
}

class Sugar extends CondimentDecorator{
    public $beverage;


    public function __construct(Beverage $beverage){
        $this->name = 'Sugar';
        if($beverage instanceof Beverage){
            $this->beverage = $beverage;
        }else{
            exit('Failure');
        }
    }
    public function Cost(){
        return $this->beverage->Cost() + 0.2;
    }
}


//来杯咖啡
$coffee = new Coffer();

//加点牛奶
$coffee = new Milk($coffee);

//加点糖
$coffee = new Sugar($coffee);

print $coffee->cost();
print $coffee->name;

