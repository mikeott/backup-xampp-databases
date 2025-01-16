# backup-xampp-databases
A one click solution to make backups of your local XAMPP databases.

## Overview
This script exports all local XAMPP databases and saves them to a directory of your choice. For optimal peace-of-mind, it is recommended that the backup destination is part of an existing scheduled backup routine and, if possible, located on a different physical drive. Alternatively, the destination should be any directory that is automatically backed up to the cloud.

## Configuration
If you are familiar with PHP, the configuration should be straightforward. Below are the key variables to customise for your setup.

<code>/* Config */
    $host                   = 'localhost';                        // MySQL server hostname
    $username               = '';                                 // MySQL server username
    $password               = '';                                 // MySQL server password
    $backup_destination_dir = 'D:\sql-backups';                   // Destination directory to store SQL dumps
    $mysqldump_exe          = 'C:/xampp/mysql/bin/mysqldump.exe'; // Path to mysqldump.exe executable
</code>

## Executing the Script Locally
To run the script locally, place the `index.php` file in your `httpdocs` directory under a folder of your choice. For example: `c:/xampp/httpdocs/sql-backups/index.php`. Ensure that you can access it through your browser just like any other local website.

## Additional Customisation Options
You may want to adjust the `$date` variable to use a custom <a href="https://www.php.net/manual/en/datetime.format.php">date format</a> that suits your needs.

## Excluding System Databases
To exclude specific databases from the backup, add their names to the array at line 86.

## Compatibility
This script has been tested on Windows with PHP 8.0.
