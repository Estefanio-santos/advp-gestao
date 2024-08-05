const mongoose = require('mongoose');

mongoose.connect('mongodb://localhost:27017/advp', {
    useNewUrlParser: true,
    useUnifiedTopology: true
});

const db = mongoose.connection;

db.on('error', console.error.bind(console, 'Erro de conexão:'));
db.once('open', () => {
    console.log('Conectado ao MongoDB');
});

module.exports = db;
