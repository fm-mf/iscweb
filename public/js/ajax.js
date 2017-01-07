function ajax(action, cb, data) {
    if (window.ActiveXObject) {
        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    } else {
        httpRequest = new XMLHttpRequest();
    }
    httpRequest.open("POST", "https://buddy.isc.cvut.cz/ajax/"+action, true);
    httpRequest.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    httpRequest.setRequestHeader("Content-type", "application/json")
    httpRequest.onreadystatechange= function () { processRequest(cb); } ;
    httpRequest.send(JSON.stringify(data)); 
    
    
}

function processRequest(cb) {
    if (httpRequest.readyState == 4 && httpRequest.status == 200) {
        cb(httpRequest.responseText);
    }
}

