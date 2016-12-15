<?php

//访问者模式

/**
访问者模式：表示一个作用于某对象结构中的各元素的操作。它可以在不改变各元素的类的前提下
定义作用于这些元素的新操作。
 */

/**
我们来简单分析一下电商的客户，可能有企业客户还有个人用户。现在我们需要分析一下每个客户的
购买偏好。并且不想把具体的实现封装在具体的元素对象中，因为实际上不可能只有两种客户，可能很多，
如果我要添加一个通用的功能，把具体功能封装在对象中，太不便于管理了。

对企业客户和个人客户的请求做不同处理。

 */

/**
 *客户抽象接口
 *@author li.yonghuan
 *@version 2014.01.22
 *
 */
abstract class Customer {
    /**
     *客户id
     *@var int
     */
    protected $customerId;

    /**
     *客户姓名
     *@var string
     *
     */
    protected $customerName;

    /**
     *接受访问者的访问
     *@param $visitor ServiceRequestVisitor
     */
    public abstract function accept( ServiceRequestVisitor $visitor );
}

/**
 *具体元素，企业客户
 *@author li.yonghuan
 *@version 2014.01.22
 */
class EnterpriseCustomer extends Customer {
    /**
     *接受访问者
     *@param $visitor Servicerequestvisitor
     */
    public function accept( ServiceRequestVisitor $visitor ) {
        $visitor->visitEnerpriseCustomer($this);
    }
}

/**
 *具体元素，个人客户
 *@author li.yonghuan
 *@version 2014.01.22
 */
class PersonalCustomer extends Customer {
    /**
     *接受访问者
     *@author li.yonghuan
     *@version 2014.01.22
     */
    public function accept( ServiceRequestVisitor $visitor ) {
        $visitor->visitPersonalCustomer($this);
    }
}

/**
 *访问者接口
 *@author li.yonghuan
 *@version 2014.01.22
 */
interface Visitor {

    /**
     *访问企业用户
     *@param $ec EnterpriseCustomer
     */
    public function visitEnerpriseCustomer( EnterpriseCustomer $ec );

    /**
     *访问个人用户
     *@param $pc PersonalCustomer
     */
    public function visitPersonalCustomer( PersonalCustomer $pc );
}

/**
 *具体的访问者
 *对服务提出请求
 *@author li.yonghuan
 *@version 2014.01.22
 */
class ServiceRequestVisitor implements Visitor {
    /**
     *访问企业客户
     *@param $ec EnterpriseCustomer
     */
    public function visitEnerpriseCustomer( EnterpriseCustomer $ec ) {
        echo $ec->name.'企业提出服务请求。</br>';
    }

    /**
     *访问个人用户
     *@param $pc PersonalCustomer
     */
    public function visitPersonalCustomer( PersonalCustomer $pc ) {
        echo '客户'.$pc->name.'提出请求。</br>';
    }
}

/**
 *对象结构
 *存储要访问的对象
 *@author li.yonghuan
 *@version 2014.01.22
 */
class ObjectStructure {
    /**
     *存储客户对象
     *@var array
     */
    private $obj = array();

    /**
     *向对象结构中添加对象元素
     *@param $ele Customer
     */
    public function addElement( $ele ) {
        array_push($this->obj, $ele);
    }

    /**
     *处理请求
     *@param $visitor Visitor
     */
    public function handleRequest( Visitor $visitor ) {
        //遍历对象结构中的元素，接受访问
        foreach( $this->obj as $ele ) {
            $ele->accept( $visitor );
        }
    }
}

/*测试*/
header('Content-Type: text/html; charset=utf-8');
//对象结构
$os = new ObjectStructure();

//添加元素
$ele1 = new EnterpriseCustomer();
$ele1->name = 'ABC集团';
$os->addElement( $ele1 );

$ele2 = new EnterpriseCustomer();
$ele2->name = 'DEF集团';
$os->addElement( $ele2 );

$ele3 = new PersonalCustomer();
$ele3->name = '张三';
$os->addElement( $ele3 );

//客户提出服务请求
$serviceVisitor = new ServiceRequestVisitor();
$os->handleRequest( $serviceVisitor );