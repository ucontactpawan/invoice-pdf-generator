
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Your Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Enter Your Details:</h2>
        
    
        <form action="createpdf.php" method="post" target="_blank">
            <input type="text" name="fullname" class="form-control mb-2" placeholder="Enter your full name" required>
            <input type="email" name="email" class="form-control mb-2" placeholder="Enter your email" required>
            <input type="number" name="phone" class="form-control mb-2" placeholder="Enter your phone" required>
            <textarea name="message" class="form-control mb-2" placeholder="Enter Your Address" required></textarea>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary mb-3">
        </form>


        <form action="read_file.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fileUpload" class="form-label">Upload file</label>
                <input type="file" class="form-control" id="fileUpload" name="file" accept=".xlsx,.xls,.csv" required>
            </div>
            <button type="submit" class="btn btn-primary" name="upload">Upload Excel</button>
        </form>

     
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success mt-3">
                Data has been successfully saved!
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger mt-3">
                An error occurred while saving the data.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>