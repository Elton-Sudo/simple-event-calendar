<div id="wpwrap" class="upcoming-events wrap container">
    <?php foreach ($events as $event) : ?>
        <div class="event-card">
            <div class="event-thumbnail">
                <a href="?event_id=<?= $event->id ?>">
                    <img src="<?php echo esc_attr($event->image); ?>" alt="<?php echo esc_attr($event->title); ?>">
                </a>
            </div>
            <div class="event-details">
                <h3><?php echo esc_html($event->title); ?></h3>
                <p class="event-description"><?php echo esc_html($event->description); ?></p>
                <p class="event-date"><?php echo esc_html($event->date); ?> at <?php echo esc_html($event->time); ?></p>
                <p class="event-location"><?php echo esc_html($event->location); ?></p>
                <p class="event-type">Type: <?php echo esc_html($event->type); ?></p>
                <!-- TODO keywords -->
                <!-- <?php //if (!empty($event->keywords)) : ?>
                    <p class="event-keywords">Keywords: <?php //echo esc_html(implode(', ', $event->keywords)); ?></p>
                <?php //endif; ?> -->
            </div>
        </div>
    <?php endforeach; ?>
</div>
