var button = document.querySelector('button');
var eventSource = new EventSource('//localhost/journalisthelper/modules/dataserver.php');
console.log(eventSource.withCredentials);
console.log(eventSource.readyState);
console.log(eventSource.url);
var eventList = document.querySelector('ul');
eventSource.onopen = function() {
    console.log("Connection to server opened.");
};
eventSource.onmessage = function(event) {
    // var newElement = document.createElement("li");
    // newElement.textContent = "message: " + e.data;
    // eventList.appendChild(newElement);

};
eventSource.onerror = function() {
    console.log("EventSource failed.");
};
button.onclick = function() {
    console.log('Connection closed');
    eventSource.close();
};



eventSource.addEventListener("ping", function(e) {
    var newElement = document.createElement("li");

    var obj = JSON.parse(e.data);
    newElement.innerHTML = "ping at " + obj.time;
    eventList.appendChild(newElement);
}, false);



eventSource.addEventListener("update", function (event) {
    let jdata = JSON.parse(event.data);
    console.log(jdata);
})

eventSource.addEventListener("init", function (event) {
    let jdata = JSON.parse(event.data);
    console.log(jdata);
})
