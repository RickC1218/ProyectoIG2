"use strict";
window.addEventListener("load", () => {
  //Slider Actions
  var options = {
    accessibility: true,
    prevNextButtons: true,
    pageDots: true,
    setGallerySize: false,
    arrowShape: {
      x0: 10,
      x1: 60,
      y1: 50,
      x2: 60,
      y2: 45,
      x3: 15,
    },
  };

  var carousel = document.querySelector("[data-carousel]");
  var slides = document.getElementsByClassName("carousel-cell");
  var flkty = new Flickity(carousel, options);

  flkty.on("scroll", function () {
    flkty.slides.forEach(function (slide, i) {
      var image = slides[i];
      var x = ((slide.target + flkty.x) * -1) / 3;
      image.style.backgroundPosition = x + "px";
    });
  });

  //Mostrar Trailers 

  document.querySelector("#Estreno1").addEventListener("click", Estreno1);
  document.querySelector("#Estreno2").addEventListener("click", Estreno2);
  document.querySelector("#Estreno3").addEventListener("click", Estreno3);
  document.querySelector("#Estreno4").addEventListener("click", Estreno4);

  function Estreno1() {
    Swal.fire({
      title: "Buzz Lightyear",
      text: "Trailer",
      width: '650px',
      background: '#041C3299',
      color: '#ffff',
      html: '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/WikwAJ3NQew?rel=0&amp;autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
      confirmButtonText: '<a href = "http://localhost:90/ProyectoIG2/Controller/Estrenos.php?ID=4"  style= "color:#041C3299; text-decoration: none; font-size:1rem;" >Adquiere tus boletos!!</a>',
      confirmButtonColor: '#ECB365',
      showCloseButton: true,
    });
  }
  function Estreno2() {
    Swal.fire({
      title: "Minions:Nace un Villano",
      text: "Trailer",
      width: '650px',
      background: '#041C3299',
      color: '#ffff',
      html: '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/MO019NU9XUk?rel=0&amp;autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
      confirmButtonText: '<a href = "http://localhost:90/ProyectoIG2/Controller/Estrenos.php?ID=2"  style= "color:#041C3299; text-decoration: none; font-size:1rem;" >Adquiere tus boletos!!</a>',
      confirmButtonColor: '#ECB365',
      showCloseButton: true
    });
  }
  function Estreno3() {
    Swal.fire({
      title: "Thor: Amor y Tormenta",
      text: "Trailer",
      width: '650px',
      background: '#041C3299',
      color: '#ffff',
      html: '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/ZaD7iZR0-5w?rel=0&amp;autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
      confirmButtonText: '<a href = "http://localhost:90/ProyectoIG2/Controller/Estrenos.php?ID=6"  style= "color:#041C3299; text-decoration: none; font-size:1rem;" >Adquiere tus boletos!!</a>',
      confirmButtonColor: '#ECB365',
      showCloseButton: true
    });
  }
  function Estreno4() {
    Swal.fire({
      title: "The Black Phone",
      text: "Trailer",
      width: '650px',
      background: '#041C3299',
      color: '#ffff',
      html: '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/o58A5Z7e8Kg?rel=0&amp;autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
      confirmButtonText: '<a href="http://localhost:90/ProyectoIG2/Controller/Estrenos.php?ID=3" style= "color:#041C3299; text-decoration: none; font-size:1rem;" >Adquiere tus boletos!!</a>',
      confirmButtonColor: '#ECB365',
      showCloseButton: true
    });
  }
});

