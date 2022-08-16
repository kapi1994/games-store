<main class="container">
    <div class="row mt-5">
        <div class="col-10 col-lg-6dsd mx-auto">
            <em id="contactResponseMessage"></em>
            <form action="#">
                <div class="mb-3">
                    <label for="first-name-contact" class="mb-2">First name</label>
                    <input type="text" name="first-name-contact" id="first-name-contact" class="form-control">
                    <em id="first-name-contact-error"></em>
                </div>
                <div class="mb-3">
                    <label for="last-name-contact" class="mb-2">Last name</label>
                    <input type="text" name="last-name-contact" id="last-name-contact" class="form-control">
                    <em id="last-name-contact-error"></em>
                </div>
                <div class="mb-3">
                    <label for="email-contact" class="mb-2">Email</label>
                    <input type="email" name="email-contact" id="email-contact" class="form-control">
                    <em id="email-contact-error"></em>
                </div>
                <div class="mb-3">
                    <label for="message-contact" class="mb-2">Message</label>
                    <textarea name="message-contact" id="message-contact" cols="30" rows="5" class="form-control"></textarea>
                    <em id="message-contact-error"></em>
                </div>
                <button class="btn btn-primary" id="btnSaveContact" type='button'>Send</button>
            </form>
        </div>
    </div>
</main>