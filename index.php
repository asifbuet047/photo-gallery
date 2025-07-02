<?php

include 'includes/headers.php';

$sql = "SELECT * FROM images ORDER BY upload_date DESC";

$stmt = $pdo->query($sql);
$images = $stmt->fetchAll();

?>

<div class="my-5-text-center">
    <h1 class="display-4">Photo Gallery</h1>
    <p class="lead"> Browse the latest uploaded images</p>
</div>

<div class="row ">
    <?php foreach ($images as $image): ?>
        <div class="card" style="width: 18rem;">
            <img src="assets/images/<?php echo htmlspecialchars($image['filename']); ?>" class="card-img-top"
                alt="<?php echo htmlspecialchars($image['title']); ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($image['title']); ?></h5>
                <p class="text-muted small">
                    Uploaded on: <?php echo date("F j, Y", strtotime($image['upload_date'])); ?>
                </p>
                <p class="card-text"><?php echo htmlspecialchars($image['description']); ?></p>

            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
include 'includes/footer.php';
?>