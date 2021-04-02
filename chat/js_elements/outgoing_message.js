
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
    time_date.innerText = message.time + " | " + message.date;
    message_text.innerText = message.text;

    // NESTING ELEMENTS
    sent_msg.appendChild(message_text);
    sent_msg.appendChild(time_date);
    outgoing_msg.appendChild(sent_msg);

    return outgoing_msg;
}
export {createOutgoingMessage};


// THE RESULT OF createOutgoingMessage SHOULD BE THE FOLLOWING

//  <div class="outgoing_msg">
//     <div class="sent_msg">
//         <p>Test which is a new approach to have all solutions</p>
//         <span class="time_date"> 11:01 AM | June 9</span>
//     </div>
// </div> 