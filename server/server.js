const express = require('express')
const mysql = require('mysql2')
const myconn = require('express-myconnection')
const cors = require('cors')


const app = express()

//middleware
app.use(myconn(mysql, {
    host: 'localhost',
    port: 3306,
    user: 'root',
    password: 'FIOGsymn8288',
    database: 'topcine'
}))

app.use(cors())


app.use(require('./routes/routes'))


//server
app.listen(9000, () => {
    console.log('Server running at http://localhost:9000')
})
