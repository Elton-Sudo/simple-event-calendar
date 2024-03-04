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

        $admin_controller->view("Button/index", [
            'uri' => esc_url(add_query_arg(['action' => 'add_event'])),
            'title' => 'Add New'
        ]);

        if (isset($_GET['action'])) {

            $message = '';
            if (isset($_POST['submit_event'])) {

                $message = self::handle_add_event();
            }

            if (isset($_POST['update_event'])) {

                $message = self::handle_update_event();
            }

            if ($_GET['action'] === 'add_event') {
                
                return $admin_controller->view("Admin/add-event", []);
            } else if ($_GET['action'] === 'edit_event') {

                $event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
                $event = self::$event_repo->getEventById($event_id);
    
                return $admin_controller->view("Admin/edit-event", ["event" => $event]);
            } else if ($_GET['action'] === 'delete_event') {

                $event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
                if (self::$event_repo->deleteEvent($event_id)) {

                    $message = 'Event deleted successfully.';
                }
            }
        
            if (!empty($message)) {
                add_action('admin_notices', function () use ($message) {
                    echo '<div class="notice notice-success is-dismissible"><p>' . esc_html($message) . '</p></div>';
                });
            }
        }
        
        $all_events = self::$event_repo->getAllEvents(); 
        return $admin_controller->view("Admin/index", [
            'events' => $all_events,
        ]);
    }

    private static function handle_add_event()
    { 

        $title = sanitize_text_field($_POST['title']);
        $description = sanitize_textarea_field($_POST['description']);
        $date = sanitize_text_field($_POST['date']);
        $time = sanitize_text_field($_POST['time']);
        $location = sanitize_text_field($_POST['location']);

        $image_url = '';
        $upload_dir = wp_upload_dir();
        $upload_path = $upload_dir['path'];
    
        if (!file_exists($upload_path)) {
            
            if (!wp_mkdir_p($upload_path)) {
                
                echo "Could not create directory. Permission Denied!";
                return;
            }
        }
    
        $uploaded_file = $_FILES['image'];
        $image_filename = basename($uploaded_file['name']);
        $image_path = $upload_path . '/' . $image_filename;
        if (move_uploaded_file($uploaded_file['tmp_name'], $image_path)) {
            $image_url = $upload_dir['url'] . '/' . $image_filename;
        }

        $type = sanitize_text_field($_POST['type']);
        $keywords = sanitize_text_field(isset($_POST['keywords']) ? $_POST['keywords'] : []);
    
        $event = new Event(null, $title, $description, $date, $time, $location, $image_url, $type);
    
        self::$event_repo->createEvent($event);

        return 'Event added successfully.';
    }

    private static function handle_update_event()
    {

        $event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
        $title = isset($_POST['event_title']) ? sanitize_text_field($_POST['event_title']) : '';
        $description = isset($_POST['event_description']) ? sanitize_textarea_field($_POST['event_description']) : '';
        $date = isset($_POST['event_date']) ? sanitize_text_field($_POST['event_date']) : '';
        $time = isset($_POST['event_time']) ? sanitize_text_field($_POST['event_time']) : '';
        $location = isset($_POST['event_location']) ? sanitize_text_field($_POST['event_location']) : '';

        $image_url = '';
        if (!empty($_FILES['event_image']['name'])) {
            $upload_dir = wp_upload_dir();
            $upload_path = $upload_dir['path'];
            $uploaded_file = $_FILES['event_image'];
            $image_filename = basename($uploaded_file['name']);
            $image_path = $upload_path . '/' . $image_filename;
            if (move_uploaded_file($uploaded_file['tmp_name'], $image_path)) {
                $image_url = $upload_dir['url'] . '/' . $image_filename;
            }
        }

        $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
        $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : [];

        $event = new Event($event_id, $title, $description, $date, $time, $location, $image_url ?? $_POST['current_image'], $type);
    
        self::$event_repo->updateEvent($event);

        return 'Event updated successfully.';
    }
}
