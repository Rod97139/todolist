<?php require_once 'header_view.php'?>

    <div class="container">
    <a class='btn btn-warning' href="logout.php">Se déconnecter</a>
        <div class="row mt-5">
            <div class="col-12">
                <h1>TO DO LIST</h1>
            </div>
        </div>
    
        <!-- Formulaire d'ajout -->
    
        <div class="row mt-5">
            <div class="col-12">
                <form action="index.php" method="POST">
                    <div class="form-group">
                    <label for="task_name">Tâche à effectuer</label>
                    <input type="text" name="task_name" id="task_name" class="form-control">
                    <label for="task_date">Pour quand ?</label>
                    <input type="text" name="task_date" id="task_date" class="form-control">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
        <!-- Tableau qui affiche la liste des tâches -->
        <?php if(!empty($articles)) : ?>
            <form  method="GET" id="orderForm" >
                <select name="order" id="order">
                    <option value="">Trier par</option>
                    <option value="asc">Plus préssé</option>
                    <option value="desc">Moins préssé</option>
                </select>
            </form>
        <div class="row mt-5">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#Id</th>
                            <th>Tâche à effectuer</th>
                            <th>Pour quand ?</th>
                            <th>Is Done ?</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($articles as $task) : ?>
                            <tr>
                                <td><?= $task->id ?></td>
                                <td><?= $task->task_name ?></td>
                                <td><?= $task->to_do_at ?></td>
                                <td>
                                    <?php if($task->is_done == 1) : ?>
                                    <a href="isDone.php?id=<?= $task->id?>" class="btn btn-success"></a>
                                    <?php else : ?>
                                    <a href="isDone.php?id=<?= $task->id?>" class="btn btn-danger"></a>  
                                    <?php endif ?></td>                                
                                <td>
                                    <a href="edit.php?id=<?= $task->id?>" class="btn btn-warning">Modifier</a>
                                    <a href="delete.php?id=<?= $task->id?>" class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>
                       <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php else: ?>
            <span class="alert alert-warning">Pas de résultat disponible</span>
        <?php endif ?>

        <?php if($nbre_pages > 1 ) : ?>
        <div class="row mt-5">
            <div class="col-12">
                <nav>
                    <ul class="pagination">
                        <li class="page-item <?php if($current_page == 1): ?>disabled <?php endif ?>">
                            <a class="page-link" href="?page=<?= $current_page -1 ?>">Previous</a>
                        </li>
                        
                            <li class="page-item">
                                <a class="page-link <?php if($current_page == 1): ?>active<?php endif ?>" href="?page=1">1</a>
                            </li>
                        <?php if($current_page > 5 ): ?>
                            <li class="page-item">
                                <a class="page-link disabled" >...</a>
                            </li>
                        <?php endif ?>
                        
                        <?php for($i=2; $i< $nbre_pages; $i++): ?>
                            <?php if($i >= $current_page - 2 && $i <= $current_page +2 ) : ?>
                            <li class="page-item">
                                <a 
                                    class="page-link page-link_action <?php if($current_page == $i): ?>active<?php endif ?>" 
                                    href="#" 
                                    data-page-number="<?= $i ?>"
                                >
                                    <?= $i ?>
                                </a>
                            </li>
                            <?php endif ?>
                        <?php endfor ?>
                        <?php if($nbre_pages - $current_page > 5 ): ?>
                            <li class="page-item">
                                <a class="page-link disabled" >...</a>
                            </li>
                        <?php endif ?>
                        <li class="page-item">
                            <a class="page-link <?php if($current_page == $nbre_pages): ?>active<?php endif ?>" href="<?= "?page=".$nbre_pages?>"><?= $nbre_pages ?></a>
                        </li>
                        
                        <li class="page-item">
                        <a class="page-link <?php if($current_page == $nbre_pages): ?>disabled <?php endif ?>" href="?page=<?= $current_page +1 ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <?php endif ?>
    
        </div>

       <?php require_once 'footer_view.php' ?>