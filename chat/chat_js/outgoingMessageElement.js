// CREATES THE HTML ELEMTNT REPRESENTING AN OUTGOING MESSAGE
function createOutgoingMessage(message) {
    var outgoing_msg  = document.createElement("div");
    var sent_msg      = document.createElement("div");
    var message_text  = document.createElement("p");
    var time_date     = document.createElement("span");

    // ASSIGNING CLASSES
    outgoing_msg.className = "outgoing_msg";
    sent_msg.className     = "sent_msg"
    time_date.className    = "time_date";

    // ASSIGNING INNER TEXT
    time_date.innerText    = message.time + " | " + message.date;
    message_text.innerText = message.text;

    // NESTING ELEMENTS
    sent_msg.appendChild(message_text);
    sent_msg.appendChild(time_date);
    outgoing_msg.appendChild(sent_msg);

    return outgoing_msg;
}