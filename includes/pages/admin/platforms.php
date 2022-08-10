<?php
$platforms = platforms();
$platformPages = platoformsPagination();
?>
<main class="container">
    <div class="row mt-5">
        <div id="platformResponseMessage"></div>
        <div class="col-lg-8">
            <div class="table table-responsive-sm table-responsive-md">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="platforms">
                        <?php
                        $index = 1;
                        foreach ($platforms as $platform) : ?>
                            <tr id='platform-row-<?= $index ?>'>
                                <th scope="row"><?= $index ?></th>
                                <td><?= $platform->name ?></td>
                                <td><?= date('d/m/y H:i:s', strtotime($platform->created_at)) ?></td>
                                <td><?= $platform->updated_at != null ? date('d/m/y H:i:s', strtotime($platform->created_at)) : '-' ?></td>
                                <td><button class="btn btn-sm btn-success btn-edit-platform" data-id='<?= $platform->id ?>' data-index='<?= $index ?>' type='button'>Edit</button></td>
                                <td><button class="btn btn-sm btn-danger btn-delete-platform" data-id='<?= $platform->id ?>' data-index='<?= $index ?>' data-deleted='<?= $platform->is_deleted ?>'>
                                        <?= $platform->is_deleted == 0 ? "Delete" : "Restore" ?>
                                    </button></td>
                            </tr>
                        <?php $index++;
                        endforeach; ?>
                    </tbody>
                </table>

            </div>
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id='platform-pagination'>
                        <?php
                        for ($i = 0; $i < $platformPages; $i++) : ?>
                            <li class="page-item <?php if ($i == 0) : ?> active <?php endif; ?>"><a class="page-link platform-pagination-pages" href="#" data-limit="<?= $i ?>"><?= $i + 1 ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-lg-4 mt-2 mt-lg-0">
            <form action="#">
                <input type="hidden" name="platform-id" id="platform-id">
                <input type="hidden" name="platform-index" id="platform-index">
                <div class="mb-3">
                    <label for="platform-name" class="mb-2">Name</label>
                    <input type="text" name="platform-name" id="platform-name" class="form-control">
                    <em id="platform-name-error"></em>
                </div>
                <div class="d-grid">
                    <button class="btn btn-outline-primary" id="btnPlatformSave" type='button'>Save</button>
                    <button class="btn btn-outline-danger mt-2" id="btnPlatformReset" type="button">Reset</button>
                </div>
            </form>
        </div>
    </div>
</main>