<main class="container">
    <div class="row mt-5">
        <div class="col-lg-4 col-10 mx-auto">
            <div id="passwordRegistrationError"></div>
            <form action="#">
                <div class="mb-3">
                    <label for="first-name-register" class="mb-2">First name</label>
                    <input type="text" name="first-name-register" id="first-name-register" class="form-control">
                    <em id="first-name-register-error"></em>
                </div>
                <div class="mb-3">
                    <label for="last-name-register" class="mb-2">Last name</label>
                    <input type="text" name="last-name-register" id="last-name-register" class="form-control">
                    <em id="last-name-register-error"></em>
                </div>
                <div class="mb-3">
                    <label for="email-register" class="mb-2">Email</label>
                    <input type="email" name="email-register" id="email-register" class="form-control">
                    <em id="email-register-error"></em>
                </div>
                <div class="mb-3">
                    <label for="password-register" class="mb-2">Password</label>
                    <input type="password" name="password-register" id="password-register" class="form-control">
                    <em id="password-register-error"></em>
                </div>
                <div class="d-grid"><button class="btn btn-primary" id="btnRegister" type="button">Register</button></div>
            </form>
            <div class="d-flex justify-content-center mt-3">
                <span class="me-2">Allready have an account?</span>
                <a href="index.php?page=login">Login</a>
            </div>
        </div>
    </div>
</main>