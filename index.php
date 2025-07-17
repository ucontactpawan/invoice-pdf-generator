<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create PDF file</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Enter Details: </h1>
        <form action="createpdf.php" method="post">
            <input type="text" name="fullname" class="form-control mb-2" placeholder="Enter your name" required>
            <input type="email" name="email" class="form-control mb-2" placeholder="Enter your email" required>
            <input type="number" name="phone" class="form-control mb-2" placeholder="Enter your phone" required>
            <textarea name="message" class="form-control mb-2" placeholder="Enter Your Address" required></textarea>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">         
        </form>
    </div>
</body>
</html>