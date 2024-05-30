<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'employee';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => '`u`.`id`', 'dt' => 0, 'field' => 'id' ),
	array( 'db' => '`ud`.`name`',   'dt' => 2, 'field' => 'name' ),
	array( 'db' => '`u`.`nic`',  'dt' => 1, 'field' => 'nic' ),
	array( 'db' => '`uc`.`contact`',   'dt' => 3, 'field' => 'contact' ),
	array( 'db' => '`u`.`city`',     'dt' => 4, 'field' => 'city')
//	array( 'db' => '`ud`.`email`',     'dt' => 4, 'field' => 'email' ),
//	array( 'db' => '`ud`.`phone`',     'dt' => 5, 'field' => 'phone' ),
//	array( 'db' => '`u`.`start_nic`', 'dt' => 6, 'field' => 'start_nic', 'formatter' => function( $d, $row ) {
//																	return nic( 'jS M y', strtotime($d));
//																}),
//	array('db'  => '`u`.`salary`',     'dt' => 7, 'field' => 'salary', 'formatter' => function( $d, $row ) {
//																return '$'.number_format($d);
//															})
);

// SQL server connection information
require('config.php');
$sql_details = array(
	'user' => $db_username,
	'pass' => $db_password,
	'db'   => $db_name,
	'host' => $db_host
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php' );

$joinQuery = "FROM `` AS `u` JOIN `employee` AS `ud` ON (`ud`.`id` = `u`.`employee_id`) JOIN `tbl_print_porder_inv_contact` AS `uc` ON (`uc`.`_id` = `u`.`id`)";
//$joinQuery = "FROM `` AS `u` JOIN `tbl_invoice` AS `uc` ON (`uc`.`_id` = `u`.`id`)";
$extraWhere = "";
//$groupBy = "`u`.`city`";
//$having = "`u`.`salary` >= 140000";

echo json_encode(
//	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
