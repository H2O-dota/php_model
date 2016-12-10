<?php
//策略模式

//收费的类型接口
interface costStrategy{
    //返回收费类型
    public function chargeType();
    //获取课程的费用
    public function cost(Lesson $lesson);
}

//抽象课程类
abstract class Lesson{
    private $duration; //课程周期
    private $costStrategy; //收费类型

    public function __construct($duration, costStrategy $costStrategy)
    {
        $this->costStrategy = $costStrategy;
        $this->duration = $duration;
    }


    public function cost()
    {
        return $this->costStrategy->cost($this);
    }

    public function chargeType()
    {
        return $this->costStrategy->chargeType();
    }

    public function getDuration()
    {
        return $this->duration;
    }

}

//固定收费
class FixedCostStrategy implements costStrategy
{
    public function cost(Lesson $lesson)
    {
        return 300;
    }

    public function chargeType()
    {
        return "fixed cost";
    }
}

//时间收费
class TimeCostStrategy implements costStrategy
{
    public function cost(Lesson $lesson)
    {
        //课程周期 乘以 课程单价
        return $lesson->getDuration()*10;
    }

    public function chargeType()
    {
        return 'time cost';
    }
}


//演讲课程
class Lecture extends Lesson
{

}

//研究性课程
class Seminar extends Lesson
{

}


$lessons[] = new Seminar(10,new TimeCostStrategy());
$lessons[] = new Lecture(10,new FixedCostStrategy());

foreach($lessons as $lesson)
{
    echo $lesson->chargeType()."---".$lesson->cost($lesson).PHP_EOL;
}


