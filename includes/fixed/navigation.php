<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION['user']) && $_SESSION['user']->role_id == 1) : ?>
                    <li class="nav-item"><a href="admin.php?page=platforms" class="nav-link
                        <?php if (isset($_GET['page']) && $_GET['page'] == 'platforms') : ?>  fw-bold active border-bottom<?php endif; ?>
                    ">Platform</a></li>
                    <li class="nav-item"><a href="admin.php?page=publishers" class="nav-link
                            <?php if (isset($_GET['page']) && $_GET['page'] == 'publishers') : ?> fw-bold active border-bottom<?php endif; ?>
                    ">Publishers</a></li>
                    <li class="nav-item"><a href="admin.php?page=games" class="nav-link
                                <?php if (isset($_GET['page']) && $_GET['page'] == 'games') : ?> fw-bold active border-bottom<?php endif; ?>
                    ">Games</a></li>
                    <li class="nav-item"><a href="admin.php?page=orders" class="nav-link">Orders</a></li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="nav-item"><a href="index.php?page=login" class="nav-link
                    <?php if (isset($_GET['page']) && $_GET['page'] == "login") : ?> fw-bold active border-bottom<?php endif; ?>
                ">Login</a></li>
                    <li class="nav-item"><a href="index.php?page=register" class="nav-link
                        <?php if (isset($_GET['page']) && $_GET['page'] == "register") : ?> fw-bold active border-bottom <?php endif; ?>
                ">Register</a></li><?php else : ?>
                    <li class="nav-item"><a href="models/auth/logout.php" class="nav-link">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>