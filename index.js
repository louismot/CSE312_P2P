const express = require('express')
const app = express()
const port = 3000
var path = require('path');
app.use(express.static('public'));

const bodyParser = require('body-parser');
app.use(bodyParser.urlencoded({ extended: true }));

//Serving static HTML
app.get('/', function(req, res) {
    res.sendFile(path.join(__dirname + '/myhtml.html'));
});

app.listen(port, () => console.log(`Example app listening on port ${port}!`))
