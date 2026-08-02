<?php
$pageTitle = 'About / Contact | Campus Events Hub';

$contactErrors = [];
$contactSuccess = '';

$contactName = '';
$contactEmail = '';
$contactSubject = '';
$contactMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contactName = trim($_POST['contact_name'] ?? '');
    $contactEmail = trim($_POST['contact_email'] ?? '');
    $contactSubject = trim($_POST['subject'] ?? '');
    $contactMessage = trim($_POST['message'] ?? '');

    if ($contactName === '') {
        $contactErrors[] = 'Name is required.';
    }

    if ($contactEmail === '' || !filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
        $contactErrors[] = 'A valid email address is required.';
    }

    if ($contactSubject === '') {
        $contactErrors[] = 'Subject is required.';
    }

    if ($contactMessage === '') {
        $contactErrors[] = 'Message is required.';
    } elseif (mb_strlen($contactMessage) < 10) {
        $contactErrors[] = 'Message must contain at least 10 characters.';
    }

    if (!$contactErrors) {
        $contactSuccess = 'Your message has been validated successfully. No email was sent, as required by the project.';
        $contactName = '';
        $contactEmail = '';
        $contactSubject = '';
        $contactMessage = '';
    }
}

require 'includes/header.php';
?>

<section class="section">
    <p class="eyebrow">About the Project</p>
    <h2>University IT Club</h2>
    <p>
        The University IT Club supports students through practical workshops,
        technical seminars, competitions, and educational visits. This website
        provides a simple way to browse events and submit registrations online.
    </p>
</section>

<section class="section">
    <p class="eyebrow">Project Team</p>
    <h2>Team Members</h2>

    <div class="team-grid">
        <article class="team-card">
            <h3>Member 1</h3>
            <p>Project planning and home page development.</p>
        </article>
        <article class="team-card">
            <h3>Member 2</h3>
            <p>Events pages and PHP data handling.</p>
        </article>
        <article class="team-card">
            <h3>Member 3</h3>
            <p>Registration form, validation, and CSV storage.</p>
        </article>
        <article class="team-card">
            <h3>Member 4</h3>
            <p>CSS design, testing, documentation, and screenshots.</p>
        </article>
    </div>
</section>

<section class="section narrow-section">
    <p class="eyebrow">Contact</p>
    <h2>Send a Message</h2>
    <p>The form validates the data only. It does not send email.</p>

    <?php if ($contactSuccess !== ''): ?>
        <div class="message success-message">
            <?php echo htmlspecialchars($contactSuccess); ?>
        </div>
    <?php endif; ?>

    <?php if ($contactErrors): ?>
        <div class="message error-message">
            <ul>
                <?php foreach ($contactErrors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="form-card" method="post" action="about.php" novalidate>
        <div class="form-group">
            <label for="contact_name">Name</label>
            <input
                type="text"
                id="contact_name"
                name="contact_name"
                value="<?php echo htmlspecialchars($contactName); ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="contact_email">Email</label>
            <input
                type="email"
                id="contact_email"
                name="contact_email"
                value="<?php echo htmlspecialchars($contactEmail); ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input
                type="text"
                id="subject"
                name="subject"
                value="<?php echo htmlspecialchars($contactSubject); ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea
                id="message"
                name="message"
                rows="6"
                required
            ><?php echo htmlspecialchars($contactMessage); ?></textarea>
        </div>

        <button class="button" type="submit">Validate Message</button>
    </form>
</section>

<?php require 'includes/footer.php'; ?>
