<?php

namespace Model;

use Core\Db;
use Model\ModelAbstract;

class Message extends ModelAbstract
{
    public const TABLE_NAME = 'message';

    private $recipient_id;
    private $receiver_id;
    private $subject;
    private $text;
    private $status;
    private $created_at;
    private $updated_at;
    private $seen;

    public function getUserMessages($user_id, $seen = null)
    {
        $db = new Db();

        $result = $db -> select('message.id, message.recipient_id, message.subject, message.created_at, message.seen, user.name') -> from(self::TABLE_NAME);
        $result -> left('user') -> on(self::TABLE_NAME, 'recipient_id', 'user', 'id');

        $result -> where('receiver_id', $user_id);
        if ($seen !== null) {
            $result -> whereAnd('seen', $seen);
        }

        return $result -> get();
    }

    public function load($id)
    {
        $db = new Db;
        $result = $db -> select() -> from(self::TABLE_NAME) -> where(self::ID_COLUMN, $id) -> getOne();
        $this -> id = $result[self::ID_COLUMN];
        $this -> recipient_id = $result['recipient_id'];
        $this -> receiver_id = $result['receiver_id'];
        $this -> subject = $result['subject'];
        $this -> text = $result['text'];
        $this -> updated_at = $result['updated_at'];
        $this -> seen = $result['seen'];
        $this -> created_at = $result['created_at'];

        return $this;
    }

    public function prepeareArray()
    {
        return [
            'recipient_id' => $this -> recipient_id,
            'receiver_id' => $this -> receiver_id,
            'subject' => $this -> subject,
            'text' => $this -> text,
            'seen' => $this -> seen,
        ];
    }

    /**
     * @return mixed
     */
    public function getRecipientId()
    {
        return $this -> recipient_id;
    }

    /**
     * @param mixed $recipient_id
     */
    public function setRecipientId($recipient_id): void
    {
        $this -> recipient_id = $recipient_id;
    }

    /**
     * @return mixed
     */
    public function getReceiverId()
    {
        return $this -> receiver_id;
    }

    /**
     * @param mixed $receiver_id
     */
    public function setReceiverId($receiver_id): void
    {
        $this -> receiver_id = $receiver_id;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this -> subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this -> subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this -> text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this -> text = $text;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this -> status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this -> status = $status;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this -> created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this -> created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this -> updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this -> updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getSeen()
    {
        return $this -> seen;
    }

    /**
     * @param mixed $seen
     */
    public function setSeen($seen): void
    {
        $this -> seen = $seen;
    }

}