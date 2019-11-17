function validateForm() {
	var x = document.forms["Formular"]["absender"].value;
	if (x == null || x == "") {
		alert("Absender muss ausgefüllt werden");
		return false;
	}
}