import React, {
  Fragment,
  useState
} from 'react'

function App() {

  const [file, setFile] = useState(null)
  /*const [info, setInfo] = useState([])

  useEffect(() => {
    const getBooks = () =>{
      fetch('http:localhost:9000')
    }
    getBooks()
  })*/

  const selectedHandler = e => {
    setFile(e.target.files[0])
  }
  const sendHandler = () => {
    if(!file){
      alert("Debes escoger un archivo")
      return
    }
    const formData = new FormData()
    formData.append('image',file)

    fetch('http://localhost:9000/data/post',{
      method: 'POST',
      body: formData
    })
    .then(res => res.text())
    .then(res => console.log(res))
    .catch(err =>{
      console.error(err)
    })

    document.getElementById('fileinput').value = null
    setFile(null)

  }

  return (
    <Fragment>
      <section className="content">
        <div className="container">
            <div>
                <p className="h1">Aprovecha nuestras promociones y descuentos</p>
                <button type="button" className="btn" id="modif-promo">Modificar</button>
            </div>
            <form id="modificar">
            <div className="mb-3">
                <label htmlFor="IdImput" className="form-label">ID Promocion</label>
                <input  type="number" className="form-control" id="IdImput"/>
              </div>
              <div className="mb-3">
                <label htmlFor="Tipo-Promocion" className="form-label">Tipo Promocion</label>
                <input  type="number" className="form-control" id="ipo-Promocion"/>
              </div>
              <div className="mb-3">
                <label htmlFor="Desc-Promocion" className="form-label">Descripcion Promocion</label>
                <input  type="text" className="form-control" id="Desc-Promocion"/>
              </div>
              <div className="mb-3">
                <label htmlFor="Img" className="form-label">Imagen</label>
                <input id="fileinput" onChange={selectedHandler} type="file" className="form-control"/>
              </div>
              <button onClick={sendHandler} type="button" className="btn btn-primary">Submit</button>
            </form>
            <div>
                <div className="row">
                    <div className="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <img className="img-fluid  rounded-3" alt="promocion" src="recursos/imagenes/promociones1.png"/>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quia quibusdam eaque
                            voluptatibus suscipit voluptatem architecto, ducimus adipisci aspernatur rem, tempora hic
                            voluptate omnis asperiores odio cum vero repellat iste?</p>
                    </div>
                    <div className="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <img className="img-fluid  rounded-3" alt="promocion" src="recursos/imagenes/promociones1.png"/>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quia quibusdam eaque
                            voluptatibus suscipit voluptatem architecto, ducimus adipisci aspernatur rem, tempora hic
                            voluptate omnis asperiores odio cum vero repellat iste?</p>
                    </div>
                    <div className="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <img className="img-fluid  rounded-3" alt="promocion" src="recursos/imagenes/promociones1.png"/>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quia quibusdam eaque
                            voluptatibus suscipit voluptatem architecto, ducimus adipisci aspernatur rem, tempora hic
                            voluptate omnis asperiores odio cum vero repellat iste?</p>
                    </div>
                    <div className="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <img className="img-fluid  rounded-3" alt="promocion" src="recursos/imagenes/promociones1.png"/>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quia quibusdam eaque
                            voluptatibus suscipit voluptatem architecto, ducimus adipisci aspernatur rem, tempora hic
                            voluptate omnis asperiores odio cum vero repellat iste?</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </Fragment>
  );
}

export default App;