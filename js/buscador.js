document.getElementById("buscador").addEventListener("input", function() { //evento escucha para el input con id=buscador
    var input = this.value.toLowerCase(); //convertimos la entrada de texto a minuscula para que no sea sensible a mayuscula o minuscula
    var tabla = document.getElementById("tabla");
    var rows = tabla.getElementsByTagName("tr");
  
    for (var i = 0; i < rows.length; i++) {
      var rowData = rows[i].getElementsByTagName("td");
      var shouldShowRow = false;
  
      if (rowData.length > 0) {
        var nombre = rowData[2].innerHTML.toLowerCase();
  
        if (nombre.indexOf(input) > -1) {
          shouldShowRow = true;
        }
      }
  
      if (shouldShowRow || rows[i].parentNode.tagName === 'THEAD') {
        rows[i].style.display = "";
      } else {
        rows[i].style.display = "none";
      }
    }
  });
  