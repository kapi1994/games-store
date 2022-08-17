<?php
$user_id = $_SESSION['user']->id;
$wishlistItems = getWishlistItems($user_id);

?>
<main class="container">
    <div class="row mt-5">
        <div class="col-lg-10 mx-auto">
            <div id="responseWishlsitMessage"></div>
            <div class="row" id='wishlist'>
                <?php if (count($wishlistItems) > 0) :
                    foreach ($wishlistItems as $wishlistItem) : ?>
                        <div class="col-lg-3 mb-2 mb-lg-0">
                            <div class="card">
                                <img src="assets/images/games/thumbnail/<?= $wishlistItem->image_path ?>" alt="">
                                <div class="card-body">
                                    <h3><?= $wishlistItem->name ?></h3>
                                    <span><?= $wishlistItem->platformName ?></span>
                                    <div class="d-grid mt-2">
                                        <button class="btn btn-primary mb-2 btn-add-to-cart-from-wishlist" type='button' id='btnAddToCart<?= $wishlistItem->id ?>'>Add to cart</button>
                                        <button class="btn btn-danger btn-remove-from-wishlist" type='button' data-item='<?= $wishlistItem->id ?>' data-game='<?= $wishlistItem->game_edition_id ?>'>Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                else : ?>
                    <div class="text-center">
                        <h1 class="mb-5">Your wishlist is empty</h1>
                        <a href="index.php?page=games" class="btn btn-primary">Back to games</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>