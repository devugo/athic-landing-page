<?php

    class Subscriber
    {
        private $_db,
                $_data;

        public function __construct($subscriber = null){
            $this->_db = DB::getInstance();
        }

        public function create($fields = array()) {
            if(!$this->_db->insert('subscribers', $fields)){
                throw new Exception('There was a problem creating an account.');
            }
        }

        public function find($subscriber = null) {
            if($subscriber){
                $field = (is_numeric($subscriber)) ? 'id' : 'email';
                $data = $this->_db->get('subscribers', array($field, '=', $subscriber));
                // return $data->results();

                if($data->count()){
                    $this->_data = $data->first();
                    return $this->data();
                }
            }
            return false;
        }

        public function all() {
            $data = $this->_db->get('subscribers', array());

            if($data->count()){
                $this->_data = $data->results();
                return $this->data();
            }
            return false;
        }

        public function exists(){
            return (!empty($this->_data)) ? true : false;
        }

        public function data(){
            return $this->_data;
        }
    }