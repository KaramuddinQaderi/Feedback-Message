<?php include './incloud_file/header.php' ?>

<?php
$sql = 'SELECT * FROM feedback';
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Check if the delete button is clicked
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];
    $sql = "DELETE FROM feedback WHERE id = '$delete_id'";
    if (mysqli_query($conn, $sql)) {
        // success
        header('Location: feedback.php');
    } else {
        // error
        echo 'Error: ' . mysqli_error($conn);
    }
}

?>


<h1 class=" pt-5 mt-5 mb-3 mx-5">Your Messages</h1>

<?php if (empty($feedback)) : ?>
    <p class="lead mt-3">Your messages box is empty!</p>
<?php endif; ?>

<?php foreach ($feedback as $item) : ?>
    <div class="card mt-3 mb-3 mx-5 w-75">
        <div class="card-header text-center">
            <div class="text-secondary fw-bold mt-2">
                By <?php echo $item['name'] ?>

            </div>
        </div>
        <div class="card-body text-center">
            <div class="text-secondary mt-2">
                <?php echo $item['body']; ?>
            </div>
        </div>
        <div class="card-footer text-center">
            <div class="text-secondary fst-italic mt-2">
                <?php echo $item['email']; ?> on <?php echo date_format(
                                                        date_create($item['date']),
                                                        'g:ia \o\n l jS F Y'
                                                    ); ?>
            </div>
            <div class="text-center">
                <br>
                <?php

                // Display all feedback
                $sql = "SELECT * FROM feedback";
                $result = mysqli_query($conn, $sql);
                while ($item = mysqli_fetch_assoc($result)) {
                    echo '<form action="" method="post">';
                    echo '<input type="hidden" name="delete_id" value="' . $item['id'] . '">';
                    echo '<button class="btn btn-danger" type="submit" name="delete">Delete</button>';
                    echo '</form>';
                }
                ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php include './incloud_file/footer.php' ?>