<div class="upcoming-events">
    <?php foreach ($events as $type) : ?>
        <h2><?= $type ?></h2>
        <ul>
            <?php $events = $eventRepository->getEventsByType($type); ?>
            <?php foreach ($events as $event) : ?>
                <li>
                    <a href="<?= get_permalink($event->id) ?>">
                        <?= $event->title ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
</div>