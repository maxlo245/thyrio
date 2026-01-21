const express = require('express');
const path = require('path');
const app = express();

// Dossier des fichiers statiques (CSS, JS, images)
app.use(express.static(path.join(__dirname, 'public')));

// Route page d'accueil
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'views', 'index.html'));
});

// Route page présentation
app.get('/about', (req, res) => {
  res.sendFile(path.join(__dirname, 'views', 'about.html'));
});

// 404
app.use((req, res) => {
  res.status(404).sendFile(path.join(__dirname, 'views', '404.html'));
});

const port = process.env.PORT || 3000;
app.listen(port, () => {
  console.log(`Serveur lancé sur http://localhost:${port}`);
});
