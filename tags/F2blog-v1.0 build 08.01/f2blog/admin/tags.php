<?
$PATH="./";
include("$PATH/function.php");

// 验证用户是否处于登陆状态
check_login();

//保存参数
$action=$_GET['action'];
$order=$_GET['order'];
$page=$_GET['page'];
$seekname=$_REQUEST['seekname'];
$mark_id=$_GET['mark_id'];

//保存数据
if ($action=="save"){
	$check_info=1;
	//检测输入内容
	if (trim($_POST['name'])==""){
		$ActionMessage=$strErrNull;
		$check_info=0;
		$action=($mark_id!="")?"edit":"add";
	}

	if ($check_info==1){
		if ($mark_id!=""){//编辑
			$rsexits=getFieldValue($DBPrefix."tags","name='".encode($_POST['name'])."'","id");
			if ($rsexits!=$mark_id && $rsexits!=""){
				$ActionMessage="$strDataExists";
				$action="edit";
			}else{
				//更新了標籤
				$isupdate=getFieldValue($DBPrefix."tags","id='$mark_id'","name");
				if ($isupdate!=encode($_POST['name'])){
					updateLogsTags($isupdate,encode($_POST['name']));
					
					$sql="update ".$DBPrefix."tags set name='".encode($_POST['name'])."' where id='$mark_id'";
					$DMC->query($sql);

					//更新Cache
					hottags_recache();
				}
			}
		}else{//新增
			$rsexits=getFieldValue($DBPrefix."tags","name='".encode($_POST['name'])."'","id");
			if ($rsexits!=""){
				$ActionMessage="$strDataExists";
				$action="add";
			}else{
				$sql="INSERT INTO ".$DBPrefix."tags(name) VALUES ('".encode($_POST['name'])."')";
				$DMC->query($sql);
				
				add_bloginfo("tagNums","adding",1);
				//更新Cache
				hottags_recache();
				statistics_recache();
			}
		}
	}
}

//其它操作行为：编辑、删除等
if ($action=="operation"){
	$stritem="";
	$itemlist=$_POST['itemlist'];
	for ($i=0;$i<count($itemlist);$i++){
		if ($stritem!=""){
			$stritem.=" or id='$itemlist[$i]'";
		}else{
			$stritem.="id='$itemlist[$i]'";
		}
	}
	
	if($_POST['operation']=="delete" and $stritem!=""){
		$sql="delete from ".$DBPrefix."tags where $stritem";
		$DMC->query($sql);
	}

	add_bloginfo("tagNums","minus",count($itemlist));
	statistics_recache();
	//更新Cache
	hottags_recache();
}

if ($action=="all"){
	$seekname="";
}

$seek_url="$PHP_SELF?order=$order";	//查找用链接
$order_url="$PHP_SELF?seekname=$seekname";	//排序栏用的链接
$page_url="$PHP_SELF?seekname=$seekname&order=$order";	//页面导航链接
$edit_url="$PHP_SELF?seekname=$seekname&order=$order&page=$page";	//编辑或新增链接

if ($action=="add"){
	//新增信息类别。
	$title="$strTagsTitleAdd";

	include("tags_add.inc.php");
}else if ($action=="edit" && $mark_id!=""){
	//编辑信息类别。
	$title="$strTagsTitleEdit - $strRecordID: $mark_id";

	$dataInfo = $DMC->fetchArray($DMC->query("select * from ".$DBPrefix."tags where id='$mark_id'"));
	if ($dataInfo) {
		$name=$dataInfo['name'];

		include("tags_add.inc.php");
	}else{
		$error_message=$strNoExits;
		include("error_web.php");
	}	
}else{
	//查找和浏览
	$title="$strTagsTitle";

	if ($order==""){$order="id";}

	//Find condition
	$find="";
	if ($seekname!=""){$find.=" and (name like '%$seekname%')";}

	if ($find!=""){
		$find=substr($find,5);
		$sql="select * from ".$DBPrefix."tags where $find order by $order";
	} else {
		$sql="select * from ".$DBPrefix."tags order by $order";
	}

	$total_num=$DMC->numRows($DMC->query($sql));
	include("tags_list.inc.php");
}
?>