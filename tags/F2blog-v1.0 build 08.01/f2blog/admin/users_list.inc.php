<?
# 禁止直接访问该页面
if (basename($_SERVER['PHP_SELF']) == "users_list.inc.php") {
    header("HTTP/1.0 404 Not Found");
    exit;
}

//输出头部信息
dohead($title,$page_url);
?>

<form action="" method="post" name="seekform">
  <div id="content">
    <div class="box">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="6" height="20"><img src="images/main/content_lt.gif" width="6" height="21"></td>
          <td height="21" background="images/main/content_top.gif">&nbsp;</td>
          <td width="6" height="20"><img src="images/main/content_rt.gif" width="6" height="21"></td>
        </tr>
        <tr>
          <td width="6" background="images/main/content_left.gif">&nbsp;</td>
          <td bgcolor="#FFFFFF" >
            <div class="contenttitle"><img src="images/content/user.gif" width="12" height="11">
              <?=$title?>
              <div class="page">
                <?view_page($page_url)?>
              </div>
            </div>
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="searchtool">
                  <?=$strBlueFind?>
                  &nbsp;
                  <input type="text" name="seekname" size="8" value="<?=$seekname?>" class="searchbox">
                  &nbsp;
                  <input name="find" class="btn" type="submit" value="<?=$strFind?>" onclick="confirm_submit('<?=$seek_url?>','find')">
                  &nbsp;
                  <input name="findall" class="btn" type="button" value="<?=$strAll?>" onclick="confirm_submit('<?=$seek_url?>','all')">
                  &nbsp;
                  <input name="add" class="btn" type="button" value="<?=$strAdd?>" onclick="confirm_submit('<?=$edit_url?>','add')">
                </td>
              </tr>
            </table>
            <div class="subcontent">
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr class="subcontent-title">
                  <td width="8%" nowrap class="whitefont">
                    <input type="checkbox" name="checkbox" value="all" onclick="checkall(this.form,this.checked,'itemlist[]')" title="<?=$strSelectCancelAll?>">
                  </td>
                  <td width="12%" nowrap class="whitefont">
                    <?
		echo "<a class=\"columntitle\" href=\"$order_url&page=$page&order=username\">$strLoginUserID</a>";
		if ($order=="username"){echo "<img src=\"images/content/down.gif\" border=\"0\">";}
		?>
                  </td>
                  <td width="12%" nowrap class="whitefont">
                    <?
		echo "<a class=\"columntitle\" href=\"$order_url&page=$page&order=nickname\">$strNickName</a>";
		if ($order=="nickname"){echo "<img src=\"images/content/down.gif\" border=\"0\">";}
		?>
                  </td>
                  <td width="10%" nowrap class="whitefont">
                    <?
		echo "<a class=\"columntitle\" href=\"$order_url&page=$page&order=role\">$strRole</a>";
		if ($order=="role"){echo "<img src=\"images/content/down.gif\" border=\"0\">";}
		?>
                  </td>
                  <td width="35%" nowrap class="whitefont">
                    <?
		echo "<a class=\"columntitle\" href=\"$order_url&page=$page&order=email\">$strEmail</a>";
		if ($order=="email"){echo "<img src=\"images/content/down.gif\" border=\"0\">";}
		?>
                  </td>
                  <td width="26%" nowrap class="whitefont">
                    <?
		echo "<a class=\"columntitle\" href=\"$order_url&page=$page&order=lastVisitTime\">$strLastVisitTime</a>";
		if ($order=="lastVisitTime"){echo "<img src=\"images/content/down.gif\" border=\"0\">";}
		?>
                  </td>
                </tr>
                <?
	//Record Limits
	if ($page<1) { $page=1; }
	$start_record=($page-1)*$cfg_page_size;
	
	$query_sql=$sql." Limit $start_record,$cfg_page_size";
	$query_result=$DMC->query($query_sql);
	while($fa = $DMC->fetchArray($query_result)){
		$index++;
	?>
                <tr class="subcontent-input" onMouseOver="this.style.backgroundColor='<?=$cfg_mouseover_color?>'" onMouseOut="this.style.backgroundColor=''">
                  <td nowrap class="subcontent-td">
                    <INPUT type=checkbox value="<?=$fa['id']?>" id="item" name="itemlist[]"  onclick="Javascript:this.form.opselect.value=1">
                    <a href="<?="$edit_url&mark_id=".$fa['id']."&action=edit"?>"><img src="images/content/icon_modif.gif" width="16" height="16" alt="<?="$strEdit"?>" border="0"> </a> </td>
                  <td nowrap class="subcontent-td">
                    <?=$fa['username']?>
                  </td>
                  <td nowrap class="subcontent-td">
                    <?=$fa['nickname']?>
                  </td>
                  <td nowrap class="subcontent-td">
                    <?=($fa['role']=="admin")?$strAdmin:$strMember?>
                  </td>
                  <td nowrap class="subcontent-td">
                    <?=($fa['email'])?$fa['email']:"&nbsp;"?>
                  </td>
                  <td nowrap class="subcontent-td">
                    <?=($fa['lastVisitTime'])?format_time("L",$fa['lastVisitTime']):"&nbsp;"?>
                  </td>
                </tr>
                <?}?>
              </table>
            </div>
            <br>
            <div class="bottombar-onebtn"></div>
            <div class="searchtool">
              <input type="radio" name="operation" value="delete" onclick="Javascript:this.form.opmethod.value=1" checked>
              <?=$strDelete?>
              |
              <input name="opselect" type="hidden" value="">
              <input name="opmethod" type="hidden" value="1">
              <input name="op" class="btn" type="button" value="<?=$strConfirm?>" onclick="ConfirmOperation('<?="$edit_url&action=operation"?>','<?=$strConfirmInfo?>')">
              <span class="style1">(
              <?=$strDeleteInfo?>
              )</span> </div>
          </td>
          <td width="6" background="images/main/content_right.gif">&nbsp;</td>
        </tr>
        <tr>
          <td width="6" height="20"><img src="images/main/content_lb.gif" width="6" height="20"></td>
          <td height="20" background="images/main/content_bottom.gif">&nbsp;</td>
          <td width="6" height="20"><img src="images/main/content_rb.gif" width="6" height="20"></td>
        </tr>
      </table>
    </div>
  </div>
</form>
<? dofoot(); ?>
