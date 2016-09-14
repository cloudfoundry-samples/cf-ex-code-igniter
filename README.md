## CloudFoundry PHP Example Application: CodeIgniter

This is an example application which can be run on CloudFoundry using the [PHP Build Pack].

This is the [CodeIgniter Tutorial] application and it demonstrates push a CodeIgniter applications to CloudFoundry.

### Usage

1. Clone the app (i.e. this repo)

  ```
  git clone https://github.com/cloudfoundry-samples/cf-ex-code-igniter
  cd cf-ex-code-igniter
  ```

1. If you don't have one already, create a MySQL service.  With Pivotal Web Services, the following command will create a free MySQL database through [ClearDb].

  ```bash
  cf create-service cleardb spark mysql
  ```

1. Push it to CloudFoundry.

  ```bash
  cf push
  ```

  Access your application URL in the browser.  You should see the main page and be able to navigate the links.  The news section is pulled from the database.  Initially it'll be empty, but you can create some news entries with the create page.

### Database Details

Previously with this example, it was necessary to create the database manually.  Now this happens automatically when you push the application.  Here's how this works.

1. The app is pushed & stages.
1. Your MySQL service is bound to the app.
1. The app droplet is run.
1. The db migration scripts execute.
1. The app itself starts.

The migration scripts use the technique described [here](http://zacharyflower.com/2013/08/12/getting-started-with-codeigniter-migrations/).



[CodeIgniter Tutorial]:http://ellislab.com/codeigniter/user-guide/tutorial/index.html
[PHP Buildpack]:https://github.com/cloudfoundry/php-buildpack
[ClearDb]:https://www.cleardb.com/
[PHPMyAdmin]:https://github.com/cloudfoundry-samples/cf-ex-phpmyadmin
[MySQL client]:http://dev.mysql.com/doc/refman/5.6/en/mysql.html
