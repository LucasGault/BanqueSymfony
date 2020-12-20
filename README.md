Banque


- ~~ Permettre à des users de se login et de se logout ~~ 
- ~~ Permettre à des users ADMIN de créer de nouveaux utilisateurs ~~ 
- ~~ Permettre à des users ADMIN de créer, éditer, afficher et supprimer des comptes bancaires à un utilisateur ~~ 
- ~~ Permettre à des users non ADMIN de voir leur comptes bancaires ~~   et d’en afficher le solde actuel
- Permettre à des users non ADMIN de pouvoir ajouter des bénéficiaires en rentrant l’iban d’un compte bancaire
- Permettre à des users non ADMIN de créer des transactions avec comme compte débité, un compte qui lui appartient, 
    et comme compte crédité, soit un compte qui lui appartient, soit le compte d’un de ses bénéficiaires

Un compte bancaire :
    - un iban, 
    - un solde initial, 
    - une liste de transactions de crédits, |
    - une liste de transactions de débits   |
    - être lié à un user

Une transaction :
    - un compte débité, 
    - un compte crédité,
    - un montant 
    - une date

Un user :
    - un nom, 
    - un prénom 
    - une date de naissance

Le “sole actuel” correspond à : 
    - solde initial + somme des crédits - somme des débits


Ajouter le fichier `.env`
