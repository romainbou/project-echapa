<?php
  declare(ticks = 1);

  print "Starting echapa ;-)\n\n";

  $vhost = "Listen 9999

NameVirtualHost localhost:9999

<VirtualHost localhost:9999>
  ServerName localhost
  DocumentRoot ".getcwd()."
  DirectoryIndex index.php

  <Directory ".getcwd().">
    Options Indexes FollowSymLinks
    Order Deny,Allow
    Allow from all
  </Directory>
</VirtualHost>
";

  print "Adding custom vhost...\n";
  file_put_contents('/etc/apache2/sites-available/echapa', $vhost);
  shell_exec('sudo a2ensite echapa');
  $status = shell_exec('sudo service apache2 status');
  $apacheRunning = ($status !== "Apache2 is NOT running.\n");

  if ($apacheRunning) {
    print "Reloading apache...\n\n";
    shell_exec('sudo service apache2 reload');
  } else {
    print "Starting Apache...\n";
    shell_exec('sudo service apache2 start');
    print "\n";
  }

  print "Serving ".getcwd()."\n";
  print "at http://localhost:9999\n\n";

  pcntl_signal(SIGINT, function ($signal) {
    global $apacheRunning;

    print $apacheRunning;

    print "\n\nRemoving custom vhost...\n";
    shell_exec('sudo a2dissite echapa');

    if ($apacheRunning) {
      print "Reloading apache...\n\n";
      shell_exec('sudo service apache2 reload');
    } else {
      print "Stopping apache...\n\n";
      shell_exec('sudo service apache2 stop');
    }

    unlink('/etc/apache2/sites-available/echapa');

    print "echapa OUT - KTHXBYE\n";
    exit;
  });

  while(1);
?>
