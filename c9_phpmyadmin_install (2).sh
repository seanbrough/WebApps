mysql-ctl start
sleep 10
mysql -u $C9_USER -h $IP -e "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' IDENTIFIED BY 'admin' WITH GRANT OPTION; FLUSH PRIVILEGES"
wget https://dl.dropboxusercontent.com/u/3815667/phpMyAdmin-4.6.4-all-languages.zip
unzip phpMyAdmin-4.6.4-all-languages.zip
mv phpMyAdmin-4.6.4-all-languages phpmyadmin
rm phpMyAdmin-4.6.4-all-languages.zip
mv phpmyadmin/config.sample.inc.php phpmyadmin/config.inc.php
sed -i -e 's/localhost/127.0.0.1/g' phpmyadmin/config.inc.php