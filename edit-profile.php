<?php 
include "libs/crud.php";
?>

<?php if($profil === false): ?>
<p>
    Vous vous êtes trompé!
</p>
<?php endif; ?>

<?php if($profil !== false): ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
        <input type="hidden" name="id" id="id" class="input" value="<?php echo $profil->id ?>">
        <label for="name">Pseudo</label>
        <input type="text" name="nom" id="nom" class="input" value="<?php echo $profil->nom ?>">
        <label for="age">Age</label>
        <input type="text" name="age" id="age" class="input" value="<?php echo $profil->age ?>">
        <input type="submit" name="update_profil" value="send" class="btn">
</form>

<?php endif; ?>