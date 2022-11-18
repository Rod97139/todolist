<?php require_once 'header_view.php' ?>


<form action="register.php" method="POST">
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                    <label for="password">Mot de passe</label>
                    <input type="text" name="password" id="password" class="form-control">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>

<a class="btn btn-success" href="login.php">Se connecter</a>

<?php require_once 'footer_view.php' ?>