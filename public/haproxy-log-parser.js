function updateOutputArea()
{
    logFileLine=document.getElementById('log-file-line').value;

    xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange=function() {
        if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
            document.getElementById("output-area").innerHTML = xmlHttpRequest.responseText;
        }
    };

    xmlHttpRequest.open("POST","/parse/",true);
    xmlHttpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlHttpRequest.send("query="+logFileLine);
}
