<?php require_once 'header_view.php' ?>


<form action="login.php" method="POST">
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                    <label for="password">Mot de passe</label>
                    <input type="text" name="password" id="password" class="form-control">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>

<a class="btn btn-success" href="register.php">S'inscrire</a>

<?php require_once 'footer_view.php' ?>