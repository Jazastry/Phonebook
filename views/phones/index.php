<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Number</th>
    </tr>
    <?php foreach ($this->phones as $phone) : ?>
    <tr>
        <td><?php echo htmlspecialchars($phone['id']); ?></td>
        <td><?php echo htmlspecialchars($phone['name']); ?></td>
        <td><?php echo htmlspecialchars($phone['email']); ?></td>
        <td><?php echo htmlspecialchars($phone['number']); ?></td>
    </tr>
    <?php endforeach;?>
</table>
