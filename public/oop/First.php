<?php
include "phpqrcode/qrlib.php";
//class Aa
//{
//    function foo()
//    {
//        if (isset($this)) {
//            echo '$this определена (';
//            echo get_class($this);
//            echo ")\n";
//        } else {
//            echo "\$this не определена.\n";
//        }
//    }
//}
//
//class B
//{
//    function bar()
//    {
//        Aa::foo();
//    }
//}
//
//$a = new Aa();
//$a->foo();
//Aa::foo();
//$b = new B();
//$b->bar();
//B::bar();
//
//class SimpleClass
//{
//    public $a = 7;
//}
//
//$instance = new SimpleClass();
//$assigned = $instance;
//var_dump($instance);
//var_dump($assigned);
//$reference =& $b;
//var_dump($reference);
//$instance->var = '$assigned будет иметь это значение';
//$instance = null;
//
//print_r($instance);
//var_dump($reference);
//var_dump($assigned);
//
//class Test1
//{
//    public $a = 5;
//
//    public function a()
//    {
//        echo 'as';
//    }
//
//    static public function getNew()
//    {
//
//        return new static;
//    }
//}
//
//class Child extends Test1
//{
//}
//
//$obj1 = new Test1();
//$obj2 = new $obj1;
//var_dump($obj1 !== $obj2);
//$obj3 = Test1::getNew();
//var_dump($obj3 instanceof Test1);
//
//
//class Foo
//{
//    public $bar = 'property';
//
//    public function bar()
//    {
//        return 'method';
//    }
//}
//
//$obj = new Foo();
//echo $obj->bar, PHP_EOL, $obj->bar(), PHP_EOL;
//
//class Foo1
//{
//    public $bar;
//
//    public function __construct()
//    {
//        $this->bar = function () {
//            return 42;
//        };
//    }
//}
//
//$obj = new Foo1();
//
//$func = $obj->bar;
//echo $func(), PHP_EOL;
//
//class A1
//{
//    public $bar = 1;
//
//    public function bar()
//    {
//        return 'method';
//    }
//}
//
//;
//
//class B1 extends A1
//{
//    public $bar2;
//
//    public function bar2($a)
//    {
//        echo 'method2' . $a;
//    }
//}
//
//;
//
//class C1 extends B1
//{
//    public $bar3;
//    public $bar4 = <<<'EOT'
//bar
//EOT;
//
//    public function bar2($a)
//    {
//        echo 'method3' . $a;
//        parent::bar2('f');
//    }
//}
//
//;
//
//$class3 = new C1;
//$class2 = new B1;
//$class3->bar2(56);
////echo $class2->bar2(56);
//echo $class3->bar4;
//echo C1::class;
//
//class MyClass
//{
//    private $foo = FALSE;
//
//    public function __construct()
//    {
//        $this->foo = TRUE;
//
//        echo($this->foo);
//    }
//}
//
//$bar = new MyClass();
//
//class MyClass1
//{
//    const CONSTANT = 'значение константы';
//
//    function showConstant()
//    {
//        echo self::CONSTANT . "\n";
//    }
//}
//
//echo MyClass1::CONSTANT . "\n";
//
//$classname = "MyClass1";
//echo $classname::CONSTANT . "\n"; // начиная с версии PHP 5.3.0
//
//$class = new MyClass1();
//$class->showConstant();
//
//echo $class::CONSTANT . "\n"; // начиная с версии PHP 5.3.
//
//const ONE = 1;
//
//class fooa
//{
//    // С версии PHP 5.6.0
//    const ONE = 1;
//
//    const TWO = ONE * 2;
//    const THREE = ONE + self::TWO;
//    const SENTENCE = 'The value of THREE is ' . self::THREE;
//}
//
//echo $a = fooa::class;
//echo fooa::ONE;
//echo foa2::class;
//
//echo __NAMESPACE__;
//spl_autoload_register(function ($name) {
//    echo "Хочу загрузить $name.\n";
//    throw new Exception("Невозможно загрузить $name.");
//});
//
//try {
//    $obj = new test();
//} catch (Exception $e) {
//    echo $e->getMessage(), "\n";
//
//    class BaseClass
//    {
//        public $a = 5;
//
//        function __construct()
//        {
//            print "Конструктор класса BaseClass\n";
//        }
//    }
//
//    class SubClass extends BaseClass
//    {
//        function __construct()
//        {
//            parent::__construct();
//            print "Конструктор класса SubClass\n";
//        }
//    }
//
////
////    $obj = new BaseClass();
////    $obj = new SubClass();
//    class OtherSubClass extends SubClass
//    {
//        function __construct()
//        {
//            parent::__construct();
//            print "Конструктор класса OtherSubClass\n";
//        }
//    }
//
//    $obj = new OtherSubClass();
//    echo $obj->a;
//
////    class MyDestructableClass
////    {
////        function __construct()
////        {
////            print "Конструктор\n";
////            $this->name = "MyDestructableClass";
////        }
////
////        function __destruct()
////        {
////            print "Уничтожается " . $this->name . "\n";
////        }
////    }
////
////    $obj = new MyDestructableClass();
//
//    class A
//    {
//        function __construct()
//        {
//            $a = func_get_args();
//            $i = func_num_args();
//            if (method_exists($this, $f = '__construct' . $i)) {
//                call_user_func_array(array($this, $f), $a);
//            }
//        }
//
//        function __construct1($a1)
//        {
//            echo('__construct with 1 param called: ' . $a1 . PHP_EOL);
//        }
//
//        function __construct2($a1, $a2)
//        {
//            echo('__construct with 2 params called: ' . $a1 . ',' . $a2 . PHP_EOL);
//        }
//
//        function __construct3($a1, $a2, $a3)
//        {
//            echo('__construct with 3 params called: ' . $a1 . ',' . $a2 . ',' . $a3 . PHP_EOL);
//        }
//
//
//    }
//
//    $o = new A('sheep');
//    $o = new A('sheep', 'cat');
//    $o = new A('sheep', 'cat', 'dog');
//    abstract class base1 {
//        public function inherited() {
//            $this->overridden();
//        }
//        protected function overridden() {
//            echo 'base';
//        }
//    }
//
//    class child1 extends base1 {
//        protected function overridden() {
//            echo 'child';
//        }
//    }
//
//    $test = new child1();
//    $test->inherited();
//
//
//    class Foo55
//    {
//        public function printItem($string)
//        {
//            echo 'Foo: ' . $string . PHP_EOL;
//        }
//
//        public function printPHP()
//        {
//            echo 'PHP is great.' . PHP_EOL;
//        }
//    }
//
//    class Bar extends Foo55
//    {
//        public function printItem($string)
//        {
//            echo 'Bar: ' . $string . PHP_EOL;
//        }
//    }
//
//    $foo = new Foo55();
//    $bar = new Bar();
//    $foo->printItem('baz'); // Выведет: 'Foo: baz'
//    $foo->printPHP();       // Выведет: 'PHP is great'
//    $bar->printItem('baz'); // Выведет: 'Bar: baz'
//    $bar->printPHP();       //

//    class foo
//    {
//        public function something()
//        {
//            echo __CLASS__; // foo
//            var_dump($this);
//        }
//    }
//
//    class foo_bar extends foo
//    {
//        public function something()
//        {
//            echo __CLASS__; // foo_bar
//            var_dump($this);
//        }
//    }
//
//    class foo_bar_baz extends foo_bar
//    {
//        public function something()
//        {
//            echo __CLASS__; // foo_bar_baz
//            var_dump($this);
//        }
//
//        public function call()
//        {
//            echo self::something(); // self
//            echo parent::something(); // parent
//            echo foo::something(); // grandparent
//        }
//    }
//
//    error_reporting(-1);
//
//    $obj = new foo_bar_baz();
//    $obj->call();
//class a {
////    public $data='dfdfdfsdf';
//    public function one(array $options = []){
//        echo $data;
//    }
//}
//class b extends a {
////    public $arr=[1,2,4];
//      public function one($arr){
//       print_r ($arr);
//          parent::one('dsfsdf');
//    }
//}
//$a=new a();
//$b=new b();
//$b->one([1,8]);

//опционный аррай
//
//function makecoffee($types = array("капуччино"), $coffeeMaker = NULL)
//{
//    $device = is_null($coffeeMaker) ? "вручную" : $coffeeMaker;
//    return "Готовлю чашку ".join(", ", $types)." $device.\n";
//}
//echo makecoffee();
//echo makecoffee(array("капуччино", "лавацца"), "в чайнике");
QRcode::png("http://blog.local", "test1.png", "L", 4, 4);
//QRcode::png("https://mail.google.com/mail/u/0/#inbox/15b0f220df83b8fc");

?>