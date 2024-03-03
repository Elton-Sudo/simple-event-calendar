<h2>Edit Event</h2>
<form method="post" action="">
    <input type="hidden" name="event_id" value="<?php echo esc_attr($event->id); ?>">

    <label for="event_title">Title:</label><br>
    <input type="text" id="event_title" name="event_title" value="<?php echo esc_attr($event->title); ?>"><br>

    <label for="event_description">Description:</label><br>
    <textarea id="event_description" name="event_description"><?php echo esc_textarea($event->description); ?></textarea><br>

    <label for="event_date">Date:</label><br>
    <input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event->date); ?>"><br>

    <label for="event_time">Time:</label><br>
    <input type="time" id="event_time" name="event_time" value="<?php echo esc_attr($event->time); ?>"><br>

    <label for="event_location">Location:</label><br>
    <input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($event->location); ?>"><br>
    
    <input type="submit" name="submit_event" value="Update Event">
</form>