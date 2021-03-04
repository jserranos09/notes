<?php
// dont understand this shit

// creating a class. methods are functions inside a class
    class Person{
// public means we can access anywhere from outside the class.
// private can only access within the class
// protected can only access from the class and any extended classes
        private $name;
        private $email;
// creates a class
        public function __construct($name, $email){
            $this->name = $name;
            $this->email = $email;
            echo __CLASS__ . ' created<br>';
        }
// deletes a class
        public function __destruct(){
            echo __CLASS__ . ' destroyed <br>';
        }

        public function setName($name){
// $this->name is going to be = ot the name that is passed in.
            $this->name = $name;
        }

        public function getName(){
// '$this' is used when you want to reference something from within the class
            return $this->name . '<br>';
        }
        
        public function setEmail($email){
// $this->name is going to be = ot the name that is passed in.
            $this->email = $email;
        }
            
        public function getEmail(){
// '$this' is used when you want to reference something from within the class
            return $this->email . '<br>';
        }
    }

    $person1 = new Person('Jonnys', 'test@tast.com');
// '->' is used to a access a property (only works if 'public')
//    $person1->setName('Johnnys'); 
    echo $person1->getName();

//    $person1->name = 'johnny';
//    echo $person1->name;

?>