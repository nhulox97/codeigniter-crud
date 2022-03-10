<?php if ($result != false) : ?>
    <div class="alert alert-<?= $result['type']; ?> alert-dismissible fade show" role="alert">
        <p class="pl-2"><strong><?php echo $result['msg']; ?></strong></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <form method="post" id="deleteForm">
        <input type="number" hidden value="0" id="userDelete">
    </form>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModal">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure that you want to delete this student?
                <br>
                <strong>This action cannot be undone</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" onclick="deleteStudent()">Delete</button>
            </div>
        </div>
    </div>
</div>


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
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="studentsList">
        <?php $counter = 0; ?>
        <?php foreach ($students as $student) : ?>
            <tr>
                <td><?php echo ++$counter; ?></td>
                <td id="first_name<?= $counter ?>"><?php echo $student->first_name; ?></td>
                <td id="last_name<?= $counter ?>"><?php echo $student->last_name; ?></td>
                <td id="dui<?= $counter ?>"><?php echo $student->dui; ?></td>
                <td id="code_id<?= $counter ?>"><?php echo $student->code_id; ?></td>
                <td>
                    <a href="<?= site_url('student/add/' . $student->id) ?>" type="button" class="btn btn-warning px-3"><i class="fas fa-pen" aria-hidden="true"></i></a>
                    <button type="button" class="btn btn-danger px-3" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteId(<?= $student->id ?>)"><i class="fas fa-trash" aria-hidden="true"></i></button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<div class="d-flex flex-row justify-content-between">
    <div class="pl-5">
        <?= $pager->links('default', 'paginator'); ?>
    </div>

    <form class="pr-5" method="get" action="<?= current_url() ?>" id="pgSizeForm">
        <select class="form-control float-right" name="pgSize" onchange="changePgSize()" id="pageSize">
            <?php foreach ([5, 10, 25, 50] as $limit) : ?>
                <option <?php if ($currPg == $limit) echo 'selected' ?> value="<?= $limit ?>"> <?= $limit ?></option>
            <?php endforeach; ?>
        </select>
    </form>
</div>


<script>
    var id = 0;

    function setDeleteId(userId) {
        id = userId;
    }

    function changePgSize() {
        var element = document.getElementById('pgSizeForm');
        element.submit();
    }

    function deleteStudent() {
        var student = document.getElementById('userDelete');
        student.value = id;
        var form = document.getElementById('deleteForm')
        form.action = 'student/delete/' + id;
        form.submit();
    }
</script>