<?php
$publishers = getAllPublishers();
$publisherPages = publisherPagination();
?>
<main class="container">
    <div class="row mt-5">
        <div id="publisherResponseMessage"></div>
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
                    <tbody id="publishers">
                        <?php
                        $index = 1;
                        foreach ($publishers as $publisher) : ?>
                            <tr id='publisher-row-<?= $index ?>'>
                                <th scope="row"><?= $index ?></th>
                                <td><?= $publisher->name ?></td>
                                <td><?= date('d/m/y H:i:s', strtotime($publisher->created_at)) ?></td>
                                <td><?= $publisher->updated_at != null ? date('d/m/y H:i:s', strtotime($publisher->created_at)) : '-' ?></td>
                                <td><button class="btn btn-sm btn-success btn-edit-publisher" data-id='<?= $publisher->id ?>' data-index='<?= $index ?>' type='button'>Edit</button></td>
                                <td><button class="btn btn-sm btn-danger btn-delete-publisher" data-id='<?= $publisher->id ?>' data-index='<?= $index ?>' data-deleted='<?= $publisher->is_deleted ?>'>
                                        <?= $publisher->is_deleted == 0 ? "Delete" : "Restore" ?>
                                    </button></td>
                            </tr>
                        <?php $index++;
                        endforeach; ?>
                    </tbody>
                </table>

            </div>
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id='publisher-pagination'>
                        <?php
                        for ($i = 0; $i < $publisherPages; $i++) : ?>
                            <li class="page-item <?php if ($i == 0) : ?> active <?php endif; ?>"><a class="page-link publisher-pagination-pages" href="#" data-limit="<?= $i ?>"><?= $i + 1 ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-lg-4 mt-2 mt-lg-0">
            <form action="#">
                <input type="hidden" name="publisher-id" id="publisher-id">
                <input type="hidden" name="publisher-index" id="publisher-index">
                <div class="mb-3">
                    <label for="publisher-name" class="mb-2">Name</label>
                    <input type="text" name="publisher-name" id="publisher-name" class="form-control">
                    <em id="publisher-name-error"></em>
                </div>
                <div class="d-grid">
                    <button class="btn btn-outline-primary" id="btnPublisherSave" type='button'>Save</button>
                    <button class="btn btn-outline-danger mt-2" id="btnPublisherReset" type="button">Reset</button>
                </div>
            </form>
        </div>
    </div>
</main>