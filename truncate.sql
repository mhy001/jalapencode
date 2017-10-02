mysql -u root --password=PASSWORD -Nse 'show tables' jalepencode | while read table;
do mysql -u root --password=PASSWORD -e "set_foreign_key_checks=0;
truncate table $table" jalepencode; done
