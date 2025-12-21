
<?php

require_once "functions.php";


$connection = new PDO('mysql:dbname=projectpicker;host=127.0.0.1', 'root', '');

$stmt = $connection->query("SELECT  project.*,user.*,project.*, user.id AS user_id, CONCAT(user.first_name, ' ', user.last_name) AS nom_prenom, COUNT(DISTINCT vote_positif.user_id) AS vote, COUNT(DISTINCT vote_negatif.user_id) AS downvote FROM user LEFT JOIN project ON project.user_id = user.id LEFT JOIN vote AS vote_positif ON vote_positif.project_id = project.id  AND vote_positif.value = 1 LEFT JOIN vote AS vote_negatif ON vote_negatif.project_id = project.id AND vote_negatif.value = -1 GROUP BY project.id, user.id, user.first_name, user.last_name;");
$cards = $stmt->fetchAll();



?>

<?php get_header("Acceuil")?>


    <section class="container">
        <div id="page">
            <h1>Découvrer les projets étudiants</h1>
            <p>Votez pour les meilleurs idées</p>
            <div class="barre">
                <h2>Projets proposées</h2>
                <div class="espace_btn">
                    <button  type="submit"  class="btn svgbtn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 0a256 256 0 1 1 0 512 256 256 0 1 1 0-512zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                        Plus récent
                    </button>
                    <button  type="submit"  class="btn svgbtn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M160.5-26.4c9.3-7.8 23-7.5 31.9 .9 12.3 11.6 23.3 24.4 33.9 37.4 13.5 16.5 29.7 38.3 45.3 64.2 5.2-6.8 10-12.8 14.2-17.9 1.1-1.3 2.2-2.7 3.3-4.1 7.9-9.8 17.7-22.1 30.8-22.1 13.4 0 22.8 11.9 30.8 22.1 1.3 1.7 2.6 3.3 3.9 4.8 10.3 12.4 24 30.3 37.7 52.4 27.2 43.9 55.6 106.4 55.6 176.6 0 123.7-100.3 224-224 224S0 411.7 0 288c0-91.1 41.1-170 80.5-225 19.9-27.7 39.7-49.9 54.6-65.1 8.2-8.4 16.5-16.7 25.5-24.2zM225.7 416c25.3 0 47.7-7 68.8-21 42.1-29.4 53.4-88.2 28.1-134.4-4.5-9-16-9.6-22.5-2l-25.2 29.3c-6.6 7.6-18.5 7.4-24.7-.5-17.3-22.1-49.1-62.4-65.3-83-5.4-6.9-15.2-8-21.5-1.9-18.3 17.8-51.5 56.8-51.5 104.3 0 68.6 50.6 109.2 113.7 109.2z"/></svg>
                        Plus votés
                    </button>

                </div>

            </div>
        

            <div class="card_espace">
                <?php foreach ($cards as $card) : ?>
                    <div class="card">
                        <h4>
                            <?php echo $card["title"]; ?>
                        </h4>
                        <div class="espace">
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">><path d="M224 248a120 120 0 1 0 0-240 120 120 0 1 0 0 240zm-29.7 56C95.8 304 16 383.8 16 482.3 16 498.7 29.3 512 45.7 512l356.6 0c16.4 0 29.7-13.3 29.7-29.7 0-98.5-79.8-178.3-178.3-178.3l-59.4 0z"/></svg>
                                <?php echo $card["nom_prenom"]; ?>
                            </p>
                            <p> 
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M128 0C110.3 0 96 14.3 96 32l0 32-32 0C28.7 64 0 92.7 0 128l0 48 448 0 0-48c0-35.3-28.7-64-64-64l-32 0 0-32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 32-128 0 0-32c0-17.7-14.3-32-32-32zM0 224L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-192-448 0z"/></svg>
                                <?php echo $card["created_at"]; ?>
                            </p>                    
                        </div>
                        <p class="txt_principale"><?php echo $card["descr"]; ?></p>
                        <div class="espace_btn">
    

                            <a href="" class="btn btn_orange"> 
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M80 160c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-48 0c-17.7 0-32-14.3-32-32L0 192c0-17.7 14.3-32 32-32l48 0zM270.6 16C297.9 16 320 38.1 320 65.4l0 4.2c0 6.8-1.3 13.6-3.8 19.9L288 160 448 160c26.5 0 48 21.5 48 48 0 19.7-11.9 36.6-28.9 44 17 7.4 28.9 24.3 28.9 44 0 23.4-16.8 42.9-39 47.1 4.4 7.3 7 15.8 7 24.9 0 22.2-15 40.8-35.4 46.3 2.2 5.5 3.4 11.5 3.4 17.7 0 26.5-21.5 48-48 48l-87.9 0c-36.3 0-71.6-12.4-99.9-35.1L184 435.2c-15.2-12.1-24-30.5-24-50l0-186.6c0-14.9 3.5-29.6 10.1-42.9L226.3 43.3C234.7 26.6 251.8 16 270.6 16z"/></svg>                                
                                <?php echo $card["vote"]; ?>
                                votes
                            </a>
                            <a href="" class="btn btn_orange"> 
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M384 32c26.5 0 48 21.5 48 48 0 6.3-1.3 12.2-3.4 17.7 20.4 5.5 35.4 24.1 35.4 46.3 0 9.1-2.6 17.6-7 24.9 22.2 4.2 39 23.7 39 47.1 0 19.7-11.9 36.6-28.9 44 17 7.4 28.9 24.3 28.9 44 0 26.5-21.5 48-48 48l-160 0 28.2 70.4c2.5 6.3 3.8 13.1 3.8 19.9l0 4.2c0 27.3-22.1 49.4-49.4 49.4-18.7 0-35.8-10.6-44.2-27.3L170.1 356.3c-6.7-13.3-10.1-28-10.1-42.9l0-186.6c0-19.4 8.9-37.8 24-50l12.2-9.7C224.6 44.4 259.8 32 296.1 32L384 32zM80 96c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-48 0c-17.7 0-32-14.3-32-32L0 128c0-17.7 14.3-32 32-32l48 0z"/></svg>                                
                                <?php echo $card["downvote"]; ?>
                                votes
                            </a>

                            <a href="" class="btn btn-blue">
                                 Voir détails
                            </a>

                        </div>
                    </div>
                <?php endforeach; ?>
                


            </div>

        </div>
    </section>
        

    
<?php get_footer()?>
