<?php

session_start();

require_once('app/db.php');

function get_page(){
	return isset($_GET[page]) ? strtolower($_GET[page]) : 'home';
}

function showunder(){
	isset($_GET['debug']) and $_SESSION['debug']=$_GET['debug'];
	if(!$_SESSION['debug']){
		inc('underdev','pages');
		exit();
	}
}

function inc($filename,$folder='inc'){
	global $template;
	@include "$folder/$filename.php";
}

function finalise (){
	db_close();
}

function gen_project($project,$linkclass){
	$html = '';

	$project['img'] = array();
	$project['imglinks']='';
	$project['imglen']=0;

	for($i=1;$i<=10;$i++){
		if(strlen($project["img$i"])>3){
			$img = $project["img$i"];
			$project['imglen']++;
			$act = $i==1 ? ' act' : '';
			$project['imglinks'] .= "<a class='links$act $linkclass' href='images/projects/$img' title='$project[excerpt_en]'></a>";
		}
	}

	$html .= "
				<section class='prd' style=\"background-image:url('images/projects/$project[thumb]');\">
					<h1>$project[name_en]</h1>
					<h2>
						<span>$project[imglen]<br />images</span>
					</h2>
					$project[imglinks]
				</section>
			";
	return $html;
}

function gen_projects_list($projects_arr){
	$html = array('','','');
	$len = sizeof($projects_arr);
	for($i=0; $i<$len; $i+=3) {
		for($j=0;$j<3;$j++){
			$projects_arr[$i] and $html[$j] .= gen_project($projects_arr[$i+$j],"prdpic".($i+$j));
		}
	}
	return $html;
}