
//Gets the browser specific XmlHttpRequest Object
function getXmlHttpRequestObject() {
 if (window.XMLHttpRequest) {
    return new XMLHttpRequest(); //Mozilla
 } else if (window.ActiveXObject) {
    return new ActiveXObject("Microsoft.XMLHTTP"); //IE
 } else {
    //Display our error message
    alert("Your browser doesn't support the XmlHttpRequest object.");
 }
}

var receiveReq = getXmlHttpRequestObject();

function makeRequest(url, param) {

 if (receiveReq.readyState == 4 || receiveReq.readyState == 0) {

 receiveReq.open("POST", url, true);

   receiveReq.onreadystatechange = updatePage; 

   //Add HTTP headers to the request
   receiveReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   receiveReq.setRequestHeader("Content-length", param.length);
   receiveReq.setRequestHeader("Connection", "close");

   //Make the request
   receiveReq.send(param);
 }   
}

//Called every time our XmlHttpRequest objects state changes
function updatePage() {

 if (receiveReq.readyState == 4) {
    setTimeout(function () {
       window.location.href = "captcha.php"; //will redirect to your blog page (an ex: blog.html)
		},1000);
   document.getElementById('result').innerHTML = receiveReq.responseText;

 }
}

//Called every time when form is perfomed
function getParam(theForm) {
 
 var url = 'server_side.php';
 var postStr = theForm.txtCaptcha.name + "=" + encodeURIComponent(theForm.txtCaptcha.value);
 makeRequest(url, postStr);
}