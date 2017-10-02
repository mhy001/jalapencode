mysql -u root --password=PASSWORD -Nse 'show tables' jalapencode | while read table;
do mysql -u root --password=PASSWORD -e "set_foreign_key_checks=0;
truncate table $table" jalapencode; done
