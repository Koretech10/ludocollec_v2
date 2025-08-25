# legacy_vendors

Ce dossier contient des fichiers SCSS pouvant être importés avec `@use`. Ils existent car le vendor n'utilisent pas 
`@use` dans leurs fichiers, ce qui peut causer des problèmes à l'importation dans la feuille de style. De plus, il est 
compliqué de jongler entre des `@import` et `@use` car `@use` doit apparaître avant `@import` mais ces vendors doivent 
être importés avant le reste pour pouvoir être utilisés dans les feuilles de style.
