## CloudFoundry PHP Example Application: CodeIgniter

This is an example application which can be run on CloudFoundry using the [PHP Build Pack].

This is the [CodeIgniter Tutorial] application and it demonstrates push a CodeIgniter applications to CloudFoundry.

### Usage

1. Follow the instructions in the [CodeIgniter Tutorial] to get a working local application.

1. If you don't have one already, create a MySQL service.  With Pivotal Web Services, the following command will create a free MySQL database through [ClearDb].

  ```bash
  cf create-service cleardb spark mysql
  ```

1. You can configure your database in two ways: using a `.env` file or in code.

  To configure with a `.env` file, add a `.profile` script at the root of your application. You can then pull values out of `VCAP_SERVICES` and echo them into the `.env` file.

  Ex:

      ```bash
      # replace `p.mysql` with the name of your db provider
      # `[0]` picks the first bound db instance from this provider
      cat <<EOF >> $HOME/.env
      database.default.hostname = $(echo $VCAP_SERVICES | jq -r '.["p.mysql"][0].credentials.hostname')
      database.default.username = $(echo $VCAP_SERVICES | jq -r '.["p.mysql"][0].credentials.username')
      database.default.password = $(echo $VCAP_SERVICES | jq -r '.["p.mysql"][0].credentials.password')
      database.default.database = $(echo $VCAP_SERVICES | jq -r '.["p.mysql"][0].credentials.name')
      EOF
      ``
  
  To configure in code, you can edit `app/Config/Database.php` and pull database configuration options from the env variable `VCAP_SERVICES`.

  Ex:

      ```php
      // Look for bound MySQL Services, pick the first one
      $services = json_decode(getenv('VCAP_SERVICES'), true);
      $service = $services['<enter service type name>'][0];

      public $default = [
        'DSN'      => '',
        'hostname' => $service['credentials']['hostname'],
        'username' => $service['credentials']['username'],
        'password' => $service['credentials']['password'],
        'database' => $service['credentials']['name'],
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => TRUE,
        'DBDebug'  => TRUE,
        'cacheOn'  => FALSE,
        'cacheDir' => '',
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => FALSE,
        'compress' => FALSE,
        'strictOn' => FALSE,
        'failover' => [],
      ];
      ```

1. Push it to CloudFoundry.

  ```bash
  cf push
  ```

  Access your application URL in the browser. You should see the main page and be able to navigate the links.


[CodeIgniter Tutorial]:https://codeigniter4.github.io/userguide/tutorial/index.html
[PHP Buildpack]:https://github.com/cloudfoundry/php-buildpack
[ClearDb]:https://www.cleardb.com/
