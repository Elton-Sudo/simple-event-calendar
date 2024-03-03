<?php

class AdminController extends Controller
{
    private static $event_repo;

    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_menu']);
        self::$event_repo = self::loadRepository('EventRepository');
    }

    public static function register_menu()
    {
        add_menu_page(
            'Simple Event Calendar Settings',
            'Event Calendar',
            'manage_options',
            'simple-event-calendar-settings',
            [self::class, 'settings_page'],
            'dashicons-calendar',
            30
        );
    }

    public static function settings_page()
    {

        $admin_controller = new self();

        if (isset($_GET['action'])) {

            if ($_GET['action'] === 'edit_event') {

                $event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
                $event = self::$event_repo->getEventById($event_id);
    
                return $admin_controller->view("Admin/edit-event", ["event" => $event]);
            } elseif ($_GET['action'] === 'add_event') {
                
                return $admin_controller->view("Admin/add-event", []);
            }
        }
        
        $events = self::$event_repo->getAllEventTypes(); 
        return $admin_controller->view("Admin/index", ["events" => $events]);
    }
}
