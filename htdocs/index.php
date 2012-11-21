<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once('app/moduls.php');

showunder();

$template['page'] = get_page();

if($template['page']=='projects_list'){
	$projects_arr = db_getrows('portfolio','*','true','sort',30);
	$template['projects'] = gen_projects_list($projects_arr);
}

inc("view",'app');

finalise();

/*

error_reporting(E_ALL ^ E_NOTICE);

$sitedown = true;

session_start();

isset($_GET['debug']) and $_SESSION['debug']=$_GET['debug'];

$page = ($sitedown && !$_SESSION['debug']) ? 'underdev' : (isset($_GET[page]) ? $_GET[page] : 'home');

$title = ucwords(str_replace(array('-','%20'), ' ', $page));

@file_exists("./$page.php") or $page='err/index';

@include "./$page.php";

*/