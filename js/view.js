var form = $("#newt");
var togg = $("#togg");
form.hide();

function toggleForm() {
    if (form.is(":visible")) {
        togg.html("Reply to thread");
        form.hide();
    } else {
        togg.html("Hide form");
        form.show();
    }
}

function reply(post) {
    form.show();
    $('html,body').scrollTop(0);
    if (post !== "")
        document.getElementById("text").innerHTML += ">>" + post + "\n";
}

function update() {
    var request = new XMLHttpRequest();
    request.open("GET", location.href, false);
    request.send(null);
    document.body.innerHTML = request.responseText;
    window.scrollTo(0,document.body.scrollHeight);
}
