<?php

namespace Controller;

use Core\Controller;

use Helper\FormBuilder;
use Helper\Url;
use Model\User as UserModel;
use Core\Request;
use Helper\Validation\InputValidation as Validation;
use Model\Message as MessageModel;


class Message extends Controller
{
    public function index()
    {
        $user_id = $this -> userSession -> getAuthUserId();

        $messages = new MessageModel();

        $this -> data['messages'] = $messages -> getUserMessages($user_id);

        $this -> render('message/list', $this -> data);
    }

    public function view($id)
    {
        $user_id = $this -> userSession -> getAuthUserId();

        $messages = new MessageModel();

        $message = $messages -> load($id);

        $this -> data['message'] = $message;

        if(($message->getReceiverId() != $user_id) && ($message->getRecipientId() != $user_id)){
            $this -> message -> setSuccessMessage('Message sent');
            Url ::redirect(Url ::make('/message/index'));
        }

        if (($message -> getSeen() == 0) && ($message -> getReceiverId() == $user_id)) {
            $message -> setSeen(1);
            $message -> save();
        }

        $this -> data['form'] =
            (new FormBuilder('post', Url ::make('/message/send/' . $message->getRecipientId())))
                -> input('subject', 'text')
                -> texarea('text')
                -> input('save', 'submit', 'Send') -> get();

        $this -> render('message/view', $this -> data);
    }


    public function send($receiver_id)
    {
        $request = new Request();

        $subject = $request -> getPost('subject');
        $text = $request -> getPost('text');

        //patikrinti sunciama info

        $message = new MessageModel();
        $message -> setReceiverId($receiver_id);
        $message -> setRecipientId($this -> userSession -> getAuthUserId());
        $message -> setSubject($subject);
        $message -> setText($text);
        $message -> save();

        $this -> message -> setSuccessMessage('Message sent');
        Url ::redirect(Url ::make('/user/view/' . $receiver_id));
    }

}
















