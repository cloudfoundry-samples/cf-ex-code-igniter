<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

// Look for bound MySQL Services, pick the first one
//$services = json_decode($_ENV['VCAP_SERVICES'], true);
//$service = $services['cleardb'][0];

// Look for bound MySQL Services
$service_blob = json_decode($_ENV['VCAP_SERVICES'], true);
$mysql_services = array();
foreach($service_blob as $service_provider => $service_list) {
    // looks for 'cleardb' or 'p-mysql' service
    if ($service_provider === 'cleardb' || $service_provider === 'p-mysql') {
        foreach($service_list as $mysql_service) {
            $mysql_services[] = $mysql_service;
        }
        continue;
    }
    foreach ($service_list as $some_service) {
        // looks for tags of 'mysql'
        if (in_array('mysql', $some_service['tags'], true)) {
            $mysql_services[] = $some_service;
            continue;
        }
        // look for a service where the name includes 'mysql'
        if (strpos($some_service['name'], 'mysql') !== false) {
            $mysql_services[] = $some_service;
        }
    }
}

/*
 * Servers configuration
 */
for ($i = 0; $i < count($mysql_services); $i++) {	
		$service_name = $mysql_services[$i]['name'];		//your service name
    $credentials = $mysql_services[$i]['credentials'];
	
		$db[$service_name]['hostname'] = $credentials['hostname'];
		$db[$service_name]['port'] 		= $credentials['port'];
		$db[$service_name]['username'] = $credentials['username'];
		$db[$service_name]['password'] = $credentials['password'];
		$db[$service_name]['database'] = $credentials['name'];
		$db[$service_name]['dbdriver'] = 'mysql';
		$db[$service_name]['dbprefix'] = 'CI_';
		$db[$service_name]['pconnect'] = TRUE;
		$db[$service_name]['db_debug'] = TRUE;
		$db[$service_name]['cache_on'] = FALSE;
		$db[$service_name]['cachedir'] = '';
		$db[$service_name]['char_set'] = 'utf8';
		$db[$service_name]['dbcollat'] = 'utf8_general_ci';
		$db[$service_name]['swap_pre'] = '';
		$db[$service_name]['autoinit'] = TRUE;
		$db[$service_name]['stricton'] = FALSE;
	
		//pick the first one as default
		if($i == 0) {
			$db['default'] = $db[$service_name];
		}
}

$active_group = 'default';
$active_record = TRUE;

//$db['default']['hostname'] = $service['credentials']['hostname'];
//$db['default']['port'] = $service['credentials']['port'];
//$db['default']['username'] = $service['credentials']['username'];
//$db['default']['password'] = $service['credentials']['password'];
//$db['default']['database'] = $service['credentials']['name'];
//$db['default']['dbdriver'] = 'mysql';
//$db['default']['dbprefix'] = 'CI_';
//$db['default']['pconnect'] = TRUE;
//$db['default']['db_debug'] = TRUE;
//$db['default']['cache_on'] = FALSE;
//$db['default']['cachedir'] = '';
//$db['default']['char_set'] = 'utf8';
//$db['default']['dbcollat'] = 'utf8_general_ci';
//$db['default']['swap_pre'] = '';
//$db['default']['autoinit'] = TRUE;
//$db['default']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */
