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

    public function getEventsByType($type) 
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
                $row['type'],
                $this->getKeywordsForEvent($row['id'])
            );
        }

        return $events;
    }

    public function updateEventKeywords($eventId, $keywords) 
    {
        
        global $wpdb;
        return $wpdb->update($this->keywords_table, array('keywords' => $keywords), array('event_id' => $eventId));
    }

    private function getKeywordsForEvent($eventId) 
    {

        global $wpdb;
        $results = $wpdb->get_results($wpdb->prepare("SELECT keyword FROM {$this->keywords_table} WHERE event_id = %d", $eventId), ARRAY_A);
        return array_column($results, 'keyword');
    }

    public function getEventById($id)
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
                $result['keywords']
            );
        }

        return null;
    }

    public function updateEvent(Event $event)
    {

        global $wpdb;
        return $wpdb->update(
            $this->table_name,
            [
                'title' => $event->title,
                'description' => $event->description,
                'date' => $event->date,
                'time' => $event->time,
                'location' => $event->location,
                'image' => $event->image,
                'type' => $event->type,
                'keywords' => $event->keywords
            ],
            ['id' => $event->id]
        );
    }

    public function deleteEvent($id)
    {
        
        global $wpdb;
        return $wpdb->delete($this->table_name, ['id' => $id]);
    }
}