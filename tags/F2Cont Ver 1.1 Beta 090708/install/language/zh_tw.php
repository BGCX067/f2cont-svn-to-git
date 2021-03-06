<?PHP
$strF2BlogInstall="F2Blog.Cont 安裝程式";
$strInstall="安裝";
$strSelectLanguage="選擇語言";
$strEnglish="英語";
$strSimpledChinese="簡體中文";
$strTChinese="繁體中文";
$strPrevStep="上一步";
$strNextStep="下一步";
$strHelp="幫助";
$strLicenceInfo="&nbsp;&nbsp;&nbsp;&nbsp; 在開始安裝和使用 F2Blog 之前，請務必仔細閱讀本授權文檔，在確定您理解和同意以下全部條款後， 方可繼續安裝和使用。<br />&nbsp;&nbsp;&nbsp;&nbsp; F2Blog日誌程序（以下簡稱程序）是由F2Blog團隊開發的單用戶blog程序，基於PHP腳本和MySQL數據庫。本程序是免費和開源程序， 任何人都可以從互聯網上免費下載，並可以在不違反本協議規定的前提下進行分發， 且可以在不進行商業行為的前提下免費使用而無需繳納程序使用費。<br />&nbsp;&nbsp;&nbsp;&nbsp; 1. 程序使用和版權：<br />&nbsp;&nbsp;&nbsp;&nbsp; (1) 任何人都可以在程序官方網站或者下載網站上獲得最新版本的程序穩定版以及可能提供的測試版。<br />&nbsp;&nbsp;&nbsp;&nbsp; (2) 任何人除以下情況外，都可以免費在各類主機上架設和使用本程序而無需支付使用費，這些不允許的情況包括：<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a. 記錄、發佈違法和不良信息， 國家法律法規禁止發佈的信息的；<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b. 以盈利為目的的網站；<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; c. 刪除或篡改版權信息，未經許可在程序首頁移除版權說明文字，或修改為其他版權標誌的。<br />&nbsp;&nbsp;&nbsp;&nbsp; (3) 未經許可， 不得刪除、篡改程序版權，不得移除在程序首頁上顯示的版權信息。<br />&nbsp;&nbsp;&nbsp;&nbsp; (4) 在確保安裝包完整、 保持免費的前提下，各類網站和個人可以對程序再分發。<br />&nbsp;&nbsp;&nbsp;&nbsp; 2.免責：<br />&nbsp;&nbsp;&nbsp;&nbsp; (1) 程序作者不對使用程序造成的數據丟失、 密碼失竊負責，不對因使用者發表的內容引起的一切後果負責。<br />&nbsp;&nbsp;&nbsp;&nbsp; (2) 如有使用上的困惑和問題，作者將盡量予以幫助，但此並非是作者的義務。<br />&nbsp;&nbsp;&nbsp;&nbsp; 在此，感謝您選擇了F2Cont，當發現問題，或有任何改進的建議，都可在<a href=\"http://www.f2cont.com/\" target=\"_blank\">官方網站</a>、 <a href=\"http://www.f2cont.com/\" target=\"_blank\">論壇發貼</a>，也可通過電郵提出。讓我們攜手將F2Blog.Cont做得更好！";
$strCheckRunSystem="檢查安裝配置";
$strDBNoExists="數據庫文件不存在或者讀取失敗";
$strDBInfo="程序不會自動創建數據庫，所以請事先建立一個數據庫，或使用空間商指定的數據庫";
$strSetDatabase="設置數據庫";
$strMySqlHost="數據庫主機";
$strMySqlUser="數據庫用戶名";
$strMySqlPass="數據庫密碼";
$strMySqlDatabase="數據庫名";
$strDBPrefix="數據表前綴";
$strConnectMysql="連接數據庫";
$strFileUploadSize="最大上傳附件大小: ";
$strRWAccess="訪問權限：";
$strSetAdmin="設置管理員";
$strAdminUser="管理員用戶名";
$strAdminPass="管理員密碼";
$strAdminPass2="確認密碼";
$strInstallComp="安裝完成";
$strPlsEnter="請輸入";
$strNoConnDB="無法連接到數據庫，請確認MySQL地址、用戶名、密碼和數據庫名都正確無誤且數據庫已建立。";
$strNavigation="導航";
$strInstallGuide="安裝須知";
$strLicense="版權信息";
$strImportData="導入數據";
$strVersion="F2Blog.cont v1.0 build 11.30";
$strWelcome="歡迎使用 $strVersion";
$strInstallInfo="<p>".$strWelcome."，本安裝程序將幫助您把F2Blog完整地安裝在您的服務器內。請您先確認以下推荐的安裝配置: </p>    <ul>      <li>PHP版本為4.0.6及以上 </li>      <li>MySQL版本為3.0及以上 </li>      <li>MySQL 主機名稱/IP 地址 </li>      <li>MySQL 用戶名和密碼 </li>      <li>MySQL 數據庫名稱 (如果沒有創建新數據庫的權限) </li>      <li>./backup 備份目錄權限為 0755 (Linux/Unix系統) </li>      <li>./attachments 附件目錄權限為 0755 (Linux/Unix系統) </li>      <li> ./cache 緩存目錄權限為 0755 (Linux/Unix系統)</li>      <li> ./cache/html 緩存目錄權限為 0755 (Linux/Unix系統)</li>      <li>./include/config.php 數據庫連接設置文件權限為 0644 (Linux/Unix系統) </li>    </ul>    <p>如果您無法確認以上的配置信息, 請與您的服務商聯繫.</p>";
$strServerInfo="服務器配置如下:";
$strAccess1="備份目錄權限為";
$strAccess2="附件目錄權限為";
$strAccess3="緩存目錄權限為";
$strAccess4="數據庫連接設置文件權限為";
$strSystem="系統";
$strNoWriteAccess="請修改此權限為777（有安全隐患，建议安装完改回推荐值）";
$strNoPHPVersion="您的PHP版本低於4.0.6, 無法使用F2Blog";
$strServerType="服務器類型:";
$strWebServer="Web服務器:";
$strPHPVersion="PHP版本:";
$strMysqlVersion="MySQL版本:";
$strGDVersion="GD版本:";
$strAdbhost="請指定您要連接的MySQL數據庫服務器的主機名.";
$strAdbuser="請指定F2Blog用來存取MySQL數據庫服務器的用戶名.";
$strAdbpassword="請指定F2Blog用來存取MySQL數據庫服務器的密碼.";
$strAdbname="請指定F2Blog在MySQL數據庫服務器上用來存放數據的數據庫名. 需要注意的是在數據庫服務器上此數據庫必須已經存在. 如果此數據庫不存在的話,F2Blog將<b>不會</b>自動創建此數據庫.";
$strAtable_prefix="如果F2Blog使用的數據庫是與其他多個軟件共用,給數據庫加一個前綴是一個比較好的選擇。 如果你在同一個數據庫中使用F2Blog的多個安裝版本，你要保證這個前綴在所有的安裝版本裡是唯一的。";
$strAUsername="請輸入管理員的用戶名. 通過此用戶名您可以登錄到管理員界面.";
$strAPass="請輸入管理員的密碼. 通過此用戶名您可以登錄到管理員界面.您需要輸入兩次以免輸入錯誤.";
$strZhu="祝賀!";
$strDelInstall="請盡快刪除整個 install 目錄或把install.php改名，以免被他人惡意利用。";
$strLoginIndex="<a href=\"../admin/index.php\" style=\"color:red;\">點擊這裡進入後台</a>配置頁面,您可以進行更多的設置.";
$strIsNull="請返回並輸入所有選項.";
$strPrefixErr="您指定的數據表前綴包含點字符，請返回修改.";
$strInsConfig="安裝程序無法寫入配置文件, 請修改配置文件權限.";
$strMixMysql="您的MySQL版本低於3.0, 由於程序沒有經過此平台的測試, 建議您換 MySQL4或MySQL5 的數據庫服務器.";
$strGenData="成功建立指定數據庫<br />";
$strHowSame="如何處理已經存在的同名數據表？";
$strOverInstall="覆蓋並繼續安裝";
$strAbort="不覆蓋並終止安裝";
$strAbort2="存在的同名數據表,可以返回上一步 覆蓋並繼續安裝，或者退出安裝程序";
$strOverAlert="警告：這些數據表中可能記錄著上次安裝留下的數據，覆蓋以後這些數據將全部丟失！";
$strCreateTable="創建表";
$strSuccess="成功";
$strGenErrInfo="由於您目錄屬性或服務器配置原因, 無法繼續安裝F2Blog, 請仔細閱讀安裝須知.";
$strGenSucInfo="您的服務器可以安裝和使用F2Blog, 請進入下一步設置管理員帳號.";
$strCreTabInfo="共創建了aaa個數據表.";
$strImpSetInfo="導入默認設定數據";
$strImpModInfo="導入默認模塊數據";
$strErrLenPw="密碼長度不能小於6位.";
$strErrPw="兩次輸入的密碼不相同";
$strsetAdminInfo="管理員用戶名和密碼已設置好，請記好你的用戶名和密碼。";
$strEmail="郵箱";
$strMaster = "站長暱稱";
$strAEmail="請輸入你的郵箱地址";
$strUserAlert="必須是5到20個字符，建議使用英文和符號混合";
$strNholidayDefault = "{0101,年初一春節}{0102,年初二}{0103,年初三}{0104,年初四}{0105,年初五開市}{0115,元宵節}{0505,端午節}{0701,開鬼門}{0707,七夕情人節}{0815,中秋節}{0816,中秋節翌日}{0909,重陽節}";
$strGholidayDefault = "{0101,元旦}{0214,情人節}{0308,婦女節}{0401,愚人節}{0501,勞動節}{0512,F2BLOG成立日}{1224,平安夜}{1225,聖誕節}{1226,聖誕節翌日}";
$strTitle = "Blog描述";
$strBlogUrl = "Blog網址(尾部必須帶有/符號)";
$strName="Blog名稱";
$strCreateDataBase="如果不存在此數據庫，則建立它！";
$strCreateDataBaseOK="數據庫創建成功";
$strCreateDataBaseNo="您無權創建數據庫";
$strNickNameUserName="用戶名不能與昵稱相同";
$strDefaultCategory="未分類文章";
?>