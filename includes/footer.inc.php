</div>
          
          <nav class="span4">
            <h2>Menu</h2>
            
            <ul>
				<li>	<!-- Formulaire pour la recherche -->
					<form action='index.php' method='post'>
						<div class='clearfix'>
							<div class='input'> <input type="text" name="search-bar"></div></div>
							<input type="submit" value='Recherche' class='btn btn-primary'>
					</form>
				</li>
			
                <li><a href="index.php">Accueil</a></li>
                <?php 
				//Si on est connecté, on affiche la rédaction d'article et la déconnexion
				if($connect == true){
				echo "<li><a href='article.php'>Rédiger un article</a></li>";
				echo "<li><a href='deconnexion.php'>Déconnexion</a></li>";
				}?>
				<?php 
				//si on n'est pas connecté, on affiche la connexion et l'inscription
				if($connect == false){
				echo "<li><a href='connexion.php'>Connexion</a></li>";
				echo "<li><a href='inscription.php'>Inscription</a></li>";
				}?>
            </ul>
            
          </nav>
        </div>
        
      </div>

      <footer>
        <p>#Biboule_2016</p>

      </footer>

    </div>

  </body>
</html>
