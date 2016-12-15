<?php

//观察者模式 : 当对象发生变化是，其他的对象也发生变化
//php SPL中定义了SplSubject 和 SplObserver 接口

//项目类
class Subject implements SplSubject
{
    private $observers = [];

    public function attach(SplObserver $observer)
    {
        array_push($this->observers,$observer);
    }

    public function detach(SplObserver $observer)
    {
       if($index=array_search($observer,$this->observers)){
           unset($this->observers[$index]);
       }else{
           throw new Exception('this observer not have');
       }
    }

    public function notify()
    {
        /**
         * @var $observer Observer
         */
        foreach($this->observers as $observer){
            $observer->setAge(mt_rand(100,999));
        }
    }
}

//观察者
class Observer implements SplObserver
{
    private $age;

    public function __construct($age)
    {
        $this->age = $age;
    }

    public function update(SplSubject $subject)
    {
        $subject->notify();
    }

    public function setAge($age)
    {
        $this->age = md5($age);
    }

    public function getAge()
    {
        return $this->age;
    }
}

$subject = new Subject();

$observer1 = new Observer(10);
$observer2 = new Observer(20);
$observer3 = new Observer(30);

echo $observer1->getAge().PHP_EOL;
echo $observer2->getAge().PHP_EOL;
echo $observer3->getAge().PHP_EOL;

$subject->attach($observer1);
$subject->attach($observer2);
$subject->attach($observer3);

//当其中一个观察者发生变化是，其他的观察者也发生变化
$observer1->update($subject);

echo $observer1->getAge().PHP_EOL;
echo $observer2->getAge().PHP_EOL;
echo $observer3->getAge();
