<?php //print_r($messages); ?>
<?php foreach($messages as $m): ?>
    <tr>
        <?php if (date("n/j/Y",$m->date) == date("n/j/Y",time()))
                {$date = date("g:i a",$m->date);}
              else
                {$date = date("n/j g:i a",$m->date);}
              ?>
        <td class="chat-row"><b><?=$m->chat_name?></b> <i><?=$date?></i><br>
        <?=$m->message_text?></td>
    </tr>
<?php endforeach;?>