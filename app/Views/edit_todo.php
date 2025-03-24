<!DOCTYPE html>
<html lang="en">

<head>
  <title>Edit Todo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="<?= site_url('dashboard') ?>">Todo App</a>
      <div class="d-flex">
        <span class="navbar-text text-white me-3">
          Welcome, <?= session('user_name') ?>
        </span>
        <a href="<?= site_url('logout') ?>" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <h3 class="text-center">Edit Todo</h3>

    <div class="d-flex justify-content-center align-items-center">
      <div class="col-md-6">
        <!-- Check for Errors or Success Messages -->
        <?php if (session()->getFlashdata('error')): ?>
          <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
          <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <!-- Edit Todo Form -->
        <form action="<?= site_url('updateTodo') ?>" method="POST">
          <input type="hidden" name="id" value="<?= esc($todo['id']) ?>">

          <div class="mb-3">
            <label for="task" class="form-label">Edit Task</label>
            <input type="text" name="task" id="task" class="form-control" value="<?= esc($todo['task']) ?>" required>
          </div>

          <div class="d-flex justify-content-between">
            <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Task</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>