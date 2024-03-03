<?php

class DefaultController extends Controller
{

    private $repo;

    public function __construct()
    {

        $this->repo = $this->loadRepository('EventRepository');
    }

    public function index(): void
    {
        
        $events = $this->repo->getAllEvents();
        $this->view("events", [
            'events' => $events
        ]);
    }

    public function showEvent($id): void
    {
        
        $event = $this->repo->getEventById($id);
        $this->view("showEvent", [
            'event' => $event
        ]);
    }

    public function filter($type): void
    {
        
        $events_by_type = $this->repo->getEventsByType($type);
        $this->view("show", [
            'events_by_type' => $events_by_type
        ]);
    }
}