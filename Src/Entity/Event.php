<?php

class Event 
{

    public int $id;
    public string $title;
    public string $description;
    public string $date;
    public string $time;
    public string $location;
    public string $image;
    public string $type;
    public array $keywords;

    public function __construct($id, $title, $description, $date, $time, $location, $image, $type, $keywords) 
    {
        
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
        $this->time = $time;
        $this->location = $location;
        $this->image = $image;
        $this->type = $type;
        $this->keywords = $keywords;
    }
}