<?php

class DefaultController extends Controller
{

    private $repo;

    public function __construct()
    {
        
        $this->repo = $this->loadRepository('EventRepository');
    }

    public function index()
    {

        if (isset($_GET['event_id'])) {

            $this->showEvent($_GET['event_id']);
        }

        $events = $this->repo->getAllEvents();
        return $this->view("events", [
            'events' => $events
        ]);
    }

    public function showEvent($id)
    {
        $event = $this->repo->getEventById($id);
        return $this->view("event", [
            'event' => $event
        ]);
    }

    // TODO filters
    public function filter($type)
    {
        $events_by_type = $this->repo->getEventsByType($type);
        return $this->view("show", [
            'events_by_type' => $events_by_type
        ]);
    }
}