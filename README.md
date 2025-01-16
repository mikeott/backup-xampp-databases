# backup-xampp-databases
A one click solution to make a backup of your local XAMPP databases.

## How does it work?
This script will dump all your local XAMPP databases and copy them to a directory of your choosing. Ideally, the databses should be copied to a destination directory that is already included in your sheduled backup routine, and if possible that is also not on the same physical drive.

Altentaivly, the databses should be copied to a destination directory that gets automatcally backed up to the cloud.

## How to configure
If you can read PHP then it's quite obviosu what to do. But for prosperity here are the main variables you need to be concerened with.

<code>/* Config */
    $host                   = 'localhost';                        // Hostname of the MySQL server
    $username               = '';                                 // Username of the MySQL server
    $password               = '';                                 // Password of the MySQL server
    $backup_destination_dir = 'D:\sql-backups';                   // Destination directory to send the sql dumps
    $mysqldump_exe          = 'C:/xampp/mysql/bin/mysqldump.exe'; // Location of the mysqldump.exe file
</code>

## Other variables to consider
Recommend chnaging the $date variable to a <a href="https://www.php.net/manual/en/datetime.format.php">date format</a> that is preferrable to you.

## Exclude system databases
At line 77 add any databses you want to exlcude into the array.

## COmpatibiity
Tested on Windows with PHP 8.0
