function validate_user() {
    var userinput = document.forms["miter_user_form"]["miter_user"].value;
    if (userinput == "") {
        return false;
	}
}

function validate_title() {
    var titleinput = document.forms["miter_title_form"]["user_title"].value;
    if (titleinput == "") {
        return false;
	}
}

function validate_bio() {
    var bioinput = document.forms["miter_bio_form"]["miter_bio"].value;
    if (bioinput == "") {
        return false;
	}
}

function validate_color() {
    var colorinput = document.forms["miter_color_form"]["miter_color"].value;
    if (colorinput == "") {
        return false;
	}
}

function validate_header() {
    var headerinput = document.forms["miter_header_form"]["user_header"].value;
    if (headerinput == "") {
        return false;
	}
}

function validate_border() {
    var borderinput = document.forms["miter_border_form"]["user_border"].value;
    if (borderinput == "") {
        return false;
	}
}