# projet Gift

Formet Romain
Durand Quentin
Becker Doryann chef du groupe

Pour installer l'application sur n'importe quel machine, il faut  : 

- Récupérer le projet en faisant un git clone
  
- Ouvrir un terminal dans la racine du projet
  
- Effectuer ces commandes :
  - docker compose create
  - docker compose start
    
- Pour vérifier que tous les services sont lancés, faire la commande :
  - docker ps -a
    
- Entrer dans le navigateur l'url :
  http://localhost:40069 : Accéder au site internet
  http://localhost:40072 : Accéder à la base de donné
  http://localhost:40070 : A l'api

- Pour l'api, il faut compléter l'url par :
  - /api/categories : pour accéder à la liste des catégories
  - /api/coffrets/{id} : pour accéder aux détails d'un coffret
  - /api/categories/{id}/prestations : pour accéder aux prestations d'une catégorie
  - /api/prestations : pour accéder à la liste des prestations
  
