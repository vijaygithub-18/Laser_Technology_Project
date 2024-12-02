<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize errors array
    $errors = [];

    // Validate and sanitize form data
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $org_name = isset($_POST['org_name']) ? htmlspecialchars(trim($_POST['org_name'])) : '';
    $contact_number = isset($_POST['contact_number']) ? htmlspecialchars(trim($_POST['contact_number'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $remark = isset($_POST['remark']) ? htmlspecialchars(trim($_POST['remark'])) : '';
    $captcha = isset($_POST['captcha']); // Check if CAPTCHA checkbox is ticked

    // Validate fields
    if (empty($name)) {
        $errors['name'] = "Name is required.";
    }
    if (empty($org_name)) {
        $errors['org_name'] = "Organization name is required.";
    }
    if (empty($contact_number)) {
        $errors['contact_number'] = "Contact number is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
    if (empty($remark)) {
        $errors['remark'] = "Remark cannot be empty.";
    }
    if (!$captcha) {
        $errors['captcha'] = "Please verify the CAPTCHA.";
    }

    // Return errors or success message
    if (!empty($errors)) {
        echo json_encode(["status" => "error", "errors" => $errors]);
    } else {
        echo json_encode(["status" => "success", "message" => "Form submitted successfully!"]);
    }
}
?>

<script src="<?php echo 'js/script.js'; ?>"></script>
