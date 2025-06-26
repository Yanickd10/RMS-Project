    <?php
$response = file_get_contents('fetch-students.php');
$classData = json_decode($response, true);
?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
 

<table border="1">
  <tr>
    <th>Class</th>
    <th>Student Count</th>
  </tr>

  <?php foreach ($classData as $class => $count): ?>
    <tr>
      <td><?php echo htmlspecialchars($class); ?></td>
      <td><?php echo $count; ?></td>
    </tr>
  <?php endforeach; ?>
</table>

 </body>
 </html>