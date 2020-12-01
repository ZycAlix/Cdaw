Readme.md         # décrit l'organisation de votre dépôt, où trouver les docs, les auteurs, ...
doc/
   sujet.md       # votre sujet de projet
   REST_API/      # contient la doc de votre API WEB
   Deploiement.md # décrit comment déployer et configurer votre Projet

UX/
   Maquettes/     # contient les maquettes de votre site
   static/        # contient une maquette statique HTML/CSS de votre site
   ...
AGL/
   Conception/
      mcd
      ...
   BD/
      createDatabase.sql   # fichier de création de votre BD (create table, ...)
      insertSampleData.sql # fichier insérant des données de tests dans la base
      ...
BackEnd/
   tpX/  # contient vos code pour les TPs
   src/  # contient le code de la partie BackEnd du projet
      config/        # contient la configuration du BackEnd (config BD, ...)
      model/         # contient les modèles
      controller/   # contient les contrôleurs
      view/
         templates_json/   # contient les templates JSON pour la construction des réponses HTTP
      index.php
FrontEnd/
   # Le contenu sera créer automatiquement et manuellement. Cf le lien ci-dessous
Laravel/
   ...