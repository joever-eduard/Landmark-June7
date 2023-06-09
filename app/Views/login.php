<html>
    <head>
        <title>
            Login Page
        </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/login.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>
    <body>
        <div class="wrapper">
            <h1>Login for Registered Admin Users ONLY!</h1>
            <?php if (session()->get('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>

            <form method="post" > 
                <input type="text" name="username" placeholder="Username" value="<?= set_value('username') ?>">
                <input type="email" name="email" placeholder="Email" value="<?= set_value('email')?>">
                <input type="password" name="password" placeholder="Password" value="">
                
                <?php if (isset($validation)): ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>

                <button type="submit" name="submit">Login</button>
            </form>
            <div class="login">
                Doesn't Have an Account? <a href="/register">Sign-Up Here!</a>
            </div>
        </div>
        
    </body>
</html>