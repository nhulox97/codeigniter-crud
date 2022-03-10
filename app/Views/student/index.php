<div class=" d-flex flex-row justify-content-end">
    <a href="<?= site_url('student/add/0') ?>" type=" button" class="btn btn-success">Agregar estudiante</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">DUI</th>
            <th scope="col">Student code</th>
        </tr>
    </thead>
    <tbody>
        <?php $counter = 0; ?>
        <?php foreach ($students as $student) : ?>
            <tr>
                <td><?php echo ++$counter; ?></td>
                <td><?php echo $student->first_name; ?></td>
                <td><?php echo $student->last_name; ?></td>
                <td><?php echo $student->dui; ?></td>
                <td><?php echo $student->code_id; ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>