mysqldump -h 131.100.55.58 -P 1000 -u root -pP@ssw0rd cacti host > /var/www/html/nominal/scheduler/dump_host.sql
mysql -h 172.18.65.56 -u raga -ppassword wanvolution_dev_backup < /var/www/html/nominal/scheduler/dump_host.sql
mysql -h 172.18.65.56 -u raga -ppassword wanvolution_dev_backup < /var/www/html/nominal/scheduler/update_db.sql
