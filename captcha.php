<html>
<head>
<meta charset="utf-8">
<title>PHP Secure Professional Captcha.</title>
</head>

<script src="capcha.php"></script>
<script src="captcha.js"></script>

<body>

<form id="frmCaptcha" name="frmCaptcha" onsubmit="return false" >
<h2 align="center">Captcha Checker</h5>
<table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="table" 
	   style="border-style: double; border-width: 2px; background-color: #c0c0c0;">
  <tr>
	<td>&nbsp;</td>
	 <td align="center">
      <img id="imgCaptcha" src="capi.jpg" />
    </td>
 
    <td>&nbsp; </td>
    <td>
		<label>Enter the 5 digit code here:</label>
      <input id="txtCaptcha" type="text" name="txtCaptcha" value="" maxlength="10" size="32" /><br><br>
	   Can't read the image? click  <a href="captcha.php">here</a> to refresh.<hr>
      <input id="btnCaptcha" type="button" value="Captcha Test" name="btnCaptcha" onclick="getParam(document.frmCaptcha)"
			 style="padding:5px; border-style:solid;"/>
   </tr>
    </td>
</table> 

<div id="result" align="center">&nbsp;</div>
</form>

</body>
</html>