const express = require('express')


const app = express()

app.use(require('./routes/routes'))

app.listen(9000, () => {
    console.log('Server running at http://localhost:9000')
})
