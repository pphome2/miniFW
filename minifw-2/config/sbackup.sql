# sql backup

use minifw;

select * into outfile 'users.sql' from users;
select * into outfile 'params.sql' from params;
