const express = require('express');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');
const Member = require('./models/Member');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

const app = express();
const PORT = process.env.PORT || 3000;

mongoose.connect('mongodb://localhost:27017/advp', { useNewUrlParser: true, useUnifiedTopology: true });

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

app.post('/register', async (req, res) => {
    const { name, email, password } = req.body;

    const hashedPassword = await bcrypt.hash(password, 10);

    const newMember = new Member({
        name,
        email,
        password: hashedPassword
    });

    await newMember.save();
    res.redirect('/login.html');
});

app.post('/login', async (req, res) => {
    const { email, password } = req.body;

    const member = await Member.findOne({ email });

    if (!member) {
        return res.status(400).send('Email não encontrado');
    }

    const isMatch = await bcrypt.compare(password, member.password);

    if (!isMatch) {
        return res.status(400).send('Senha incorreta');
    }

    const token = jwt.sign({ id: member._id }, 'secret_key', { expiresIn: '1h' });

    res.header('auth-token', token).redirect('/restricted.html');
});

const verifyToken = (req, res, next) => {
    const token = req.header('auth-token');
    if (!token) return res.status(401).send('Acesso negado');

    try {
        const verified = jwt.verify(token, 'secret_key');
        req.user = verified;
        next();
    } catch (err) {
        res.status(400).send('Token inválido');
    }
};

app.get('/restricted.html', verifyToken, (req, res) => {
    res.send('Conteúdo restrito para membros cadastrados');
});

app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});
