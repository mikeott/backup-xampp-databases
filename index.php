<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XAMPP SQL Backups</title>
    <style>
        body {
            font-family: monospace;
            padding: 50px;
        }
        p {
            border-bottom: solid 1px #ccc;
            padding: 10px 0;
            margin: 0;
        }
        p  a {
            color: #2196f3;
        }
        span {
            display: inline-block;
            width: 180px;
        }
        .error {
            color: #f44336;
        }
        .good {
            color: #4caf50;
        }
        .button {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            background: #2196f3;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 25px 0;
        }
    </style>
</head>
<body>
    <?php
    $start = isset($_GET['start']) ? $_GET['start'] : '';

    if($start) {
        
        /* Config */
        $host                   = 'localhost';                          // MySQL server hostname
        $username               = 'root';                               // MySQL server username
        $password               = '';                                   // MySQL server password
        $backup_destination_dir = 'D:\www-sql-backups';                 // Destination directory to store SQL dumps
        $mysqldump_exe          = 'C:/xampp/mysql/bin/mysqldump.exe';   // Path to the mysqldump.exe executable

        /* Create a backup directory with today's date */
        $date       = date('Y-m-d');
        $backup_dir = $backup_destination_dir . '/' . $date;

        if (!file_exists($backup_dir)) {
            if (!mkdir($backup_dir, 0777, true)) {
                die("<p class='error'>Failed to create backup directory: $backup_dir" . '</p>');
            }
        }

        /* Connect to MySQL */
        $conn = new mysqli($host, $username, $password);

        /* Check connection */
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        /* Get all databases */
        $result = $conn->query("SHOW DATABASES");

        if ($result) {

            <!--/ Front-end response /-->
            echo '<h1>Backup Complete.</h1>';
            echo '<p>Take a look in ' . $backup_destination_dir . ' to verify backups were made.</p>';
            echo '<a href="/" class="button">Go back</a>';

            while ($row = $result->fetch_assoc()) {
                $db_name = $row['Database'];
                
                /* Exclude system databases */
                if (in_array($db_name, [
                        'information_schema', 
                        'mysql', 
                        'performance_schema',
                        'phpmyadmin'
                    ])) {
                    continue;
                }
                
                /* Path to the output file */
                $backup_file = $backup_dir . '/' . $db_name . '-' . date('Y-m-d_H-i-s') . '.sql';
                
                /* Command to dump database */
                $command = "\"{$mysqldump_exe}\" --user={$username} --password={$password} --host={$host} {$db_name} > \"{$backup_file}\" 2>&1";
                
                /* Execute the command */
                $output = [];
                $return_var = null;
                exec($command, $output, $return_var);
                
                if ($return_var !== 0) {
                    echo "<p class='error'>Error backing up database: {$db_name}\n" . "</p>";
                    echo "<p class='error'>Command: {$command}\n" . "</p>";
                    echo "<p class='error'>Output: " . implode("\n", $output) . "\n" . "</p>";
                } else {
                    echo "<p class='good'><span>Database backed up:</span> {$db_name}\n" . "</p>";
                }
            }

        } else {
            echo "Error fetching databases: " . $conn->error;
        }

        /* Close the connection */
        $conn->close();

    } else {  ?>

        <!--/ Front-end start /-->
        <h1>Hit the button to start backing up.</h1>
        <p>Depending on how many databases you have and the size of them, this could take a while.</p>

        <a href="index.php?start=true" class="button">
            Start Backups
        </a>

    <?php } ?>
</body>
</html>
