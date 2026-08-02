<?php
require 'includes/events-data.php';

$pageTitle = 'Events | Campus Events Hub';
require 'includes/header.php';
?>

<section class="section">
    <div class="section-heading">
        <div>
            <p class="eyebrow">Campus Calendar</p>
            <h2>All Upcoming Events</h2>
        </div>
    </div>

    <div class="events-grid">
        <?php foreach ($events as $event): ?>
            <article class="event-card">
                <span class="badge"><?php echo htmlspecialchars($event['category']); ?></span>
                <h3><?php echo htmlspecialchars($event['title']); ?></h3>

                <ul class="event-meta">
                    <li><strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?></li>
                    <li><strong>Time:</strong> <?php echo htmlspecialchars($event['time']); ?></li>
                    <li><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></li>
                    <li><strong>Seats:</strong> <?php echo htmlspecialchars((string)$event['seats']); ?></li>
                </ul>

                <p><?php echo htmlspecialchars($event['description']); ?></p>

                <div class="card-actions">
                    <a class="button small-button"
                       href="event.php?id=<?php echo urlencode((string)$event['id']); ?>">
                        Details
                    </a>
                    <a class="button button-secondary small-button"
                       href="register.php?event=<?php echo urlencode((string)$event['id']); ?>">
                        Register
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
