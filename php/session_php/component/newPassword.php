<?php

echo " 
                          
            <div class='form-row m-b-55'>
            <div class='name'>Password*</div>
            <div class='value'>
                
                <div class='input-group-desc'>
                    <input class='input--style-5' type='password' name='pswd'
                        id='password'
                        onkeyup = 'validPswd(this)' required>
                    
                    <div id='pswd-feedback'></div>
                    
                </div>
                <div class='d-md-table-row'>
                    <input class='d-table-cell p-t-15' type='checkbox' id=show-pswd onclick='showPswd()'>
                    <label class='d-table-cell p-t-15' label--desc'>Show password</label>
                </div>   
            </div>
                                        
            </div>
            <div class='form-row m-b-55'>
            <div class='name'>Repeat Password*</div>
            <div class='value'>
                <div class='input-group-desc'>
                    <input class='input--style-5' type='password' id='password-check'
                        onkeyup='matchesPassword(this)' required>
                    <div id='matching-feedback'></div>

                </div>
            </div>
            </div>

            <div>
                <button class='btn btn--radius-2 btn--red' id='submitBtn' onclick='checkAndSubmitForm()'>Confirm</button>
            </div>

  ";

?>