<?php

//error_reporting(E_ERROR);
class Database
{

// Function to the database and tables and fill them with the default data
    function check_connection($data)
    {
// Connect to the database
        $mysqli = new mysqli($data['hostname'], $data['username'], $data['password'], $data['database']);
// Check for errors
        if ($mysqli->connect_errno) {
            return false;
        } else {
            return true;
        }
    }


    function create_database($data)
    {
// Connect to the database
        $mysqli = new mysqli($data['hostname'], $data['username'], $data['password'], '');
// Check for errors
        if (mysqli_connect_errno()) {
            return false;
        }
// Create the prepared statement
        $mysqli->query("CREATE DATABASE IF NOT EXISTS " . $data['database']);
// Close the connection
        $mysqli->close();

        return true;
    }


// Function to create the tables and fill them with the default data
    function create_tables($data)
    {
// Connect to the database
        $mysqli = new mysqli($data['hostname'], $data['username'], $data['password'], $data['database']);
// Check for errors
        if (mysqli_connect_errno()) {
            return false;
        }
// Open the default SQL file
        $query = file_get_contents('database/install.sql');
// Execute a multi query
        $mysqli->multi_query($query);
// Close the connection
        $mysqli->close();

        return true;
    }


    function app_settings($data, $dbfields)
    {
        $adminpass   = sha1($data['adminpass']);
        $adminemail  = $data['adminemail'];
        $dateformat  = $data['pt_date_format'];
        $siteoffline = $data['site_offine'];
        $siteurl     = $data['site_url'];
        $sitetitle   = $data['company'];
        $copyright   = $data['copyright'];
        $adminname   = $data['adminname'];
        if ($dateformat == "d/m/Y") {
            $jsdate = "dd/mm/yyyy";
        } elseif ($dateformat == "m/d/Y") {
            $jsdate = "mm/dd/yyyy";
        }
        $mysqli = new mysqli($dbfields['hostname'], $dbfields['username'], $dbfields['password'],
            $dbfields['database']);
        $result = $mysqli->query("UPDATE pt_accounts SET ai_first_name = '$adminname',accounts_email='$adminemail', accounts_password='$adminpass'
WHERE accounts_type='webadmin'");
        if ( ! $result) {
            echo $mysqli->error;
        }
        $result2 = $mysqli->query("UPDATE pt_app_settings SET copyright='$copyright', site_title='$sitetitle',site_url='$siteurl',site_offline='$siteoffline', date_f='$dateformat',date_f_js='$jsdate' WHERE user='webadmin'");
        if ( ! $result2) {
            echo $mysqli->error;
        }
        $mysqli->close();
    }


    function add_license($data, $dbfields)
    {
        $licensekey = $data['license'];
        $secretkey  = "xihR5uB31edN";
        $mysqli     = new mysqli($dbfields['hostname'], $dbfields['username'], $dbfields['password'],
            $dbfields['database']);
        $result     = $mysqli->query("UPDATE pt_app_settings SET license_key='$licensekey', secret_key='$secretkey' WHERE user='webadmin'");
        if ( ! $result) {
            echo $mysqli->error;
        }
        $mysqli->close();
    }
}