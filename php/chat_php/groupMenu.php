
<label for="AddUser">Add user</label>

<input 
    class="form-input"
    id="user-search" 
    list="user-list" 
    name="user-search" 
    placeholder="write the name of the user"
    oninput="updateAvailableUsers()"
>

<Select id="user-list">
    
</Select>

<button class="btn-info" onclick="addUserToConversation()">add</button>

<div id="conversationUsers"></div>

<button class="btn btn-danger" onclick="leaveConversation()">Leave Group</button>
