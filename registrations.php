<?php
$pageTitle = 'Registrations | Campus Events Hub';

$registrations = [];
$filePath = __DIR__ . '/data/registrations.csv';

if (file_exists($filePath) && is_readable($filePath)) {
    $file = fopen($filePath, 'r');

    if ($file !== false) {
        $header = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) < 6) {
                continue;
            }

            $registrations[] = [
                'name' => $row[0],
                'student_id' => $row[1],
                'email' => $row[2],
                'event_id' => $row[3],
                'event_title' => $row[4],
                'registration_date' => $row[5]
            ];
        }

        fclose($file);
    }
}

require 'includes/header.php';
?>

<section class="section">
    <div class="section-heading">
        <div>
            <p class="eyebrow">Stored Data</p>
            <h2>Registrations List</h2>
        </div>
        <span class="count-label"><?php echo count($registrations); ?> registrations</span>
    </div>

    <?php if (!$registrations): ?>
        <div class="message">
            <p>No registrations have been saved yet.</p>
            <a class="button" href="register.php">Create First Registration</a>
        </div>
    <?php else: ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Event</th>
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registrations as $index => $registration): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($registration['name']); ?></td>
                            <td><?php echo htmlspecialchars($registration['student_id']); ?></td>
                            <td>
                                <a href="mailto:<?php echo htmlspecialchars($registration['email']); ?>">
                                    <?php echo htmlspecialchars($registration['email']); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($registration['event_title']); ?></td>
                            <td><?php echo htmlspecialchars($registration['registration_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<?php require 'includes/footer.php'; ?>
