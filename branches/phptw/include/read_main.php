<?php 
if (!defined('IN_F2BLOG')) die ('Access Denied.');

//读取內容插件或模組
foreach($arrMainModule as $key=>$value){	
	$mainname=$key;
	$maintitle=$value['modTitle'];
	$indexOnly=$value['indexOnly'];
	$installDate=empty($value['installDate'])?"":$value['installDate'];
	$htmlcode=$value['htmlCode'];

	//$strModuleContentShow=array("0所有内容头部","1所有内容尾部","2首页内容头部","3首页内容尾部","4首页日志尾部","5读取日志尾部");
	if ($indexOnly==0){//所有内容头部
		if ($installDate>0){//表示为插件
			do_filter($mainname,$mainname,$maintitle,$htmlcode);
		}else{
			main_module($mainname,$maintitle,$htmlcode);
		}
	}
	if ($indexOnly==2 && $load==""){//首页内容头部
		if ($installDate>0){//表示为插件
			do_filter($mainname,$mainname,$maintitle,$htmlcode);
		}else{
			main_module($mainname,$maintitle,$htmlcode);
		}
	}
}

#自定义模块内容
/*function main_module($mainname,$maintitle,$htmlcode){
	echo "<div id=\"Content_$mainname\" class=\"content-width\"> \n";
	echo htmldecode($htmlcode);
	echo "</div> \n";
}*/
?>
