<?php
require 'includes/events-data.php';

$pageTitle = 'Home | Campus Events Hub';
require 'includes/header.php';

$upcomingEvents = array_slice($events, 0, 3);
?>

<section class="hero">
    <div class="hero-content">
        <p class="eyebrow">University IT Club</p>
        <h2>Find your next campus experience</h2>
        <p>
            Campus Events Hub helps students discover workshops, seminars,
            competitions, trips, and other university activities in one place.
        </p>
        <div class="hero-actions">
            <a class="button" href="events.php">Explore Events</a>
            <a class="button button-secondary" href="register.php">Register Now</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="section-heading">
        <div>
            <p class="eyebrow">Featured</p>
            <h2>Next 3 Upcoming Events</h2>
        </div>
        <a class="text-link" href="events.php">View all events</a>
    </div>

    <div class="events-grid">
        <?php foreach ($upcomingEvents as $event): ?>
            <article class="event-card">
                <span class="badge"><?php echo htmlspecialchars($event['category']); ?></span>
                <h3><?php echo htmlspecialchars($event['title']); ?></h3>

                <ul class="event-meta">
                    <li><strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?></li>
                    <li><strong>Time:</strong> <?php echo htmlspecialchars($event['time']); ?></li>
                    <li><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></li>
                </ul>

                <p><?php echo htmlspecialchars($event['description']); ?></p>

                <a class="button small-button"
                   href="event.php?id=<?php echo urlencode((string)$event['id']); ?>">
                    View Details
                </a>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section info-strip">
    <article>
        <strong><?php echo count($events); ?></strong>
        <span>Upcoming Events</span>
    </article>
    <article>
        <strong>6</strong>
        <span>Event Categories</span>
    </article>
    <article>
        <strong>Free</strong>
        <span>Student Registration</span>
    </article>
</section>

<?php require 'includes/footer.php'; ?>
