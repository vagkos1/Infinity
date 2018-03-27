<?php

#!/bin/sh
crontab -l
crontab -e

* * * * * /usr/bin/flock -n /tmp/cron.lock /usr/bin/php /Applications/MAMP/htdocs/Infinity/Task.php >> /var/log/cron.log
