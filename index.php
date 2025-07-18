<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create PDF file</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script>
        function showAlert(){
            alert("Data submitted successfully! Now you can download the updated Excel and PDF.");
        }
        </script>
</head>
<body>
    <div class="container mt-4">
        <h1>Enter Your Details: </h1>
        <form action="submit.php" method="post" onsubmit="showAlert()">
            <input type="text" name="fullname" class="form-control mb-2" placeholder="Enter your full name" required>
            <input type="email" name="email" class="form-control mb-2" placeholder="Enter your email" required>
            <input type="number" name="phone" class="form-control mb-2" placeholder="Enter your phone" required>
            <textarea name="message" class="form-control mb-2" placeholder="Enter Your Address" required></textarea>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">         
        </form>

        <form action="createpdf.php" method="post">
            <input type="submit" name="submit_pdf" value="Download PDF" class="btn btn-secondary mt-2">
        </form>
        <form action="Spreadsheet/createexcel.php" method="post">
            <input type="submit" name="submit_excel" value="Download Excel" class="btn btn-success mt-2">

        </form>
    </div>
</body>
</html>