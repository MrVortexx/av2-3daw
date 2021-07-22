function makeXMLHTTPrequest(method, url){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
        document.getElementById("demo").innerHTML = xhttp.responseText;
    }
};
xhttp.open(method, url);
xhttp.send();
}