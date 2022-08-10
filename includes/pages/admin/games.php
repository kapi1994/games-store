<?php
$games = getAllGames();
$gamesPage = gamePagination();
?>
<main class="container">
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="table-responsive-sm table-responsive-md">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Publisher</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id='games'>
                        <?php
                        $index = 1;
                        foreach ($games as $game) : ?>
                            <tr id='game-row-<?= $index ?>'>
                                <th scope="row"><?= $index ?></th>
                                <td><?= $game->name ?></td>
                                <td><?= $game->publisherName ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($game->created_at)) ?></td>
                                <td><?= $game->updated_at != null ? date('d/m/Y H:i:s', strtotime($game->updated_at)) : "-" ?></td>
                                <td><button class="btn btn-sm btn-success btn-change-game" data-id='<?= $game->id ?>' data-index='<?= $index ?>'>Edit</button></td>
                                <td><button class="btn btn-sm btn-danger btn-delete-change" data-id='<?= $game->id ?>' data-index='<?= $index ?>' data-status='<?= $game->is_deleted ?>'>
                                        <?= $game->is_deleted == 0 ? "Delete" : "Restore" ?>
                                    </button></td>
                            </tr>
                        <?php
                            $index++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id='game-pagination'>
                        <?php
                        for ($i = 0; $i < $gamesPage; $i++) : ?>
                            <li class="page-item <?php if ($i == 0) : ?> active <?php endif ?>"><a class="page-link game-pagination-pages" href="#" data-limit='<?= $i ?>'><?= $i + 1 ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-lg-4 mt-2 mt-lg-0">
            <form action="#">
                <input type="hidden" name="game-id" id="game-id">
                <input type="hidden" name="game-index" id="game-index">
                <div class="mb-3">
                    <label for="game-name">Name</label>
                    <input type="text" name="game-name" id="game-name" class="form-control">
                    <em id="game-name-error"></em>
                </div>
            </form>
        </div>
    </div>
</main>