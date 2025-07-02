<?php
include 'includes/headers.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    if (empty($title) || empty($description)) {
        $error = "Please fill in all fields";
    }

    $target_dir = 'assets/images/';

    $file = $image['name'];
    $new_name = uniqid() . $file;

    $target_file = $target_dir . $new_name;

    if ($image['size'] > 5000000) {
        $error = 'File size is too large. Max size is 5MB';
    } else {
        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            $sql = "INSERT INTO images (title, description, filename) VALUES (:title, :description, :filename)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':filename' => $new_name
            ]);

            $success = "Image uploaded successfully";
            $title = "";
            $description = "";
        } else {
            $error = 'Error uploading';
        }
    }
}

?>

<div class="my-4">
    <h1>Choose image file to uplaod into Photo Gallery</h1>
</div>

<?php if ($success): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $success; ?>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
<?php endif; ?>


<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Image Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Image Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Select Image File</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Upload Image</button>
        </form>
    </div>
</div>



<?php
include 'includes/footer.php';
?>