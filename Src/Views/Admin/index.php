<h2>Event Management</h2>

<div class="wrap">
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Type</th>
                <!-- TODO keywords -->
                <!-- <th>Keywords</th> -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($events as $event) : ?>

            <tr>
                <td><?php echo esc_html($event->title); ?></td>
                <td><?php echo esc_html($event->description); ?></td>
                <td><?php echo esc_html($event->date); ?></td>
                <td><?php echo esc_html($event->time); ?></td>
                <td><?php echo esc_html($event->location); ?></td>
                <td><?php echo esc_html($event->type); ?></td>
                <!-- TODO keywords -->
                <!-- <td><?php //echo esc_html(implode(', ', $event->keywords)); ?></td> -->
                <td>
                    <a href="<?php echo esc_url(add_query_arg(['action' => 'edit_event', 'event_id' => $event->id])); ?>">Edit</a>
                    |
                    <a href="<?php echo esc_url(add_query_arg(['action' => 'delete_event', 'event_id' => $event->id])); ?>">Delete</a>
                </td>
            </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
</div>