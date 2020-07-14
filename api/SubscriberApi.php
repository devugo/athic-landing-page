<?php

class SubscriberApi {

    private $requestMethod;
    private $rules = array(
        'email' => array(
            'required' => true,
            'unique' => 'subscribers',
            'email' => true
        )
    );

    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getAllSubscribers();
                break;
            case 'POST':
                $response = $this->createSubscriberFromRequest();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function createSubscriberFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        
        $validate = new Validate();
        $validation = $validate->check($input, $this->rules);
        if($validation->passed()){
            $subscriber = new Subscriber();
            try {
                $subscriber->create(array(
                    'email' => $input['email'],
                    'created_at' => date('Y-m-d H:i:s')
                ));
                $response['status_code_header'] = 'HTTP/1.1 201 Created';
                $response['body'] = json_encode(
                    array(
                        'email' => $input['email'],
                        'created_at' => date('Y-m-d H:i:s')
                    )
                );
                
            }catch(Exception $e){
                die($e->getMessage());
            }
        }else{
            $response['status_code_header'] = 'HTTP/1.1 403 Failed Validation';
            $response['body'] = json_encode($validation->errors());
        }
        return $response;
    }

   

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}