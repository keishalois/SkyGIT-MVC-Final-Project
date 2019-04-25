<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    foreach($chatmessages as $chatmessage) { ?>
        <div class="chatboxmessage">
            <div>
<!-- this div displays the date and username associated with the comment -->
<div> <p>
              <span class="chatdate"> <?php echo $chatmessage->getTimestamp();?> </span>
              <span class="chatname"> <?php echo $chatmessage->getUser();?></span>
              <span class="chatmessage"><?php echo $chatmessage->getMessage();?> </span>
    </p>
                </div>
            </div> <?php } ?>