<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>API test</title>
</head>
<body>
    <form action="student.php" method="GET">
        <label>Get every student</label><input type="submit" value="See database"><br><br>
        <label for="text_get">Get 1 student through his ID</label>
        <select name="id">
            <option selected disabled hidden value="">Student ID</option>
            <?php 
                include('./class/DBConnection.php');
                $db = new DBConnection;
                $db = $db->returnConnection();
                $sql = "SELECT id FROM student ORDER BY id ASC;";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                foreach($result as $key)
                {   
                    echo '<option value="' . $key['id'] . '">' . $key['id'] . '</option>';
                }   
            ?>
        </select>
        <input type="submit" value="Search">
    </form> 
    <br>
    <form action="student.php" method="POST">
        <h3>Add a new student</h3>
        <label>First name: </label>
        <input type="text" name="name" required><br>
        <label>Last name: </label>
        <input type="text" name="surname" required><br>
        <label>Sidi code: </label>
        <input type="text" name="sidi_code" required><br>
        <label>Tax code: </label>
        <input type="text" name="tax_code" required><br>
        <input type="submit" value="Add">
    </form>
</body>
</html>

<!-- curl --header "Content-Type: application/json" --request DELETE http://localhost:8080/student.php/id  -->
<!-- curl --header "Content-Type: application/json" --request PUT http://localhost:8080/student.php/1699 --data "{"name":"name", "surname":"surname","sidiCode":"sidiCode", "taxCode":"taxCode"}"  -->