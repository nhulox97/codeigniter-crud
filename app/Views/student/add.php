<?php if ($errors != false) : ?>
    <ul class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php foreach ($errors as $error) : ?>
            <li class="pl-2"><strong><?php echo $error; ?></strong></li>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>


<div class=" d-flex flex-row justify-content-end">
    <a href="<?= site_url('student') ?>" type=" button" class="btn btn-danger">Cancelar</a>
</div>

<form method="post">
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $student->first_name ?>">
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $student->last_name ?>">
    </div>
    <div class="mb-3">
        <label for="dui" class="form-label">DUI</label>
        <input type="text" class="form-control" id="dui" name="dui" value="<?= $student->dui ?>">
    </div>
    <div class="mb-3">
        <label for="code_id" class="form-label">Student code</label>
        <input type="text" class="form-control" id="code_id" name="code_id" value="<?= $student->code_id ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>