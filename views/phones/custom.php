<?php if (! empty($_POST['custom'])) : ?>
    <?php for ($index = 0; $index < $_POST['custom']; $index++) : ?>

<div class="custom">
    <div>
        <label for="field_name">Name</label>
        <input type="text" name="field_name"/>
    </div>
    <div>
        <label for="field_value">Value</label>
        <input type="text" name="field_value"/>
    </div>
</div>

    <?php endfor; ?>
<?php endif; ?>


