<?php
    class Validate
    {
        private $_passed = false,
                $_errors = array(),
                $_db = null;

        public function __construct(){
            $this->_db = DB::getInstance();
        }

        public function check($source, $items = array()) {
            foreach($items as $item => $rules) {
                foreach($rules as $rule => $rule_value){
                    
                    $value = trim($source[$item]);
                    $item = escape($item);
                    
                    if($rule === 'required' && empty($value)){
                        $this->addError("{$item} is required");
                    }else if(!empty($value)){
                        switch($rule){
                            case 'email':
                                if($rule_value){
                                    if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                                        $this->addError("{$item} {$value} is not a valid email address");
                                    }
                                }
                            break;
                            case 'unique':
                                $check = $this->_db->get($rule_value, array($item, '=', $value));
                                if($check->count()){
                                    // $object = new stdClass();
                                    // $object->$item = "{$item} already exist";
                                    // $this->addError($object);
                                    $this->addError("{$item} already exist.");
                                }
                            break;
                        }
                    }
                }
            }

            if(empty($this->_errors)){
                $this->_passed = true;
            }

            return $this;
        }

        private function addError($error){
            $this->_errors[] = $error;
        }

        public function errors(){
            return $this->_errors;
        }

        public function passed(){
            return $this->_passed;
        }
    }