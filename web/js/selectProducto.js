function selectProducto() {
	
	var elemento = document.getElementById('elemento').value;
	
	if(elemento == "Lavandina" ||
		elemento == "Detergente" ||
		elemento == "Desodorante de piso" ||
		elemento == "Líquido para lampazo")
		document.getElementById("cantidad").innerHTML = "Litros:";
	else
		document.getElementById("cantidad").innerHTML = "Cantidad:";
	
	document.getElementById("cantidad").maxLength = 0;
	return;
}
