<table class="defaultTable" border="1">
    <tr>

        <th>Subject</th>
        <th>Text</th>
    </tr>

        <tr>

            <td><?php echo $data['message']->getSubject() ?></td>
            <td><?php echo $data['message']->getText() ?></td>
        </tr>
</table>
<h2> Reply Message</h2>
<?php echo $data['form'] ?>