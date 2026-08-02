<?php
require 'includes/events-data.php';

$pageTitle = 'Register | Campus Events Hub';

$errors = [];
$successMessage = '';

$name = '';
$studentId = '';
$email = '';
$eventId = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $requestedEvent = filter_input(INPUT_GET, 'event', FILTER_VALIDATE_INT);
    if ($requestedEvent && findEventById($events, $requestedEvent)) {
        $eventId = (string)$requestedEvent;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $studentId = trim($_POST['student_id'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $eventId = trim($_POST['event_id'] ?? '');

    if ($name === '') {
        $errors[] = 'Full name is required.';
    } elseif (mb_strlen($name) < 3) {
        $errors[] = 'Full name must contain at least 3 characters.';
    }

    if ($studentId === '') {
        $errors[] = 'Student ID is required.';
    } elseif (!preg_match('/^[0-9]{6,12}$/', $studentId)) {
        $errors[] = 'Student ID must contain 6 to 12 digits.';
    }

    if ($email === '') {
        $errors[] = 'Email address is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    $validatedEventId = filter_var($eventId, FILTER_VALIDATE_INT);
    $selectedEvent = $validatedEventId
        ? findEventById($events, (int)$validatedEventId)
        : null;

    if (!$selectedEvent) {
        $errors[] = 'Please select a valid event.';
    }

    if (!$errors) {
        $dataDirectory = __DIR__ . '/data';
        $filePath = $dataDirectory . '/registrations.csv';

        if (!is_dir($dataDirectory)) {
            mkdir($dataDirectory, 0775, true);
        }

        $isNewFile = !file_exists($filePath) || filesize($filePath) === 0;
        $file = fopen($filePath, 'a');

        if ($file === false) {
            $errors[] = 'Registration could not be saved. Please check file permissions.';
        } else {
            if (flock($file, LOCK_EX)) {
                if ($isNewFile) {
                    fputcsv($file, ['name', 'student_id', 'email', 'event_id', 'event_title', 'registration_date']);
                }

                fputcsv($file, [
                    $name,
                    $studentId,
                    $email,
                    $selectedEvent['id'],
                    $selectedEvent['title'],
                    date('Y-m-d H:i:s')
                ]);

                fflush($file);
                flock($file, LOCK_UN);
                fclose($file);

                $successMessage = 'Your registration has been saved successfully.';
                $name = '';
                $studentId = '';
                $email = '';
                $eventId = '';
            } else {
                fclose($file);
                $errors[] = 'The registration file is currently unavailable.';
            }
        }
    }
}

require 'includes/header.php';
?>

<section class="section narrow-section">
    <p class="eyebrow">Student Registration</p>
    <h2>Register for an Event</h2>
    <p>Complete the form below. All fields are required.</p>

    <?php if ($successMessage !== ''): ?>
        <div class="message success-message">
            <?php echo htmlspecialchars($successMessage); ?>
        </div>
    <?php endif; ?>

    <?php if ($errors): ?>
        <div class="message error-message">
            <strong>Please correct the following errors:</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="form-card" method="post" action="register.php" novalidate>
        <div class="form-group">
            <label for="name">Full Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?php echo htmlspecialchars($name); ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="student_id">Student ID</label>
            <input
                type="text"
                id="student_id"
                name="student_id"
                inputmode="numeric"
                value="<?php echo htmlspecialchars($studentId); ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="email">University Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?php echo htmlspecialchars($email); ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="event_id">Selected Event</label>
            <select id="event_id" name="event_id" required>
                <option value="">Choose an event</option>
                <?php foreach ($events as $event): ?>
                    <option
                        value="<?php echo htmlspecialchars((string)$event['id']); ?>"
                        <?php echo (string)$event['id'] === $eventId ? 'selected' : ''; ?>
                    >
                        <?php echo htmlspecialchars($event['title']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="button" type="submit">Submit Registration</button>
    </form>
</section>

<?php require 'includes/footer.php'; ?>
