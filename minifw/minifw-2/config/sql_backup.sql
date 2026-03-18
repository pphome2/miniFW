# sqlbackup

#use minifw;

select * from mfw_users into outfile '$MA_SERVER_DIR/$MA_CONFIG_DIR/mfw.users.sql' field enclosed by '"' terminated by ';' escaped by '"' lines terminated by '\r\n';
select * from mfw_param into outfile '$MA_SERVER_DIR/$MA_CONFIG_DIR/mfw.param.sql' field enclosed by '"' terminated by ';' escaped by '"' lines terminated by '\r\n';
