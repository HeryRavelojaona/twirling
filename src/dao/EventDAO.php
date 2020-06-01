<?php

namespace Spac\src\DAO;

use Spac\config\Parameter;
use Spac\src\model\Event;

class EventDAO extends DAO
{
    private function buildObject($row)
    {
        $event = new Event();
        $event->setId($row['id']);
        $event->setTitle($row['title']);
        $event->setPlace($row['place']);
        $event->setAddress($row['address']);
        $event->setUserId($row['user_id']);
        $event->setCategoryId($row['category_id']);
        $event->setFilename($row['filename']);
        $event->setStatus($row['status']);
        $event->setDateStart($row['date_start']);
        $event->setDateEnd($row['date_end']);

        return $event;
    }

    public function showEvents($category)
    {
        //for admin
        $sql = "SELECT event.id , event.title, event.address, event.place , event.filename, event.date_start, event.date_end, event.status, event.user_id, event.category_id FROM event INNER JOIN user ON user.id = event.user_id  WHERE event.category_id = $category ORDER BY event.id DESC";
        
        $result = $this->createQuery($sql);
        $events = [];
        foreach ($result as $row){
            $eventId = $row['id'];
            $events[$eventId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $events;
    }

    public function addEvent(Parameter $post, $userId, $status, $category)
    {  
      
        $sql = 'INSERT INTO event (title, address, place, date_start, comment, user_id, date_end, category_id, status) VALUES (:title, :address, :place, :date_start, :comment, :user_id, :date_end, :category_id, :status)';
        $this->createQuery($sql, 
        ['title'=>$post->get('title'),
         'address'=>$post->get('address'),
         'place'=>$post->get('place'),
         'date_start'=>$post->get('start'),
         'comment'=>$post->get('content'),
         'user_id'=>$userId,
         'date_end'=>$post->get('end'),
         'category_id'=>$category,
         'status'=> $status
         ]);
    }

}