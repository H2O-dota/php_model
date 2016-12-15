<?php

//外观模式：通过在必要的逻辑和方法的集合前创建简单的外观接口，隐藏调用对象的复杂性。

class User{
    protected $name;
    
    protected $age;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }
}

//通过外观模式，得到user实例
//减少了生产user实力内部的实现
class UserFacade{
    public static function getUser(array $array)
    {
        $user = new User();
        $user->setAge($array['age']);
        $user->setName($array['name']);
        return $user;
    }
}
$user = UserFacade::getUser(['name'=>'xck','age'=>18]);

var_dump($user);



