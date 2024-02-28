<?php

class DefaultController extends Controller
{

    private $repo;

    public function __construct()
    {

        $this->repo = $this->loadRepository('EventRepository');

        add_shortcode('upcoming_events', 'index');
        add_shortcode('event_details', 'showEvent');
    }

    public function index(): void
    {
        
        $events = $this->repo->getAllEventTypes();
        $this->view("events", [
            "events" => $events
        ]);
    }

    public function show($type): void
    {
        
        $events_by_type = $this->repo->getEventsByType($type);
        $this->view("show", [
            "events_by_type" => $events_by_type
        ]);
    }

    public function showEvent($id): void
    {
        
        $event = $this->repo->getEventById($id);
        $this->view("showEvent", [
            "event" => $event
        ]);
    }
}