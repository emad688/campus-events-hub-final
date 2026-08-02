<?php
require 'includes/events-data.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$selectedEvent = $id ? findEventById($events, $id) : null;

$pageTitle = $selectedEvent
    ? $selectedEvent['title'] . ' | Campus Events Hub'
    : 'Event Not Found | Campus Events Hub';

require 'includes/header.php';
?>

<section class="section">
    <?php if (!$selectedEvent): ?>
        <div class="message error-message">
            <h2>Event Not Found</h2>
            <p>The selected event ID is missing or invalid.</p>
            <a class="button" href="events.php">Back to Events</a>
        </div>
    <?php else: ?>
        <article class="event-details">
            <span class="badge"><?php echo htmlspecialchars($selectedEvent['category']); ?></span>
            <h2><?php echo htmlspecialchars($selectedEvent['title']); ?></h2>

            <div class="details-grid">
                <div>
                    <span>Date</span>
                    <strong><?php echo htmlspecialchars($selectedEvent['date']); ?></strong>
                </div>
                <div>
                    <span>Time</span>
                    <strong><?php echo htmlspecialchars($selectedEvent['time']); ?></strong>
                </div>
                <div>
                    <span>Location</span>
                    <strong><?php echo htmlspecialchars($selectedEvent['location']); ?></strong>
                </div>
                <div>
                    <span>Available Seats</span>
                    <strong><?php echo htmlspecialchars((string)$selectedEvent['seats']); ?></strong>
                </div>
            </div>

            <h3>About This Event</h3>
            <p><?php echo nl2br(htmlspecialchars($selectedEvent['description'])); ?></p>

            <div class="card-actions">
                <a class="button"
                   href="register.php?event=<?php echo urlencode((string)$selectedEvent['id']); ?>">
                    Register for This Event
                </a>
                <a class="button button-secondary" href="events.php">Back to Events</a>
            </div>
        </article>
    <?php endif; ?>
</section>

<?php require 'includes/footer.php'; ?>
