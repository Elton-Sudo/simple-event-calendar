<?php

class EventRepository 
{

    private $table_name;
    private $keywords_table;

    public function __construct() 
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'events';
        $this->keywords_table = $wpdb->prefix . 'event_keywords';
    }

    public function getAllEvents() 
    {   
        global $wpdb;
        $events_data = $wpdb->get_results("SELECT * FROM {$this->table_name}", ARRAY_A);
        
        $events = [];
        foreach ($events_data as $event_data) {
            $event = new Event(
                $event_data['id'],
                $event_data['title'],
                $event_data['description'],
                $event_data['date'],
                $event_data['time'],
                $event_data['location'],
                $event_data['image'],
                $event_data['type'],
                $this->getKeywordsForEvent($event_data['id'])
            );
            $events[] = $event;
        }
    
        return $events;
    }

    public function getAllEventTypes() 
    {   
        
        global $wpdb;
        return $wpdb->get_col("SELECT DISTINCT type FROM {$this->table_name}");
    }

    public function getAllKeywords() 
    {

        global $wpdb;
        return $wpdb->get_col("SELECT DISTINCT keyword FROM {$this->keywords_table}");
    }

    public function getEventsByType(string $type) 
    {

        global $wpdb;
        $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$this->table_name} WHERE type = %s", $type), ARRAY_A);
        $events = [];
        foreach ($results as $row) 
        {
            $events[] = new Event(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['date'],
                $row['time'],
                $row['location'],
                $row['image'],
                $row['type'],
                $this->getKeywordsForEvent($row['id'])
            );
        }
        return $events;
    }

    public function updateEventKeywords(int $eventId, array $keywords) 
    {

        global $wpdb;
        return $wpdb->update($this->keywords_table, ['keywords' => $keywords], ['event_id' => $eventId]);
    }

    private function getKeywordsForEvent(int $eventId) 
    {

        global $wpdb;
        $results = $wpdb->get_results($wpdb->prepare("SELECT keyword FROM {$this->keywords_table} WHERE event_id = %d", $eventId), ARRAY_A);
        return array_column($results, 'keyword');
    }

    public function getEventById(int $id)
    {

        global $wpdb;
        $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$this->table_name} WHERE id = %d", $id), ARRAY_A);
        if ($result) {
            return new Event(
                $result['id'],
                $result['title'],
                $result['description'],
                $result['date'],
                $result['time'],
                $result['location'],
                $result['image'],
                $result['type'],
                $this->getKeywordsForEvent($id)
            );
        }
        return null;
    }

    public function createEvent(Event $event) 
    {

        global $wpdb;
        $wpdb->insert(
            $this->table_name,
            [
                'title' => $event->title,
                'description' => $event->description,
                'date' => $event->date,
                'time' => $event->time,
                'location' => $event->location,
                'image' => $event->image,
                'type' => $event->type,
            ]
        );
        $eventId = $wpdb->insert_id;
        $this->updateEventKeywords($eventId, [$event->keywords]);
    }

    public function updateEvent(Event $event)
    {

        global $wpdb;
        $wpdb->update(
            $this->table_name,
            [
                'title' => $event->title,
                'description' => $event->description,
                'date' => $event->date,
                'time' => $event->time,
                'location' => $event->location,
                'image' => $event->image,
                'type' => $event->type
            ],
            ['id' => $event->id]
        );
        $this->updateEventKeywords($event->id, $event->keywords);
    }

    public function deleteEvent(int $id)
    {

        global $wpdb;
        return $wpdb->delete($this->table_name, ['id' => $id]);
    }
}
