<?php

class SubscriberApi {

    private $requestMethod;

    //  Validation rules
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
        $inputValues = array(
            'email' => $input['email'],
            'created_at' => date('Y-m-d H:i:s')
        );
        
        $validate = new Validate();
        $validation = $validate->check($input, $this->rules);
        if($validation->passed()){
            $subscriber = new Subscriber();
            try {
                // Save resource
                $subscriber->create($inputValues);

                //  send email
                Mailer::send($input['email'], 'ATHIC SPORT APP', 'Thank you for subscribing to the game changer for professionals and budding sport enthusiasts. You will be notified once our app launches');
                $response['status_code_header'] = 'HTTP/1.1 201 Created';
                $response['body'] = json_encode($inputValues);
                
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