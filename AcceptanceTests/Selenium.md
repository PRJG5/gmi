# Installation Selenium
Plugin a installer au sein du browser
 - Chrome  [install extension](https://chrome.google.com/webstore/detail/selenium-ide/mooikfkahbdckldjjndioackbalphokd)
 - Firefox [install extension](https://addons.mozilla.org/en-GB/firefox/addon/selenium-ide/)

# Selenium : Structure fichier
Un fichier Selenium présent dans le dossier `AcceptanceTests` correspond à un projet Selenium. L'extension des fichiers projets est `.side`
**Attention** si l'extension n'est pas  `.side`, Selenium refusera d'ouvrir votre projet.

Afin d'organiser les tests, créez un projet par Story.
Par exemple le fichier `Story01.side` contient les tests relatifs à la première story (écran de connexion de l'application).

# Selenium : Structure d'un projet
Au sein de chaque projet, créez des `Test case`. Chaque `Test case` valide un cas d'utilisation de la story. Par exemple pour la story 1 :
 - **Login** : Une connexion réussie avec le user existant JLC - jlechien@he2b.be
 - **RegisterExistingUser** : Une tentative ratée d'enrgistrement avec l'email jlechien@he2b.be
 - **RegisterNoLanguage** : Une tentative d'enregistrement ratée avec un utilisateur qui ne sélectionne aucune langue

Notez que dans chaque test une assertion est présente afin de vérifier l'état de la page (présence d'un texte sur la page par exemple).

# Selenium : Exécuter les tests
Dans Selenium cliquez sur l'icone `Open project` et sélectionner un fichier `.side`. Cliquez ensuite sur le bouton `Run all tests` et vérifiez qu'aucune erreur n'apparaît dans la console.
