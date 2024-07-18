<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>GreenGear</title>
    <link rel="favicon" href="#">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="centers">
    <div class="center section" id="Center Locators">
        <h2>E-waste Center Locators</h2>
        <p>Welcome to Green Gear's Electronic Waste Recycling Centers! Discover convenient locations in Nairobi to responsibly recycle your old electronics and help keep our city green and clean.</p>
    </div>
     <!-- List of e-waste recycling centers -->
    <table>
         <!-- These are the table headings -->
      <thead>
         <!-- Table headings rows -->
          <tr>

            <th>Center Name</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Operating Hours</th>
            <th>Description</th>
            <th>Accepted E-Waste </th>
          </tr>
      </thead>
      <tbody>
        <?php
        //an embedded language
        //echo '<p>TEST</p>';

        //1. Connect to the database
        require_once 'db_config.php';
        //2. Write a query to select all the centers
        $sql = "SELECT * FROM centers";
        //3. Execute the query
        $result = $conn->query($sql);
        //4. Check if there are any results
        if($result->num_rows > 0):
            while($row = $result->fetch_assoc()){
                //variables
                    $center_name = $row['center_name'];
                    $address = $row['address'];
                    $contact = $row['contact'];
                    $operating_hours = $row['operating_hours'];
                    $description = $row['description'];
                    $e_waste_accepted = $row['e_waste_accepted'];
                    //print out the data
                    echo '<tr>';
                        echo "<td>$center_name</td>";
                        echo "<td>$address</td>";
                        echo "<td>$contact</td>";
                        echo "<td>$operating_hours</td>";
                        echo "<td>$description</td>";
                        echo "<td>$e_waste_accepted</td>";
                    //lastly close the row
                    echo '</tr>';
            }
        else:
            echo '<tr>';
                echo '<td colspan="7">No Centers found</td>';
            echo '</tr>';
        endif;
    ?>
   
      </tbody>
    </table>   
</body>
