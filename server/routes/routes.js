const express = require('express');
const multer = require('multer');
const path = require('path');
const fs = require('fs');

const router = express.Router();

const diskStorage = multer.diskStorage({
    destination: path.join(__dirname, '../images'),
    filename: (req, file, cb) => {
        cb(null, Date.now() + '-' + file.originalname)
    }
})

const fileUpload = multer({
    storage: diskStorage
}).single('image')

router.get('/', (req, res )=> {
    res.send('hola mundo')
})

router.post('/data/post', fileUpload ,(req, res)=>{

    req.getConnection((err,conn)=>{
        if (err) throw err

        const type = req.file.mimetype
        const name = req.file.originalname
        const data= fs.readFileSync(path.join(__dirname,'../images/'+ req.file.filename))

        conn.query('INSERT INTO IMAGE set ?',[{type, name, data}],(err,rows)=>{
            if (err) throw err
            res.send('Imagen Guardada!')
        })
    })

    console.log(req.file)

})


module.exports = router