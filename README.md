## CloudFoundry PHP Example Application: CodeIgniter

This is an example application which can be run on CloudFoundry using the [PHP Build Pack].

This is the [CodeIgniter Tutorial] application and it demonstrates push a CodeIgniter applications to CloudFoundry.

### Usage

1. Clone the app (i.e. this repo)

  ```
  git clone https://github.com/dmikusa-pivotal/cf-ex-code-igniter 
  cd cf-ex-code-igniter
  ```

1. If you don't have one already, create a MySQL service.  With Pivotal Web Services, the following command will create a free MySQL database through [ClearDb].

  ```bash
  cf create-service cleardb spark my-test-mysql-db
  ```

1. Connect to the database using an SQL tool like the [MySQL client] or [PHPMyAdmin].  Run the following statement to create the required database table.

  ```sql
  CREATE TABLE news (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  title varchar(128) NOT NULL,
	  slug varchar(128) NOT NULL,
	  text text NOT NULL,
	  PRIMARY KEY (id),
	  KEY slug (slug)
  );
  ```

1. Edit the manifest.yml file.  Change the 'host' attribute to something unique.  Then under "services:" change "mysql-db" to the name of your MySQL service.  This is the name of the service that will be bound to your application and thus available to PHPMyAdmin.

1. Push it to CloudFoundry.

  ```bash
  cf push
  ```

  Access your application URL in the browser.  You should see the main page and be able to navigate the links.  The news section is pulled from the database.  Initially it'll be empty, but you can create some news entries with the create page.


[CodeIgniter Tutorial]:http://ellislab.com/codeigniter/user-guide/tutorial/index.html
[PHP Build Pack]:https://github.com/dmikusa-pivotal/cf-php-build-pack
[ClearDb]:https://www.cleardb.com/
[PHPMyAdmin]:https://github.com/dmikusa-pivotal/cf-ex-phpmyadmin
[MySQL client]:http://dev.mysql.com/doc/refman/5.6/en/mysql.html
