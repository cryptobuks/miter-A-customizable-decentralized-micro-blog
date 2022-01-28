function validate() {
    var tenonbox = document.forms["tenonform"]["tenon"].value;
    if (tenonbox == "") {
        return false;
	}
}

function validate_panel() {
    var panelbox = document.forms["panelform"]["panel"].value;
    if (panelbox == "") {
        return false;
	}
}