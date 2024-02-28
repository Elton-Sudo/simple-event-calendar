<?php

class Event 
{

    public $id;
    public $title;
    public $description;
    public $date;
    public $time;
    public $location;
    public $image;
    public $type;
    public $keywords;

    public function __construct(
        $id, 
        $title, 
        $description, 
        $date, 
        $time, 
        $location, 
        $image, 
        $type, 
        $keywords
    ) 
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