#!/bin/sh

THESITE="ebuy"
THEDB="dbEbuy"
THEDBUSER="root"
THEDBPW="Engadin1"
THEDATE=`date +%d%m%y%H%M`

mysqldump -u $THEDBUSER -p${THEDBPW} $THEDB  > /etc/backup_ebuy/files/dbbackup_${THEDB}_${THEDATE}.sql


tar -czvf files/sitebackup_${THESITE}_${THEDATE}.tar.gz /var/www/html

find /etc/backup_ebuy/files/db* -mtime +5 -exec rm {} \;
find /etc/backup_ebuy/files/site* -mtime +5 -exec rm {} \;


*   *   *   *   *  /etc/backup_ebuy/backup.sh