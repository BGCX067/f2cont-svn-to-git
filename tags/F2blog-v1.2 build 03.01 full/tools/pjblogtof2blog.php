<?php 
@set_time_limit(0);
@error_reporting(E_ERROR | E_WARNING | E_PARSE);
@header("Content-Type: text/html; charset=utf-8");
/*
Tool Name: Pjblog To F2blog
Tool URI: http://korsen.f2blog.com
Description: 转换pjblog的Access数据库到F2bLog
Author: korsen
Version: 1.0 适应于F2blog v1.0 & v1.1
*/

//检查数据库是否存在
$pjblog_data="pblog2.mdb";
if (!file_exists($pjblog_data)){
	echo "Pjblog的Access数据库不存在,pjblog数据文件默认放在blogDB目录中的".$pjblog_data."文件，请把它复制到tools下,并保证文件名也要一致!";
	exit;
}

if (!class_exists("com")){
	echo "PHP需要支持COM。建议请在本地电脑安装PHP5，可以安装一个傻瓜式的xampp套件，它集成了php5,apache,mysql非常方便。";
	exit;
}

include("../include/common.php");

echo "<font size=\"4\">转换pjblog的Access数据库到F2bLog,<br>正在运行,请不要关闭网页!</font><br /><br />";

$conn = new com("ADODB.Connection",NULL,CP_UTF8); 
$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=". realpath($pjblog_data); 

$conn->Open($connstr); 
$rs = new com("ADODB.RecordSet",NULL,CP_UTF8); 

//转换类别
echo "正在转换类别 ...";
ob_flush();flush();
$i=0;
$insert_value=array();
$arr_fields=array(
	"cate_ID"=>"id",
	"cate_Name"=>"name",
	"cate_Order"=>"orderNo",
	"cate_Intro"=>"cateTitle",
	"cate_count"=>"cateCount",
	"cate_Secret"=>"isHidden"
	);
$rs->Open("select * from blog_Category",$conn,1,1); 
while(! $rs->eof) {	
	foreach($arr_fields as $key=>$value){
		$f = $rs->Fields($key); 
		$insert_value[$i][$value]=convert_quote($f->value);
	}
	$i++;
	$rs->MoveNext();	
}
//print_r($insert_value);
$DMC->query("TRUNCATE TABLE ".$DBPrefix."categories");
foreach($insert_value as $value){
	$key=array_keys($value);
	$insert_sql="insert into ".$DBPrefix."categories(".implode(",",$key).") values('".implode("','",$value)."')";
	$DMC->query($insert_sql);
}
echo " 共转换了<font color=red>".$i."</font>条记录<br /><br />";
$rs->Close();

//转换日志
echo "正在转换日志 ...";
ob_flush();flush();
$i=0;
$insert_value=array();
$arr_fields=array(
	"log_ID"=>"id",
	"log_CateID"=>"cateId",
	"log_Title"=>"logTitle",
	"log_Content"=>"logContent",
	"log_Author"=>"author",
	"log_CommNums"=>"commNums",
	"log_QuoteNums"=>"quoteNums",
	"log_ViewNums"=>"viewNums",
	"log_PostTime"=>"postTime",
	"log_IsShow"=>"saveType",
	"log_tag"=>"tags",
);
$rs->Open("select * from blog_Content",$conn,1,1); 
while(! $rs->eof) {	
	foreach($arr_fields as $key=>$value){
		$f = $rs->Fields($key); 
		$field_value=convert_quote($f->value);
		if ($key=="log_PostTime") $field_value=pjtime_convert($field_value);
		if ($key=="log_Content") $field_value=convert_ubb($field_value);
		$insert_value[$i][$value]=$field_value;
	}
	$i++;
	$rs->MoveNext();	
}
//print_r($insert_value);
$DMC->query("TRUNCATE TABLE ".$DBPrefix."logs");
foreach($insert_value as $value){
	$key=array_keys($value);
	$insert_sql="insert into ".$DBPrefix."logs(".implode(",",$key).",isComment,isTrackback) values('".implode("','",$value)."','1','1')";
	$DMC->query($insert_sql);
}
echo " 共转换了<font color=red>".$i."</font>条记录<br /><br />";
$rs->Close();

//转换评论
echo "正在转换评论 ...";
ob_flush();flush();
$i=0;
$insert_value=array();
$arr_fields=array(
	"comm_ID"=>"id",
	"blog_ID"=>"logId",
	"comm_Author"=>"author",
	"comm_Content"=>"content",
	"comm_PostIP"=>"ip",
	"comm_PostTime"=>"postTime",
);
$rs->Open("select * from blog_Comment",$conn,1,1); 
while(! $rs->eof) {	
	foreach($arr_fields as $key=>$value){
		$f = $rs->Fields($key); 
		$field_value=convert_quote($f->value);
		if ($key=="comm_PostTime") $field_value=pjtime_convert($field_value);
		$insert_value[$i][$value]=$field_value;
	}
	$i++;
	$rs->MoveNext();	
}
//print_r($insert_value);
$DMC->query("TRUNCATE TABLE ".$DBPrefix."comments");
foreach($insert_value as $value){
	$key=array_keys($value);
	$insert_sql="insert into ".$DBPrefix."comments(".implode(",",$key).") values('".implode("','",$value)."')";
	$DMC->query($insert_sql);
}
echo " 共转换了<font color=red>".$i."</font>条记录<br /><br />";
$rs->Close();

//转换留言板
echo "正在转换留言板 ...";
ob_flush();flush();
$i=0;
$insert_value=array();
$arr_fields=array(
	"book_Messager"=>"author",
	"book_Url"=>"homepage",
	"book_Mail"=>"email",
	"book_face"=>"face",
	"book_IP"=>"ip",
	"book_Content"=>"content",
	"book_PostTime"=>"postTime",
);
$rs->Open("select * from blog_book",$conn,1,1); 
while(! $rs->eof) {	
	$insert_value[$i][id]=$i+1;
	$insert_value[$i][parent]=0;
	foreach($arr_fields as $key=>$value){
		$f = $rs->Fields($key); 
		$field_value=convert_quote($f->value);
		if ($key=="book_face") $field_value=str_replace("face","",$field_value);
		if ($key=="book_PostTime") $field_value=pjtime_convert($field_value);		
		$insert_value[$i][$value]=$field_value;
	}
	//回复内容
	$reply_content=$rs->Fields("book_reply")->value;
	if ($reply_content!=""){
		$i++;
		$insert_value[$i]['id']=$i+1;
		$insert_value[$i]['parent']=$i;
		$insert_value[$i]['content']=convert_quote($reply_content);
		$insert_value[$i]['postTime']=pjtime_convert($rs->Fields("book_replyTime")->value);
		$insert_value[$i]['author']=$rs->Fields("book_replyAuthor")->value;
	}

	$i++;
	$rs->MoveNext();	
}
//print_r($insert_value);
$DMC->query("TRUNCATE TABLE ".$DBPrefix."guestbook");
foreach($insert_value as $value){
	$key=array_keys($value);
	$insert_sql="insert into ".$DBPrefix."guestbook(".implode(",",$key).") values('".implode("','",$value)."')";
	$DMC->query($insert_sql);
}
echo " 共转换了<font color=red>".$i."</font>条记录<br /><br />";
$rs->Close();

//转换连接
echo "正在转换连接 ...";
ob_flush();flush();
$i=0;
$insert_value=array();
$arr_fields=array(
	"link_ID"=>"id",
	"link_Name"=>"name",
	"link_URL"=>"blogUrl",
	"link_Order"=>"orderNo",
);
$rs->Open("select * from blog_Links",$conn,1,1); 
while(! $rs->eof) {	
	foreach($arr_fields as $key=>$value){
		$f = $rs->Fields($key); 
		$insert_value[$i][$value]=convert_quote($f->value);
	}
	$i++;
	$rs->MoveNext();	
}
//print_r($insert_value);
$DMC->query("TRUNCATE TABLE ".$DBPrefix."links");
foreach($insert_value as $value){
	$key=array_keys($value);
	$insert_sql="insert into ".$DBPrefix."links(".implode(",",$key).",isApp) values('".implode("','",$value)."','1')";
	$DMC->query($insert_sql);
}
echo " 共转换了<font color=red>".$i."</font>条记录<br /><br />";
$rs->Close();

//转换标签
echo "正在转换标签 ...";
ob_flush();flush();
$i=0;
$insert_value=array();
$arr_fields=array(
	"tag_id"=>"id",
	"tag_name"=>"name",
	"tag_count"=>"logNums",
);
$rs->Open("select * from blog_Tag",$conn,1,1); 
while(! $rs->eof) {	
	foreach($arr_fields as $key=>$value){
		$f = $rs->Fields($key); 
		$insert_value[$i][$value]=convert_quote($f->value);
	}
	$i++;
	$rs->MoveNext();	
}
//print_r($insert_value);
$DMC->query("TRUNCATE TABLE ".$DBPrefix."tags");
foreach($insert_value as $value){
	$key=array_keys($value);
	$insert_sql="insert into ".$DBPrefix."tags(".implode(",",$key).") values('".implode("','",$value)."')";
	$DMC->query($insert_sql);
	
	$update_sql="update ".$DBPrefix."logs set tags=replace(tags,'{".$value[id]."}',';".$value[name]."')";
	$DMC->query($update_sql);
}
echo " 共转换了<font color=red>".$i."</font>条记录<br /><br />";
$rs->Close();

//转换引用
echo "正在转换引用 ...";
ob_flush();flush();
$i=0;
$insert_value=array();
$arr_fields=array(
	"blog_ID"=>"logId",
	"tb_URL"=>"blogUrl",
	"tb_PostTime"=>"postTime",
	"tb_Title"=>"tbTitle",
	"tb_Site"=>"blogSite",
	"tb_Intro"=>"content",
);
$rs->Open("select * from blog_Trackback",$conn,1,1); 
while(! $rs->eof) {	
	foreach($arr_fields as $key=>$value){
		$f = $rs->Fields($key); 
		$field_value=convert_quote($f->value);
		if ($key=="tb_PostTime") $field_value=pjtime_convert($field_value);
		$insert_value[$i][$value]=$field_value;
	}
	$i++;
	$rs->MoveNext();	
}
//print_r($insert_value);
$DMC->query("TRUNCATE TABLE ".$DBPrefix."trackbacks");
foreach($insert_value as $value){
	$key=array_keys($value);
	$insert_sql="insert into ".$DBPrefix."trackbacks(".implode(",",$key).",isApp) values('".implode("','",$value)."','1')";
	$DMC->query($insert_sql);
}
echo " 共转换了<font color=red>".$i."</font>条记录<br /><br />";
$rs->Close();

//转换会员
echo "正在转换会员 ...";
ob_flush();flush();
$i=0;
$insert_value=array();
$arr_fields=array(
	"mem_Name"=>"username",
	"mem_Password"=>"password",
	"mem_Email"=>"email",
	"mem_homePage"=>"homePage",
	"mem_RegIP"=>"regIp",
	"mem_HideEmail"=>"isHiddenEmail",
	"mem_RegTime"=>"regTime",
	"mem_PostLogs"=>"postLogs",
	"mem_PostComms"=>"postComms",
	"mem_PostMessageNums"=>"postMessages",
	"mem_lastVisit"=>"lastVisitTime",
	"mem_LastIP"=>"lastVisitIP",
);
$rs->Open("select * from blog_member",$conn,1,1); 
while(! $rs->eof) {	
	foreach($arr_fields as $key=>$value){
		$f = $rs->Fields($key); 
		$field_value=convert_quote($f->value);
		if ($key=="mem_RegTime") $field_value=pjtime_convert($field_value);
		if ($key=="mem_lastVisit") $field_value=pjtime_convert($field_value);
		$insert_value[$i][$value]=$field_value;
	}
	$i++;
	$rs->MoveNext();	
}
//print_r($insert_value);
foreach($insert_value as $value){
	$key=array_keys($value);
	$result=$DMC->query($search_sql="select * from ".$DBPrefix."members where username='".$value[username]."'");
	if (!$DMC->fetchArray($result)){
		$insert_sql="insert into ".$DBPrefix."members(".implode(",",$key).",role,nickname) values('".implode("','",$value)."','member','".$value[username]."')";
		$DMC->query($insert_sql);
	}
}
echo " 共转换了<font color=red>".$i."</font>条记录<br /><br />";
$rs->Close();

//关闭连接
$conn->Close();

//更新缓存
if (@unlink("../cache/cache_setting.php")){
	echo "现在您可以正常使用您的blog了,单击这里<a href=\"../index.php\">返回首页</a>!";
}else{
	echo "请您<a href=\"../index.php\">登入后台</a>重新建立缓存文件!";
}

function convert_quote($str){
	$str=str_replace("'","&#39;",$str);	
	return $str;
}

function convert_ubb ($str) {
	$str=convert_quote($str);
	$str=nl2br($str);
	$basicubb_search=array('[hr]', '<br />');
	$basicubb_replace=array('<hr/>', '<br />');
	$str=str_replace($basicubb_search, $basicubb_replace, $str);

	$str=preg_replace("/\[img( align=L| align=M| align=R)?( width=[0-9]+)?( height=[0-9]+)?\]\s*(\S+?)\s*\[\/img\]/ise","makeimg('\\1', '\\2', '\\3', '\\4')",$str);

	$str=preg_replace("/\[sfile\]\s*(\S+?)\s*\[\/sfile\]/ie", "convert_file('\\1')", $str);
	$str=preg_replace("/\[file\]\s*(\S+?)\s*\[\/file\]/ie", "convert_file('\\1')", $str);
	$str=preg_replace("/\[file=(.+?)\](.*?)\[\/file\]/ie", "convert_file('\\1')", $str);
	$str=preg_replace("/\[sfile=(.+?)\](.*?)\[\/sfile\]/ie", "convert_file('\\1')", $str);
	$str=str_replace("[separator]", "<!--more-->", $str);
	$str=str_replace("[newpage]", "<!--nextpage-->", $str);
	
	$regubb_search = array(
				"/\s*\[quote\][\n\r]*(.+?)[\n\r]*\[\/quote\]\s*/is",
				"/\s*\[quote=(.+?)\][\n\r]*(.+?)[\n\r]*\[\/quote\]\s*/is",
				"/\s*\[code\][\n\r]*(.+?)[\n\r]*\[\/code\]\s*/ie",
				"/\[url\]([^\[]*)\[\/url\]/ie",
				"/\[url=www.([^\[\"']+?)\](.+?)\[\/url\]/is",
				"/\[url=([^\[]*)\](.+?)\[\/url\]/is",
				"/\[email\]([^\[]*)\[\/email\]/is",
				"/\[acronym=([^\[]*)\](.+?)\[\/acronym\]/is",
				"/\[color=([^\[\<]+?)\](.+?)\[\/color\]/i",
				"/\[size=([^\[\<]+?)\](.+?)\[\/size\]/ie",
				"/\[font=([^\[\<]+?)\](.+?)\[\/font\]/i",
				"/\[p align=([^\[\<]+?)\](.+?)\[\/p\]/i",
				"/\[b\](.+?)\[\/b\]/i",
				"/\[i\](.+?)\[\/i\]/i",
				"/\[u\](.+?)\[\/u\]/i",
				"/\[strike\](.+?)\[\/strike\]/i",
				"/\[sup\](.+?)\[\/sup\]/i",
				"/\[sub\](.+?)\[\/sub\]/i",
				"/\s*\[php\][\n\r]*(.+?)[\n\r]*\[\/php\]\s*/ie",
				"/\[(wmp|swf|real)=([^\[\<]+?),([^\[\<]+?)\]\s*([^\[\<\r\n]+?)\s*\[\/(wmp|swf|real)\]/is",
				"/\[mp3=(.+?)\](.*?)\[\/mp3\]/is",
	);
	$regubb_replace =  array(
				"<br /><div class=\"UBBPanel\" style=\"padding-left: 3px; margin: 15px;\"><div class=\"UBBContent\">\\1</div></div>",
				"<br /><div class=\"UBBPanel\" style=\"padding-left: 3px; margin: 15px;\"><div class=\"UBBContent\">\\2</div></div>",
				"makecode('\\1')",
				"makeurl('\\1')",
				"<a href=\"http://www.\\1\" target=\"_blank\">\\2</a>",
				"<a href=\"\\1\" target=\"_blank\">\\2</a>",
				"<a href=\"mailto: \\1\">\\1</a>",
				"<acronym title=\"\\1\">\\2</acronym>",
				"<span style=\"color: \\1;\">\\2</span>",
				"makefontsize('\\1', '\\2')",
				"<span style=\"font-family: \\1;\">\\2</span>",
				"<p align=\"\\1\">\\2</p>",
				"<strong>\\1</strong>",
				"<em>\\1</em>",
				"<u>\\1</u>",
				"<del>\\1</del>",
				"<sup>\\1</sup>",
				"<sub>\\1</sub>",				
				"xhtmlHighlightString('\\1')",
				"<!--musicBegin-->\\4|\\1|\\2|\\3<!--musicEnd-->",
				"<!--musicBegin-->\\1|\\2|300|48<!--musicEnd-->",
	);
	$str=preg_replace($regubb_search, $regubb_replace, $str);
	$str=str_replace("&amp;#39;","&#39;",$str);
	return $str;
}

function convert_file($file) {
	global $settingInfo;
	if (strpos(";$file","attachments/")>0){
		$file=$settingInfo[blogUrl].$file;
		$filename=str_replace("attachments/","",$file);		
	}else{
		$filename=substr($file,strrpos($file,"/")+1);
	}
	$return="<a href=\"$file\">$filename</a>";
	return $return;
}

function makeurl($url) {
	$urllink='<a href=\"'.(substr(strtolower($url), 0, 4) == 'www.' ? "http://$url" : $url).'" target="_blank">'.$url.'</a>';
	return $urllink;
}

function makefontsize ($size, $word) {
	$sizeitem=array (0, 8, 10, 12, 14, 18, 24, 36); 
	$size=$sizeitem[$size];
	return "<span style=\"font-size: {$size}px;\">{$word}</span>";
}

function makecode ($str) {
	$kkstr="<div class=\"UBBPanel\" style=\"padding-left: 3px; margin: 15px;\"><div class=\"UBBContent\">$str</div></div>";
	return $kkstr;
}

function makeimg ($aligncode, $widthcode, $heightcode, $src) {
	$align=str_replace(' align=', '', strtolower($aligncode));
	if ($align=='l') $show=' align="left"';
	elseif ($align=='r') $show=' align="right"';
	else $alignshow='';
	$width=str_replace(' width=', '', strtolower($widthcode));
	if (!empty($width)) $show.=" width=\"{$width}\"";
	$height=str_replace(' height=', '', strtolower($heightcode));
	if (!empty($height)) $show.=" height=\"{$height}\"";

	$code="<img src=\"{$src}\" alt=\"open_img(&#39;{$src}&#39;)\" {$show}/>";

	return $code;
}

function xhtmlHighlightString($str) {
	$str=base64_decode($str);
	if (PHP_VERSION<'4.2.0') return "<div class=\"code\" style=\"overflow: auto;\">$str</div>";
	$hlt = highlight_string($str, true);
	if (PHP_VERSION>'5') return "<div class=\"code\" style=\"overflow: auto;\">$hlt</div>";
	$fon = str_replace(array('<font ', '</font>'), array('<span ', '</span>'), $hlt);
	$ret = preg_replace('#color="(.*?)"#', 'style="color: \\1"', $fon);
	return "<div class=\"code\" style=\"overflow: auto;\">$ret;</div>";
}

function pjtime_convert($time){
	if (strpos($time,"下午")){
		$time=str_replace("下午 ","",$time);
		$mktime=strtotime($time)+12*3600;
	}elseif (strpos($time,"上午")){
		$time=str_replace("上午 ","",$time);
		$mktime=strtotime($time);
	}elseif (preg_match("/AM/is",$time)){
		$time=preg_replace("/AM /is","",$time);
		$mktime=strtotime($time);
	}elseif (preg_match("/PM/is",$time)){
		$time=preg_replace("/PM /is","",$time);
		$mktime=strtotime($time)+12*3600;
	}else{
		$mktime=strtotime($time);
	}
	$pjtime=gmdate("Y-m-d H:i:s",$mktime);
	return str_format_time($pjtime);
}
?>