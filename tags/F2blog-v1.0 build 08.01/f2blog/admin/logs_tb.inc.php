<?
# 禁止直接访问该页面
if (basename($_SERVER['PHP_SELF']) == "logs_tb.inc.php") {
    header("HTTP/1.0 404 Not Found");
    exit;
}

//输出头部信息
dohead($title,"");
?>
<script style="javascript">
<!--
function onclick_update(form) {
	if (isNull(form.quoteUrl, '<?=$strErrNull?>')) return false;
	form.save.disabled = true;
	form.reback.disabled = true;
	form.action = "<?="$edit_url&action=sendtb&mark_id=$mark_id"?>";
	form.submit();
}
-->
</script>

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
            <div class="contenttitle"><img src="images/content/write_log.gif" width="12" height="11">
              <?=$title?>
            </div>
            <br>
            <div class="subcontent">
              <? if ($ActionMessage!="") { ?>
              <br>
              <fieldset>
              <legend>
              <?=$strErrorInfo?>
              </legend>
              <div align="center">
                <table border="0" cellpadding="2" cellspacing="1">
                  <tr>
                    <td><span class="alertinfo">
                      <?=$ActionMessage?>
                      </span></td>
                  </tr>
                </table>
              </div>
              </fieldset>
              <br>
              <? } ?>
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr class="subcontent-input">
                  <td nowrap>
                    <?=$strQuoteUrl?>
                    &nbsp;<span style="color:#999">
                    <?=$strQuoteAlt?>
                    </span> </td>
                </tr>
                <tr>
                  <td>
                    <textarea name="quoteUrl" rows="5" cols="80" style="width: 100%"><?=$quoteUrl?>
</textarea>
                  </td>
                </tr>
              </table>
            </div>
            <br>
            <div class="bottombar-onebtn">
              <input name="save" class="btn" type="button" id="save" value="<?=$strSave?>" onClick="Javascript:onclick_update(this.form)">
              &nbsp;
              <input name="reback" class="btn" type="button" id="return" value="<?=$strReturn?>" onclick="location.href='<?="$edit_url"?>'">
            </div>
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
