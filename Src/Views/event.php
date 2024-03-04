<div class="event-details">
    <img src="<?php echo esc_attr($event->image); ?>" alt="<?php echo esc_attr($event->title); ?>">
    <h2><?= $event->title ?></h2>
    <p><strong>Description:</strong> <?= $event->description ?></p>
    <p><strong>Date:</strong> <?= $event->date ?></p>
    <p><strong>Time:</strong> <?= $event->time ?></p>
    <p><strong>Location:</strong> <?= $event->location ?></p>
</div>