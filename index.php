<?php include './incloud_file/header.php' ?>

<?php
// Set vars to empty values
$name = $email = $body = '';
$nameErr = $emailErr = $bodyErr = '';


// Form submit
if (isset($_POST['submit'])) {
    // Validate name
    if (empty($_POST['name'])) {
        $nameErr = 'Name is required';
    } else {
        // $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(
            INPUT_POST,
            'name',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }

    // Validate email
    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
    } else {
        // $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }

    // Validate body
    if (empty($_POST['body'])) {
        $bodyErr = 'Body is required';
    } else {
        // $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $body = filter_input(
            INPUT_POST,
            'body',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }

    if (empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
        // add to database
        $sql = "INSERT INTO feedback (name, email, body) VALUES ('$name', '$email', '$body')";
        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: feedback.php');
        } else {
            // error
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}

?>
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Enter Your Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo htmlspecialchars(
                                                $_SERVER['PHP_SELF']
                                            ); ?>" class="mt-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control <?php echo !$nameErr ?:
                                                                    'is-invalid'; ?>" id="name" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
                        <div id="validationServerFeedback" class="invalid-feedback">
                            Please provide a valid name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?php echo !$emailErr ?:
                                                                    'is-invalid'; ?>" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
                        <div id="validationServerFeedback" class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Feedback</label>
                        <textarea class="form-control <?php echo !$bodyErr ?:
                                                            'is-invalid'; ?>" id="body" name="body" placeholder="Enter your feedback"><?php echo $body; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="lead fst-italic">You are Message is Posted to Message page</p>
            </div>
        </div>
    </div>
</div>
<h1 class="mt-5 mb-2 pt-5">
    What do you think about KQ
</h1>
<p class="my-3 mx-5">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quo
    quibusdam unde, perferendis recusandae maxime sint laudantium excepturi.
    Sunt fugit numquam nostrum nihil! Iusto vel tempora quo nostrum nihil
    itaque velit ex at nam dolor. Minus alias dolorem illum nisi eveniet vel ullam nulla.
    Praesentium quod nobis, debitis, temporibus, itaque deleniti culpa labore minima
    aperiam possimus sequi at velit et optio laudantium a beatae harum? Reiciendis
    necessitatibus animi explicabo libero eligendi iusto ex perspiciatis
</p>
<button class="btn btn-outline-dark btn-lg mt-3 text-break" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Sent your message</button>

<?php include './incloud_file/footer.php' ?>