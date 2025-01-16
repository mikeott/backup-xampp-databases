# backup-xampp-databases
A one click solution to make backups of your local XAMPP databases.

## Overview
This script exports all local XAMPP databases and saves them to a directory of your choice. For optimal performance, it is recommended that the backup destination is part of an existing scheduled backup routine and, if possible, located on a different physical drive. Alternatively, the destination should be any directory that is automatically backed up to the cloud.

## Configuration
If you are familiar with PHP, the configuration should be straightforward. Below are the key variables to customise for your setup.

<code>/* Config */
    $host                   = 'localhost';                        // Hostname of the MySQL server
    $username               = '';                                 // Username of the MySQL server
    $password               = '';                                 // Password of the MySQL server
    $backup_destination_dir = 'D:\sql-backups';                   // Destination directory to send the sql dumps
    $mysqldump_exe          = 'C:/xampp/mysql/bin/mysqldump.exe'; // Location of the mysqldump.exe file
</code>

## Executing the Script Locally
PlTo run the script locally, place the `index.php` file in your `www` directory under a folder of your choice. For example: `c:/xampp/httpdocs/sql-backups/index.php`. Ensure that you can access it through your browser just like any other local website.

## Additional Customization Options
You may want to adjust the $date variable to use a custom <a href="https://www.php.net/manual/en/datetime.format.php">date format</a> that suits your needs.

## Excluding System Databases
To exclude specific databases from the backup, add their names to the array at line 77.

## Compatibility
This script has been tested on Windows with PHP 8.0.
