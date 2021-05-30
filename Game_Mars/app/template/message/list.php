<table class="defaultTable"  border="1">
    <tr>

        <th>From</th>
        <th>Subject</th>
        <th>Received Date</th>

    </tr>
    <?php
    foreach ($data['messages'] as $message){
        ?>
        <tr <?php if($message['seen'] == 0){ ?> class="unreadMessageRow"<?php }?>>

            <td><a href="<?php echo BASE_URL ?>/user/view/<?php echo $message['recipient_id'] ?>"><?php echo $message['name'] ?></td>
            <td><a href="<?php echo BASE_URL ?>/message/view/<?php echo $message['id'] ?>"><?php echo $message['subject'] ?></a></td>
            <td><?php echo $message['created_at'] ?></td>

        </tr>
        <?php
    }
    ?>
</table>




