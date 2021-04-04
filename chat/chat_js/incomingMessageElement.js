// CREATES THE HTML ELEMTNT REPRESENTING AN INCOMING MESSAGE
function createIncomingMessage(message) {
    var incoming_msg       = document.createElement("div");
    var incoming_msg_img   = document.createElement("div");
    var img                = document.createElement("img");
    var received_msg       = document.createElement("div");
    var received_withd_msg = document.createElement("div");
    var message_text       = document.createElement("p");
    var time_date          = document.createElement("span");

    // ASSIGNING CLASSES
    incoming_msg.className       = "incoming_msg";
    incoming_msg_img.className   = "incoming_msg_img";
    received_msg.className       = "received_msg";
    received_withd_msg.className = "receiver_withd_msg"
    time_date.className          = "time_date";

    // ASSIGNING IMAGE URL AND ALT TEXT
    img.src = "https://ptetutorials.com/images/user-profile.png";
    img.alt = "sunil";

    // ASSIGNING INNER TEXT
    time_date.innerText    = message.time + " | " + message.date;
    message_text.innerText = message.text;

    // NESTING ELEMENTS
    incoming_msg_img.appendChild(img);
    received_withd_msg.appendChild(message_text);
    received_withd_msg.appendChild(time_date);
    received_msg.appendChild(received_withd_msg);
    incoming_msg.appendChild(incoming_msg_img);
    incoming_msg.appendChild(received_msg);

    return incoming_msg;
}