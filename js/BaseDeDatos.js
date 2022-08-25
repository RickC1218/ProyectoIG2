const mysql = require('mysql');

const conection = mysql.createConnection({
    host:'localhost',
    user: 'Carlos',
    password: 'Linkcar_1999',
    database: 'TopCine',
    insecureAuth : true
});

conection.connect((err)=>{
    if(err) throw err
    console.log('Conectado a la Base de datos TopCine');
})

/* Consultas */

conection.query('SELECT * FROM ADMINISTRADOR',(err,rows)=>{
    if(err) throw err
    console.log ('los datos de la tabla PELICULA son:\n')
    console.log(rows)
});

conection.end();